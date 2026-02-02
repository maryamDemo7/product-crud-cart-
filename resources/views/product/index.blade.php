@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Products</h4>
        <button class="btn btn-primary" id="addProductBtn">Add Product</button>
    </div>

    <table class="table table-bordered table-striped" id="productsTable">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Images</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data coming from ajax dataTable -->
        </tbody>
    </table>
@endsection