<div class="modal fade" id="deleteProductModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Delete Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="deleteProductForm">
                    <input type="hidden" id="delete_product_id" name="product_id">
                    <div class="text-center mb-3">
                        <div class="mb-2">
                            <i class="bi bi-exclamation-triangle-fill text-danger fs-1"></i>
                        </div>
                        <p class="text-muted mb-0">
                            Are you sure you want to delete this record? <br>
                            <small class="text-danger">This action cannot be undone.</small>
                        </p>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-danger">
                            Yes, Delete
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

