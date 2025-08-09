@extends('admin.layout.app')

@section('content')
<div class="container dashboard-card">
    <h2>Hero Slides</h2>

    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" id="addHeroBtn">
            <i class="fas fa-plus-circle me-1"></i> Add Slide
        </button>
    </div>

    <div class="table-responsive">
        <table id="heroTable" class="table table-striped table-hover w-100">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th>Image</th>
                    <th>Button</th>
                    <th>Order</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<!-- Add/Edit Modal -->
<div class="modal fade" id="heroModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="heroForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="heroId" name="hero_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="heroModalLabel">Add New Slide</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Subtitle</label>
                            <input type="text" class="form-control" id="subtitle" name="subtitle">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Button Text</label>
                            <input type="text" class="form-control" id="button_text" name="button_text">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Button Link (URL)</label>
                            <input type="url" class="form-control" id="button_link" name="button_link">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Sort Order</label>
                            <input type="number" class="form-control" id="sort_order" name="sort_order" value="0" min="0">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Image <small class="text-muted">(jpg, png, webp)</small></label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <div id="existingImageContainer" class="mt-2"></div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="heroModalClose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="saveHeroBtn" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Image Preview Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Image Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="previewImage" src="" class="img-fluid rounded" alt="Preview">
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- CSRF Token for AJAX -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- jQuery, DataTables, SweetAlert2 (same as your categories page) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- DataTables -->
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    // Setup CSRF for all AJAX
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    // Bootstrap modal instances
    const heroModalEl = new bootstrap.Modal(document.getElementById('heroModal'), { keyboard: false });
    const imagePreviewModalEl = new bootstrap.Modal(document.getElementById('imagePreviewModal'), {});

    // Elements
    const heroForm = $('#heroForm');
    const heroTable = $('#heroTable');
    const heroModalLabel = $('#heroModalLabel');
    const existingImageContainer = $('#existingImageContainer');

    // Initialize DataTable
    const table = heroTable.DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.hero-slides.index") }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'title', name: 'title' },
            { data: 'subtitle', name: 'subtitle' },
            { data: 'image', name: 'image', orderable: false, searchable: false },
            { data: 'button', name: 'button', orderable: false, searchable: false },
            { data: 'sort_order', name: 'sort_order' },
            { data: 'status', name: 'status', orderable: false, searchable: false, className: 'text-center' },
            { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
        ],
        order: [[5, 'asc']]
    });

    function showToast(message, icon = 'success') {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon,
            title: message,
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
        });
    }

    function clearForm() {
        heroForm[0].reset();
        $('#heroId').val('');
        existingImageContainer.html('');
        heroModalLabel.text('Add New Slide');
    }

    // Open Add modal
    $('#addHeroBtn').on('click', function () {
        clearForm();
        heroModalEl.show();
    });

    // Image click preview from table or modal
    $(document).on('click', '.file-preview', function () {
        const src = $(this).data('src') || $(this).attr('src');
        $('#previewImage').attr('src', src);
        imagePreviewModalEl.show();
    });

    // Submit form (create/update)
    heroForm.on('submit', function (e) {
        e.preventDefault();

        const id = $('#heroId').val();
        const formData = new FormData(this);

        const url = id ? `/admin/hero-slides/${id}` : '{{ route("admin.hero-slides.store") }}';
        const method = id ? 'POST' : 'POST'; // controller routes use POST for update as well

        $.ajax({
            url,
            method,
            data: formData,
            processData: false,
            contentType: false,
            success(response) {
                showToast(response.message || (id ? 'Updated' : 'Added'));
                heroModalEl.hide();
                table.ajax.reload(null, false);
            },
            error(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const errs = xhr.responseJSON.errors;
                    let msg = '';
                    Object.values(errs).forEach(arr => { msg += arr.join('<br>') + '<br>'; });
                    Swal.fire({ icon: 'error', html: msg });
                } else {
                    Swal.fire('Error', xhr.responseJSON?.message || 'Server error', 'error');
                }
            }
        });
    });

    // Edit button
    $(document).on('click', '.edit-btn', function () {
        const id = $(this).data('id');
        // GET the slide (controller show returns JSON)
        $.ajax({
            url: `/admin/hero-slides/${id}`,
            method: 'GET',
            success(data) {
                $('#heroId').val(data.id);
                $('#title').val(data.title);
                $('#subtitle').val(data.subtitle);
                $('#button_text').val(data.button_text);
                $('#button_link').val(data.button_link);
                $('#sort_order').val(data.sort_order ?? 0);
                $('#status').val(data.status ? 1 : 0);

                existingImageContainer.html('');
                if (data.image) {
                    const url = `/storage/${data.image}`;
                    existingImageContainer.html(`<img src="${url}" width="120" class="img-thumbnail file-preview" data-src="${url}" style="cursor:pointer">`);
                }

                heroModalLabel.text('Edit Slide');
                heroModalEl.show();
            },
            error() {
                Swal.fire('Error', 'Failed to fetch slide data', 'error');
            }
        });
    });

    // Delete button
    $(document).on('click', '.delete-btn', function () {
        const id = $(this).data('id');
        const title = $(this).data('title') || 'this slide';

        Swal.fire({
            title: `Delete ${title}?`,
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/hero-slides/${id}`,
                    method: 'POST', // use POST with _method DELETE so controllers accepting DELETE work
                    data: { _method: 'DELETE' },
                    success() {
                        showToast('Deleted', 'success');
                        table.ajax.reload(null, false);
                    },
                    error() {
                        Swal.fire('Error', 'Delete failed', 'error');
                    }
                });
            }
        });
    });

    // Toggle status (switch)
    $(document).on('change', '.toggle-status', function () {
        const id = $(this).data('id');
        $.ajax({
            url: `/admin/hero-slides/${id}/toggle`,
            method: 'POST',
            success() {
                showToast('Status updated', 'success');
                table.ajax.reload(null, false);
            },
            error() {
                Swal.fire('Error', 'Status update failed', 'error');
            }
        });
    });

});
</script>
@endsection
