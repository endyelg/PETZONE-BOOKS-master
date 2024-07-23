<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Services\Admin\Traits\HasProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;


class productController extends Controller{
    use HasProduct;

    /**
     * Show products list
     *
     * @return \Illuminate\Http\Response
     */
    public function all(){
        $products = Product::with('category')->paginate(10);

        return view('admin.frontend.products.list' , compact('products'));
    }

    /**
     * Show the form for create a new product
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $categories = Category::all();
        
        return view('admin.frontend.products.add' , compact('categories'));
    }

    /**
     * Store a new product
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validator = $this->validateAddForm($request);

        $this->doStore($validator);

        return redirect()->route('admin.products.all')->with('simpleSuccessAlert' , 'New product added successfully');
        $validator = $this->validateAddForm($request);

    
    }


    /**
     * Show the form for edit a product
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product){
        $categories = Category::all();

        return view('admin.frontend.products.edit' , compact('product' , 'categories'));
    }

    /**
     * Update a product
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product,Request $request){
        $validator = $this->validateUpdateForm($request);

        $this->doUpdate($product , $validator);

        return redirect()->route('admin.products.all')->with('simpleSuccessAlert' , 'Product updated successfully');
    }

    /**
     * Remove a product
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product){
        File::delete(public_path("\images\products\\$product->demo_url"));
        
        $product->delete();

        return back()->with('simpleSuccessAlert' , 'Product removed successfully');
    }

    public function index()
    {
        if (request()->ajax()) {
            $products = Product::with('category'); // Eager loading the category
            return DataTables::of($products)
                ->addColumn('action', function($row){
                    $deleteForm = '<form action="'.route('admin.products.destroy', $row->id).'" method="POST" id="prepare-form" style="display:inline;">
                                    '.csrf_field().'
                                    '.method_field('DELETE').'
                                    <button type="submit" class="btn btn-danger"><span class="ti-trash"></span></button>
                                   </form>';
                    $editLink = '<a href="'.route('admin.products.edit', $row->id).'" class="btn btn-primary"><span class="ti-pencil"></span></a>';
                    return $deleteForm . ' | ' . $editLink;
                })
                ->addColumn('image', function($row){
                    $imagePath = $row->demo_url ? asset('images/products/' . $row->demo_url) : null;
                    return $imagePath ? '<img src="'.$imagePath.'" alt="Product Image" width="50">' : 'No Image';
                })
                ->rawColumns(['action', 'image']) // Make sure the HTML in 'action' and 'image' columns is not escaped
                ->make(true);
        }

        return view('admin.frontend.products.list'); // No need to fetch products for AJAX requests
    }
    /**
     * Download demo
     *
     * @param Product $product
     * @return void
     */
    public function downloadDemo(Product $product){
        return response()->download(public_path('images\products\\' . $product->demo_url));
    }

}