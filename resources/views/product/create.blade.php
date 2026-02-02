<div class="modal fade" id="productAddModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="productForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="product_name" class="form-control">
                        <span id="nameError" class="error text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Price</label>
                        <input type="text" name="product_price" class="form-control" >
                        <span id="priceError" class="error text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Description</label>
                        <textarea name="product_description" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Images</label>
                        <input type="file" name="product_image[]" class="form-control" multiple>
                        <span id="imageError" class="error text-danger"></span>
                    </div>
                    <div class="d-flex justify-content-end mb-3">
                        <button type="submit" class="btn btn-success text-end">
                            Save
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

