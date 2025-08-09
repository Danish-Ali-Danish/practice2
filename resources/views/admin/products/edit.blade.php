<!-- resources/views/admin/products/edit.blade.php -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="productForm" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" id="productId">
        <div class="modal-header">
          <h5 class="modal-title" id="productModalLabel">Add / Edit Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="name" class="form-label">Product Name</label>
              <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="slug" class="form-label">Slug</label>
              <input type="text" name="slug" id="slug" class="form-control" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="brand_id" class="form-label">Brand</label>
              <select name="brand_id" id="brand_id" class="form-select" required>
                <option value="">Select Brand</option>
                @foreach($brands as $brand)
                  <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label for="subcategory_id" class="form-label">Subcategory</label>
              <select name="subcategory_id" id="subcategory_id" class="form-select" required>
                <option value="">Select Subcategory</option>
                @foreach($subcategories as $subcategory)
                  <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="price" class="form-label">Price</label>
              <input type="number" name="price" id="price" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="compare_price" class="form-label">Compare Price</label>
                <input type="number" name="compare_price" id="compare_price" class="form-control">
            </div>
            <div class="col-md-6">
              <label for="main_image" class="form-label">Main Image</label>
              <input type="file" name="main_image" class="form-control">
              <img id="mainImagePreview" src="#" style="display: none; margin-top: 5px;" width="100" alt="Preview">
            </div>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" rows="3" class="form-control"></textarea>
          </div>

          <div class="form-check form-check-inline">
            <input type="checkbox" name="is_featured" class="form-check-input" id="is_featured">
            <label class="form-check-label" for="is_featured">Featured</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="checkbox" name="is_trending" class="form-check-input" id="is_trending">
            <label class="form-check-label" for="is_trending">Trending</label>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save Product</button>
        </div>
      </form>
    </div>
  </div>
</div>