<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Services\Admin\Traits\HasProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

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

        // if ($validator->fails()) {
        //     return back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        // $product = new Product();
        // $product->category_id = $request->input('category_id');
        // $product->title = $request->input('title');
        // $product->description = $request->input('description');
        // $product->percent_discount = $request->input('percent_discount');
        // $product->author = $request->input('author');
        // $product->price = $request->input('price');
        // $product->stock = $request->input('stock');

        // // Handle product image upload
        // if ($request->hasFile('demo_url')) {
        //     $file = $request->file('demo_url');
        //     $filename = time() . '_' . $file->getClientOriginalName();
        //     $path = $file->storeAs('demo_url', $filename, 'public');
        //     $product->demo_url = $path;
        // } else {
        //     $product->demo_url = null;
        // }

        // $product->save();

        // return redirect()->route('admin.products.all')->with('simpleSuccessAlert', 'New product added successfully');
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

    /**
     * Download demo
     *
     * @param Product $product
     * @return void
     */
    public function downloadDemo(Product $product){
        return response()->download(public_path('images\products\\' . $product->demo_url));
    }

     /**
     * Validate form data for adding a new supplier.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */

    // protected function validateAddForm(Request $request)
    // {
    //     return Validator::make($request->all(), [
    //         'category_id' => 'required|exists:categories,id',
    //         'title' => 'required|string|min:3|max:255',
    //         'description' => 'required|string|min:5',
    //         'percent_discount' => 'required|numeric|min:1|max:100',
    //         'demo_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'author' => 'required|string|min:3|max:255',
    //         'price' => 'required|numeric|min:1',
    //         'stock' => 'required|numeric|min:1',
    //     ]);
    // }

    // protected function validateUpdateForm(Request $request)            
    // {
    //     return Validator::make($request->all(), [
    //         'category_id' => 'required|exists:categories,id',
    //         'title' => 'required|string|min:3|max:255',
    //         'description' => 'required|string|min:5',
    //         'percent_discount' => 'required|numeric|min:1|max:100',
    //         'demo_url' => 'required|image',
    //         'author' => 'required|string|min:3|max:255',
    //         'price' => 'required|numeric|min:1',
    //         'stock' => 'required|numeric|min:1',
    //     ]);
    // }
}