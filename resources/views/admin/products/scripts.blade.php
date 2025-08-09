<script>
    // public/js/product-script.js
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

$(document).ready(function () {
    // Load products in DataTable
    let table = $('#productTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/admin/products',
        },
        columns: [
            { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'slug', name: 'slug' },
            { data: 'brand_name', name: 'brand.name' },
            { data: 'subcategory_name', name: 'subcategory.name' },
            { data: 'price', name: 'price' },
            { data: 'image', name: 'image', orderable: false, searchable: false },
            { data: 'is_featured', name: 'is_featured' },
            { data: 'is_trending', name: 'is_trending' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ]
    });

    // Reset form
    $('#productForm')[0].reset();

    // Save Product
    $('#productForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        let url = $('#product_id').val() ? '/admin/products/' + $('#product_id').val() : '/admin/products';
        let method = $('#product_id').val() ? 'POST' : 'POST';

        $.ajax({
            url: url,
            method: method,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#productModal').modal('hide');
                $('#productForm')[0].reset();
                $('#product_id').val('');
                table.ajax.reload();
                Swal.fire('Success!', response.message, 'success');
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors;
                let errorMessages = '';
                for (let key in errors) {
                    errorMessages += errors[key][0] + '\n';
                }
                Swal.fire('Error!', errorMessages, 'error');
            }
        });
    });

    // Edit product
    $(document).on('click', '.editBtn', function () {
        let id = $(this).data('id');
        $.get('/admin/products/' + id + '/edit', function (data) {
            $('#productModal').modal('show');
            $('#product_id').val(data.id);
            $('#name').val(data.name);
            $('#slug').val(data.slug);
            $('#brand_id').val(data.brand_id);
            $('#subcategory_id').val(data.subcategory_id);
            $('#price').val(data.price);
            $('#description').val(data.description);
            $('#is_featured').prop('checked', data.is_featured);
            $('#is_trending').prop('checked', data.is_trending);
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
                    data: { _token: $('meta[name="csrf-token"]').attr('content') },
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

    // Bulk delete
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
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        ids: ids
                    },
                    success: function (response) {
                        table.ajax.reload();
                        Swal.fire('Deleted!', response.message, 'success');
                    }
                });
            }
        });
    });

});
$("input[name='main_image']").on('change', function () {
    const preview = document.getElementById('mainImagePreview');
    if (this.files && this.files[0] && preview) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(this.files[0]);
    }
});


</script>
