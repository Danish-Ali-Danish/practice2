<div class="modal fade" id="subcategoryModal" tabindex="-1" aria-labelledby="subcategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subcategoryModalLabel">Add New Subcategory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="subcategoryForm" method="POST" action="return false;">
                    @csrf
                    <input type="hidden" id="subcategoryId">
                    <div class="mb-3">
                        <label for="subcategoryName" class="form-label">Subcategory Name</label>
                        <input type="text" class="form-control" id="subcategoryName" required>
                    </div>
                    <div class="mb-3">
                        <label for="subcategoryCategory" class="form-label">Parent Category</label>
                        <select class="form-select" id="subcategoryCategory" required>
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subcategoryFile" class="form-label">Image (optional)</label>
                        <input type="file" class="form-control" id="subcategoryFile" accept="image/*">
                    </div>
                </form>
            </div>
            <div class="modal-footer align-items-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveSubcategoryBtn">Save</button>
            </div>
        </div>
    </div>
</div>
