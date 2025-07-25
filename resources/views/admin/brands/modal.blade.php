<!-- resources/views/admin/brands/modal.blade.php -->
<div class="modal fade" id="brandModal" tabindex="-1" aria-labelledby="brandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="brandForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="brandId">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="brandModalLabel">Add Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div id="brandFormErrors" class="alert alert-danger d-none"></div>

                    <div class="mb-3">
                        <label for="brandName" class="form-label">Brand Name</label>
                        <input type="text" class="form-control" name="name" id="brandName" required>
                    </div>

                    <div class="mb-3">
                        <label for="brandSubcategory" class="form-label">Subcategory</label>
                        <select class="form-select" name="subcategory_id" id="brandSubcategory" required>
                            <option value="">-- Select Subcategory --</option>
                            @foreach($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="brandFile" class="form-label">Image</label>
                        <input type="file" class="form-control" name="file" id="brandFile" onchange="previewImage(event)">
                        <img id="brandPreviewImage" src="" class="img-thumbnail mt-2 d-none" width="100">
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_popular" id="brandPopular">
                        <label class="form-check-label" for="brandPopular">Popular</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Brand</button>
                </div>
            </div>
        </form>
    </div>
</div>
