<div class="modal fade" id="featureModal" tabindex="-1" aria-labelledby="featureModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="featureForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="featureModalLabel">Add Feature</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="featureId" name="id">
                    
                    <div class="mb-3">
                        <label for="featureTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="featureTitle" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="featureIcon" class="form-label">Icon (FontAwesome class)</label>
                        <input type="text" class="form-control" id="featureIcon" name="icon" placeholder="fas fa-star" required>
                    </div>

                    <div class="mb-3">
                        <label for="featureDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="featureDescription" name="description" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="saveFeatureBtn" class="btn btn-primary">Save Feature</button>
                </div>
            </form>
        </div>
    </div>
</div>
