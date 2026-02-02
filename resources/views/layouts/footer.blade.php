<!--jQuery  -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Include create file -->
@include('product.create')

<!-- Include edit file -->
@include('product.edit')

<!-- Include delete file -->
@include('product.delete')

<script>
$(document).ready(function(){
    //Listing of Product data on dataTable
    let table = $('#productsTable').DataTable({
        ajax: "{{ route('product.list') }}",
        order: [[0, 'desc']],
        columnDefs: [
            { orderable: false, targets: 0 } // disable sorting on S.No
        ],
        columns: [
            { data: 'id' },
            { data: 'product_name' },
            { data: 'product_price' },
            { data: 'product_description' },
            { data: 'images', orderable: false, searchable: false },
            { data: 'action', orderable: false, searchable: false }
        ]
    });

    // Auto-recalculate serial number
    table.on('order.dt search.dt draw.dt', function () {
        table.column(0, { search: 'applied', order: 'applied' })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
    }).draw();

    //Opening Add product modal
    $('#addProductBtn').on('click', function () {
        $('#productForm')[0].reset();
        $('#productAddModal').modal('show');
    });

    //Store Product
    $('#productForm').submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        var route = "{{route('product.store')}}";
        $.ajax({
            url: route,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('.error').text('');
                if(response.success == true) {
                    console.log('save');
                    toastr.success(response.message);
                } else {
                    console.log('error');
                    toastr.error(response.message);
                }

                $('#productAddModal').modal('hide');
                table.ajax.reload(null, false);
            },
            error: function(response) {
                let errors = response.responseJSON.errors;
                $('#nameError').text(errors.product_name ? errors.product_name : '');
                $('#priceError').text(errors.product_price ? errors.product_price : '');
            
                let imageErrorList = '';
                for (let key in errors) {
                    if (key.startsWith('product_image')) {
                        imageErrorList += errors[key][0] + '<br>';
                    }
                }
                $('#imageError').html(imageErrorList);
                // $('#imageError').text(errors.product_image ? errors.product_image : '');
            }
        });
    });

    //Opening Edit Product modal
    $(document).on('click', '.editProductBtn', function () {
        let productId = $(this).data('id');
        var url = "{{ url('product/edit') }}" + '/' +productId;

        $.ajax({
           url: url,
           type: "GET",
            success: function (response) {
                if(response.success) {
                    let product = response.data;

                    $('#edit_product_id').val(product.id);
                    $('#edit_product_name').val(product.product_name);
                    $('#edit_product_price').val(product.product_price);
                    $('#edit_product_description').val(product.product_description);

                    $('#productEditModal').modal('show');
                } else {
                    toastr.error("Failed to load data");
                }
            }  
        });
        $('#productEditModal').modal('show');
    });

    //Update Product details
    $('#editProductForm').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        var productId = $('#edit_product_id').val();
        var route = "{{ route('product.update', ':id')}}";
        route = route.replace(':id', productId);
        console.log(route, 'routeee')
        $.ajax({
            url: route,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('.error').text('');
                if(response.success == true) {
                    console.log('update');
                    toastr.success(response.message);
                } else {
                    console.log('error');
                    toastr.error(response.message);
                }

                $('#productEditModal').modal('hide');
                table.ajax.reload(null, false);
            },
            error: function(response) {
                let errors = response.responseJSON.errors;
                $('#editNameError').text(errors.product_name ? errors.product_name : '');
                $('#editPriceError').text(errors.product_price ? errors.product_price : '');
            
                let imageErrorList = '';
                for (let key in errors) {
                    if (key.startsWith('product_image')) {
                        imageErrorList += errors[key][0] + '<br>';
                    }
                }
                $('#editImageError').html(imageErrorList);
            }
        });
    });

    //Delete Modal 
    $(document).on('click', '.deleteProductBtn', function() {
        let productId = $(this).data('id'); 
        $('#delete_product_id').val(productId); 
        $('#deleteProductModal').modal('show');
    });

    $('#deleteProductForm').submit(function (e) {
        e.preventDefault();

        let productId = $('#delete_product_id').val();
        let route = "{{ route('product.delete', ':id') }}";
        route = route.replace(':id', productId);

        $.ajax({
            url: route,
            type: 'GET',
            success: function (response) {
                toastr.success(response.message);
                $('#deleteProductModal').modal('hide');

                // Removing row from DataTable 
                table.row($(`button[data-id="${productId}"]`).parents('tr')).remove().draw();
            }
        });
    });
});
</script>