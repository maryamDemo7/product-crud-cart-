<div class="modal fade" id="productEditModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="editProductForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="edit_product_id" name="product_id">
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="product_name" class="form-control" id="edit_product_name">
                        <span id="editNameError" class="error text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Price</label>
                        <input type="text" name="product_price" class="form-control" id="edit_product_price">
                        <span id="editPriceError" class="error text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Description</label>
                        <textarea name="product_description" class="form-control" id="edit_product_description"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Images</label>
                        <input type="file" name="product_image[]" class="form-control" multiple>
                        <span id="editImageError" class="error text-danger"></span>
                    </div>
                    <div class="d-flex justify-content-end mb-3">
                        <button type="submit" class="btn btn-success text-end">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

