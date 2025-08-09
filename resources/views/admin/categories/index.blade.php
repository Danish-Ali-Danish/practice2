@extends('admin.layout.app')

@section('content')
<div class="container dashboard-card">
    <h2>Categories List</h2>

    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" id="addCategoryBtn">
            <i class="fas fa-plus-circle me-1"></i> Add Category
        </button>
    </div>

    <div class="table-responsive">
        <table id="categoryTable" class="table table-striped table-hover w-100">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>File</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Add/Edit Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="categoryForm" enctype="multipart/form-data">
                    <input type="hidden" id="categoryId">
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="categoryName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="categoryFile" class="form-label">Image</label>
                        <input type="file" class="form-control" id="categoryFile" name="file">
                        <div class="mt-2" id="existingImageContainer"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveCategoryBtn">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- File Preview Modal -->
<div class="modal fade" id="filePreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">File Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="previewImage" src="" class="img-fluid" alt="File Preview">
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- DataTables -->
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const categoryModal = new bootstrap.Modal($('#categoryModal')[0]);
    const categoryForm = $('#categoryForm');
    const categoryIdInput = $('#categoryId');
    const categoryNameInput = $('#categoryName');
    const categoryModalLabel = $('#categoryModalLabel');
    const addCategoryBtn = $('#addCategoryBtn');
    const saveCategoryBtn = $('#saveCategoryBtn');
    const categoryFileInput = $('#categoryFile');
    const existingImageContainer = $('#existingImageContainer');

    const categoryTable = $('#categoryTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("categories.index") }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'file', name: 'file', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
        ]
    });

    function showAlert(message, type = 'success') {
        Swal.fire({
            icon: type,
            title: type.charAt(0).toUpperCase() + type.slice(1),
            html: message,
            timer: 4000,
            timerProgressBar: true,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
        });
    }

    function clearForm() {
        categoryIdInput.val('');
        categoryForm[0].reset();
        categoryModalLabel.text('Add New Category');
        existingImageContainer.html('');
    }

    saveCategoryBtn.on('click', function () {
        const id = categoryIdInput.val();
        const name = categoryNameInput.val().trim();
        const file = categoryFileInput[0].files[0];

        if (!name) {
            showAlert('Category name is required.', 'warning');
            return;
        }

        const formData = new FormData();
        formData.append('name', name);
        if (file) formData.append('file', file);
        if (id) formData.append('_method', 'PUT');

        const url = id ? `/admin/categories/${id}` : '{{ route("categories.store") }}';

        $.ajax({
            url,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
                showAlert('Category ' + (id ? 'updated' : 'added') + ' successfully!');
                categoryModal.hide();
                clearForm();
                categoryTable.ajax.reload();
            },
            error: function (xhr) {
                const errorMessage = xhr.responseJSON?.errors?.name?.[0] || xhr.responseJSON?.message || xhr.statusText;
                showAlert('Error: ' + errorMessage, 'error');
            }
        });
    });

    $(document).on('click', '.edit-btn', function () {
        const id = $(this).data('id');
        $.ajax({
            url: `/admin/categories/${id}`,
            method: 'GET',
            success: function (category) {
                categoryIdInput.val(category.id);
                categoryNameInput.val(category.name);
                categoryModalLabel.text('Edit Category');
                existingImageContainer.html('');
                if (category.file_path) {
                    existingImageContainer.html(`
                        <img src="/storage/${category.file_path}" width="100" class="mt-2 border">
                    `);
                }
                categoryModal.show();
            },
            error: function () {
                showAlert('Error fetching category for edit.', 'error');
            }
        });
    });

    $(document).on('click', '.delete-btn', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');

        Swal.fire({
            title: `Delete "${name}"?`,
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/categories/${id}`,
                    method: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function () {
                        showAlert('Category deleted successfully!');
                        categoryTable.ajax.reload();
                    },
                    error: function (xhr) {
                        const msg = xhr.responseJSON?.message || 'Failed to delete category.';
                        showAlert(msg, 'error');
                    }
                });
            }
        });
    });

    $(document).on('click', '.file-preview', function () {
        const src = $(this).data('src');
        $('#previewImage').attr('src', src);
        new bootstrap.Modal($('#filePreviewModal')).show();
    });

    addCategoryBtn.on('click', function () {
        clearForm();
        categoryModal.show();
    });
});
</script>
@endsection
