@extends('admin.layout.app')

@section('content')
<div class="container dashboard-card">
    <h2>Subcategories List</h2>

    <div id="alertContainer"></div>

    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" id="addSubcategoryBtn">
            <i class="fas fa-plus-circle me-1"></i> Add Subcategory
        </button>
    </div>

    <div class="table-responsive">
        <table id="subcategoryTable" class="table table-striped table-hover w-100">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal for Add/Edit -->
<div class="modal fade" id="subcategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subcategoryModalLabel">Add Subcategory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="subcategoryForm">
                    @csrf
                    <input type="hidden" id="subcategoryId">
                    <div class="mb-3">
                        <label for="subcategoryName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="subcategoryName" required>
                    </div>
                    <div class="mb-3">
                        <label for="subcategoryCategory" class="form-label">Category</label>
                        <select class="form-select" id="subcategoryCategory" required>
                            <option value="">Select Category</option>
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subcategoryFile" class="form-label">Image</label>
                        <input type="file" class="form-control" id="subcategoryFile">
                    </div>
                    <div class="text-end">
                        <button type="button" id="saveSubcategoryBtn" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Image Preview -->
<div class="modal fade" id="filePreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Image Preview</h5>
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
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- DataTables -->
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    const subcategoryModal = new bootstrap.Modal($('#subcategoryModal')[0]);
    const subcategoryForm = $('#subcategoryForm');
    const subcategoryIdInput = $('#subcategoryId');
    const subcategoryNameInput = $('#subcategoryName');
    const subcategoryCategoryInput = $('#subcategoryCategory');
    const saveSubcategoryBtn = $('#saveSubcategoryBtn');
    const addSubcategoryBtn = $('#addSubcategoryBtn');

    const subcategoryTable = $('#subcategoryTable').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: '{{ route("subcategories.index") }}',
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'name', name: 'name' },
        { data: 'category.name', name: 'category.name' },
        { 
            data: 'image', 
            name: 'image', 
            orderable: false, 
            searchable: false,
            render: function(data, type, row) {
                // If data is already HTML (from controller), return it directly
                if (type === 'display' && data.startsWith('<img')) {
                    return data;
                }
                // Otherwise create the image HTML
                return data ? 
                    `<img src="${data}" width="50" height="50" style="object-fit:cover;cursor:pointer" class="file-preview" data-src="${data}">` : 
                    'No Image';
            }
        },
        { 
            data: 'action', 
            name: 'action', 
            orderable: false, 
            searchable: false, 
            className: 'text-center' 
        }
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
        subcategoryIdInput.val('');
        subcategoryForm[0].reset();
        $('#subcategoryModalLabel').text('Add New Subcategory');
    }

    saveSubcategoryBtn.on('click', function (e) {
        e.preventDefault();
        const id = subcategoryIdInput.val();
        const name = subcategoryNameInput.val().trim();
        const category_id = subcategoryCategoryInput.val();
        const file = $('#subcategoryFile')[0]?.files[0];

        if (!name || !category_id) {
            showAlert('All fields are required.', 'warning');
            return;
        }

        const formData = new FormData();
        formData.append('name', name);
        formData.append('category_id', category_id);
        if (file) formData.append('image', file);
        formData.append('_token', '{{ csrf_token() }}');
        if (id) formData.append('_method', 'PUT');

        $.ajax({
            url: id ? `/subcategories/${id}` : '{{ route("subcategories.store") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: () => {
                showAlert(`Subcategory ${id ? 'updated' : 'added'} successfully!`);
                subcategoryModal.hide();
                clearForm();
                subcategoryTable.ajax.reload();
            },
            error: xhr => {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorHtml = '';
                    $.each(errors, (key, messages) => {
                        errorHtml += `<div>${messages.join('<br>')}</div>`;
                    });
                    showAlert(errorHtml, 'error');
                } else {
                    showAlert('Failed to save subcategory.', 'error');
                }
            }
        });
    });

    $(document).on('click', '.edit-btn', function () {
        const id = $(this).data('id');
        $.get(`/subcategories/${id}`, subcategory => {
            subcategoryIdInput.val(subcategory.id);
            subcategoryNameInput.val(subcategory.name);
            subcategoryCategoryInput.val(subcategory.category_id);
            $('#subcategoryModalLabel').text('Edit Subcategory');
            subcategoryModal.show();
        }).fail(() => showAlert('Failed to fetch subcategory.', 'error'));
    });

    $(document).on('click', '.delete-btn', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');
        Swal.fire({
            title: `Delete "${name}"?`,
            text: 'This action cannot be undone!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
        }).then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/subcategories/${id}`,
                    method: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: () => {
                        showAlert('Subcategory deleted successfully!');
                        subcategoryTable.ajax.reload();
                    },
                    error: () => showAlert('Failed to delete subcategory.', 'error')
                });
            }
        });
    });

    addSubcategoryBtn.on('click', function () {
        clearForm();
        subcategoryModal.show();
    });

    $(document).on('click', '.file-preview', function () {
        $('#previewImage').attr('src', $(this).data('src'));
        new bootstrap.Modal($('#filePreviewModal')).show();
    });
});
</script>
@endsection