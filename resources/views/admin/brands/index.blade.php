@extends('admin.layout.app')

@section('content')
<div class="container dashboard-card">
    <h2>Brands List</h2>

    <div class="d-flex justify-content-between mb-3">
        <button class="btn btn-primary" id="addBrandBtn">
            <i class="fas fa-plus-circle me-1"></i> Add Brand
        </button>
        
        <div>
            <button class="btn btn-danger me-2 d-none" id="bulkDeleteBtn">
                <i class="fas fa-trash-alt me-1"></i> Delete Selected
            </button>
            <button class="btn btn-success d-none" id="savePopularBtn">
                <i class="fas fa-save me-1"></i> Save Popular
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table id="brandTable" class="table table-striped table-hover w-100">
            <thead class="table-dark">
                <tr>
                    <th><input type="checkbox" id="selectAllBrands"></th>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Subcategory</th>
                    <th>Popular</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal -->
@include('admin.brands.modal')
@endsection

@section('styles')
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {
    const brandTable = $('#brandTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("brands.list") }}',
        columns: [
            { data: 'checkbox', orderable: false, searchable: false },
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'image', orderable: false, searchable: false },
            { data: 'name' },
            { data: 'subcategory' },
            { data: 'is_popular', orderable: false, searchable: false },
            { data: 'actions', orderable: false, searchable: false }
        ]
    });

    $('#addBrandBtn').click(function () {
        $('#brandForm')[0].reset();
        $('#brandId').val('');
        $('#brandPreviewImage').addClass('d-none');
        $('#brandModal .modal-title').text('Add Brand');
        $('#brandModal').modal('show');
    });

    $(document).on('click', '.edit-btn', function () {
        const id = $(this).data('id');
        $.get(`/admin/brands/${id}/edit`, function (response) {
            if (response.success) {
                const brand = response.data;
                $('#brandId').val(brand.id);
                $('#brandName').val(brand.name);
                $('#brandSubcategory').val(brand.subcategory_id);
                $('#brandPopular').prop('checked', brand.is_popular);
                if (brand.image) {
                    $('#brandPreviewImage').attr('src', `/storage/${brand.image}`).removeClass('d-none');
                }
                $('#brandModal .modal-title').text('Edit Brand');
                $('#brandModal').modal('show');
            }
        });
    });

    $('#brandForm').submit(function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const id = $('#brandId').val();
        const url = id ? `/admin/brands/${id}` : '{{ route("brands.store") }}';
        const method = id ? 'POST' : 'POST';
        if (id) formData.append('_method', 'PUT');

        $.ajax({
            url,
            method,
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    $('#brandModal').modal('hide');
                    brandTable.ajax.reload();
                    Swal.fire('Success', response.message, 'success');
                }
            },
            error: function (xhr) {
                let message = 'Something went wrong.';
                if (xhr.status === 422) {
                    message = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                }
                Swal.fire('Error', message, 'error');
            }
        });
    });

    $(document).on('click', '.delete-btn', function () {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: 'This brand will be deleted!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/brands/${id}`,
                    method: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function (res) {
                        if (res.success) {
                            brandTable.ajax.reload();
                            Swal.fire('Deleted', res.message, 'success');
                        }
                    }
                });
            }
        });
    });

    $(document).on('change', '.brand-checkbox, #selectAllBrands, .popular-checkbox', function () {
        $('#bulkDeleteBtn').toggleClass('d-none', $('.brand-checkbox:checked').length === 0);
        $('#savePopularBtn').toggleClass('d-none', $('.popular-checkbox:checked').length === 0);
    });

    $('#bulkDeleteBtn').click(function () {
        const ids = $('.brand-checkbox:checked').map(function () {
            return $(this).val();
        }).get();

        if (!ids.length) return;

        Swal.fire({
            title: 'Delete selected brands?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            confirmButtonColor: '#d33'
        }).then(result => {
            if (result.isConfirmed) {
                $.post('{{ route("brands.bulk-actions") }}', {
                    action: 'delete',
                    ids,
                    _token: '{{ csrf_token() }}'
                }, function (res) {
                    if (res.success) {
                        brandTable.ajax.reload();
                        Swal.fire('Deleted', res.message, 'success');
                    }
                });
            }
        });
    });

    $('#savePopularBtn').click(function () {
        const popularIds = $('.popular-checkbox:checked').map(function () {
            return $(this).val();
        }).get();

        $.post('{{ route("brands.bulk-actions") }}', {
            action: 'make_popular',
            ids: popularIds,
            _token: '{{ csrf_token() }}'
        }, function (res) {
            if (res.success) {
                brandTable.ajax.reload();
                Swal.fire('Updated', res.message, 'success');
            }
        });
    });

    $(document).on('change', '.popular-checkbox', function () {
        const checkbox = $(this);
        const brandId = checkbox.data('id');
        const isChecked = checkbox.is(':checked');

        $.post(`/admin/brands/${brandId}/toggle-popular`, {
            _token: '{{ csrf_token() }}'
        }).fail(function () {
            checkbox.prop('checked', !isChecked);
        });
    });

    window.previewImage = function (e) {
        const reader = new FileReader();
        reader.onload = function () {
            $('#brandPreviewImage').attr('src', reader.result).removeClass('d-none');
        };
        reader.readAsDataURL(e.target.files[0]);
    }
});
</script>
@endsection
