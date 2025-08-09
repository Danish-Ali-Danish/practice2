@extends('admin.layout.app')

@section('content')
<div class="container-fluid dashboard-card">
    <h4 class="mb-4">Product List</h4>
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary me-2" id="addProductBtn">
            <i class="fas fa-plus-circle me-1"></i> Add Products
        </button>
        <a href="{{ route('products.featured') }}" class="btn btn-outline-success me-2">
            <i class="fas fa-star me-1"></i> View Featured Products
        </a>

        <button class="btn btn-warning d-none me-2" id="saveFeaturedProducts">
            <i class="fas fa-save me-1"></i> Save Featured Status Changes
        </button>
        <button class="btn btn-danger d-none" id="bulkDeleteBtn">
            <i class="fas fa-trash-alt me-1"></i> Delete Selected
        </button>
    </div>

    <!-- Table -->
    <table class="table table-bordered" id="productTable">
        <thead class="table-dark">
            <tr>
                <th width="5%"><input type="checkbox" id="selectAll"></th>
                <th>Name</th>
                <th>Brand</th>
                <th>Subcategory</th>
                <th>Price</th>
                <th>Compare Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Modal for Product Form -->
@include('admin.products.edit')

@endsection

@section('scripts')
<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Initialize DataTable
    let table = $('#productTable').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        fixedColumns: true,
        ajax: {
            url: '/admin/products/list',
            type: 'GET',
        },
        columns: [
            { 
                data: 'id', 
                name: 'checkbox', 
                orderable: false, 
                searchable: false,
                render: function(data) {
                    return `<input type="checkbox" class="bulk-check" value="${data}">`;
                }
            },
            { data: 'name', name: 'name' },
            { data: 'brand', name: 'brand' },
            { data: 'subcategory', name: 'subcategory' },
            { data: 'price', name: 'price' },
            { data: 'compare_price', name: 'compare_price' },
            { 
                data: 'main_image',
                name: 'main_image',
                orderable: false, 
                searchable: false,
                render: function(data) {
                    return data ? `<img src="/storage/${data}" width="50">` : 'No Image';
                }
            },
            {
                data: 'is_featured',
                name: 'is_featured',
                render: function(data, type, row) {
                    return `<input type="checkbox" class="featured-checkbox" data-id="${row.id}" ${data ? 'checked' : ''}>`;
                }
            },
            { 
                data: 'id', 
                name: 'actions', 
                orderable: false, 
                searchable: false,
                render: function(data, type, row) {
                    return ` 
                        <button class="btn btn-sm btn-primary editBtn" data-id="${data}">Edit</button>
                        <button class="btn btn-sm btn-danger deleteBtn" data-id="${data}">Delete</button>
                    `;
                }
            }
        ]
    });

    // Handle changes in featured status
    $(document).on('change', '.featured-checkbox', function() {
        $('#saveFeaturedProducts').removeClass('d-none');
    });

    // Bulk select checkboxes
    $('#selectAll').click(function() {
        $('.bulk-check').prop('checked', this.checked);
    });

    // Add Product Button
    $('#addProductBtn').click(function() {
        resetForm();
        $('#productModal').modal('show');
    });

    // Save Product Form
    $('#productForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        let productId = $('#productId').val();
        let url = productId ? '/admin/products/' + productId : '/admin/products';
        
        if (productId) {
            formData.append('_method', 'PUT');
        }

        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#productModal').modal('hide');
                table.ajax.reload();
                Swal.fire('Success!', response.message, 'success');
            },
            error: function (xhr) {
                let errors = xhr.responseJSON?.errors;
                if (errors) {
                    let errorMessages = '';
                    for (let key in errors) {
                        errorMessages += errors[key][0] + '\n';
                    }
                    Swal.fire('Error!', errorMessages, 'error');
                } else {
                    Swal.fire('Error!', 'Something went wrong.', 'error');
                }
            }
        });
    });

    // Save changes to "Featured" status
    $('#saveFeaturedProducts').click(function() {
        const updates = [];

        // Collect the changes for "Featured"
        $('.featured-checkbox').each(function() {
            const id = $(this).data('id');
            const value = $(this).is(':checked') ? 1 : 0;
            updates.push({ id: id, field: 'is_featured', value: value });
        });

        // Send the updates to the server
        $.ajax({
            url: '/admin/products/update-status',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                updates: updates
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire('Success!', 'All changes have been saved.', 'success');
                    $('#saveFeaturedProducts').addClass('d-none');
                } else {
                    Swal.fire('Error!', response.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error!', 'Failed to save changes.', 'error');
            }
        });
    });

    // Edit product
    $(document).on('click', '.editBtn', function () {
        let id = $(this).data('id');
        $.get('/admin/products/' + id + '/edit', function (data) {
            if(data.success) {
                resetForm();
                $('#productModal').modal('show');
                $('#productId').val(data.data.id);
                $('#name').val(data.data.name);
                $('#slug').val(data.data.slug);
                $('select[name="brand_id"]').val(data.data.brand_id);
                $('select[name="subcategory_id"]').val(data.data.subcategory_id);
                $('#price').val(data.data.price);
                $('#description').val(data.data.description);
                $('#is_featured').prop('checked', data.data.is_featured);
                if (data.data.main_image) {
                    $('#mainImagePreview').attr('src', '/storage/' + data.data.main_image).show();
                }
            }
        });
    });

    // Delete product
    $(document).on('click', '.deleteBtn', function () {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will permanently delete the product.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/products/' + id,
                    method: 'DELETE',
                    data: { 
                        _token: '{{ csrf_token() }}' 
                    },
                    success: function (response) {
                        table.ajax.reload();
                        Swal.fire('Deleted!', response.message, 'success');
                    },
                    error: function () {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                });
            }
        });
    });

    // Bulk delete products
    $('#bulkDeleteBtn').on('click', function () {
        let ids = [];
        $('.bulk-check:checked').each(function () {
            ids.push($(this).val());
        });

        if (ids.length === 0) {
            Swal.fire('No selection', 'Please select at least one record.', 'info');
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: 'This will permanently delete selected products.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete them!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/products/bulk-delete',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        ids: ids
                    },
                    success: function (response) {
                        table.ajax.reload();
                        Swal.fire('Deleted!', response.message, 'success');
                    },
                    error: function () {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                });
            }
        });
    });

    // Reset form to default state
    function resetForm() {
        $('#productForm')[0].reset();
        $('#productId').val('');
        $('#mainImagePreview').hide();
        $('#saveFeaturedProducts').addClass('d-none');
    }
});
</script>
@endsection
