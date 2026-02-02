<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Product;
use App\Models\ProductImage;
use Exception;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name'           => 'required|string',
            'product_price'          => 'required|numeric',
            'product_image'          => 'required|array',
            'product_image.*'        => 'image|mimes:jpg,jpeg,png'
        ]);

        DB::beginTransaction();
        try {
            $product = Product::create([
                'product_name'        => $request->product_name,
                'product_price'       => $request->product_price,
                'product_description' => $request->product_description??'',
            ]);

            if($product) {
                $fileName = '';
                if($request->hasFile('product_image')) {
                    foreach($request->file('product_image') as $image) {
                        $fileName = uniqid(). '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('products'), $fileName);

                        ProductImage::create([
                            'product_id'    => $product->id,
                            'product_image' => $fileName
                        ]);
                    }
                }
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Added Successfully.']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'An unexpected error occurred']);
        }
    }

    //Fetch data on dataTable via Ajax
    public function list()
    {
        $products = Product::with('images')->get();

        return response()->json([
            'data' => $products->map(function ($item) {

                $images = '<div class="d-flex align-items-center">';
                foreach ($item->images as $img) {
                    $images .= '
                        <a href="'.asset('products/'.$img->product_image).'" target="_blank" class="me-1">
                            <img src="'.asset('products/'.$img->product_image).'"
                                class="img-thumbnail"
                                style="width:40px;height:40px;object-fit:cover;">
                        </a>';
                }
                $images .= '</div>';

                return [
                    'id' => $item->id,
                    'product_name' => $item->product_name,
                    'product_price' => $item->product_price,
                    'product_description' => !empty($item->product_description) ? 
                                            '<span data-bs-toggle="tooltip" data-bs-placement="top" title="'. $item->product_description .'">
                                                '. \Illuminate\Support\Str::limit($item->product_description, 50) .'
                                            </span>' : '—',
                    'images' => $images ?: '—',
                    'action' => '<button class="btn btn-sm btn-primary editProductBtn" data-id="'.$item->id.'">Edit</button> <button class="btn btn-sm btn-danger deleteProductBtn" data-id="'.$item->id.'">Delete</button>',
                ];
            })
        ]);
    }
}


       