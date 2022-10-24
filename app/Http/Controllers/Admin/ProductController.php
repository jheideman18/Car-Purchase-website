<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
     public function index()
    {

        $products = Product::all();
       return view('admin.product.index', compact('products'));
    }

    public function add()
    {
        $category = Category::all();
        return view('admin.product.add', compact('category'));
    }

    public function insert(Request $request)
    {
        $product = new Product();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/products/',$filename);
            $product->image = $filename;
        }
        $product->cate_id = $request->input('cate_id');
        $product->car_name = $request->input('car_name');
        $product->cate_id = $request->input('cate_id');
        $product->car_name = $request->input('car_name');
        $product->car_type = $request->input('car_type');
        $product->car_description = $request->input('car_description');
        $product->car_price = $request->input('car_price');
        $product->car_qty = $request->input('car_qty');
        $product->car_status = $request->input('car_status')== TRUE ? '1':'0';
        $product->car_trending = $request->input('car_trending')== TRUE ? '1':'0';
        $product->save();
        return redirect('products')->with('status', 'Product Successfully Added');
    }

    public function edit($id){

        $product = Product::find($id);
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, $id){

        $product = Product::find($id);
        if($request->hasFile('image'))
        {
            $path = "assets/uploads/products/".$product->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/products/',$filename);
            $product->image = $filename;
        }
        $product->car_name = $request->input('car_name');
        $product->car_type = $request->input('car_type');
        $product->car_description = $request->input('car_description');
        $product->car_price = $request->input('car_price');
        $product->car_qty = $request->input('car_qty');
        $product->car_status = $request->input('car_status')== TRUE ? '1':'0';
        $product->car_trending = $request->input('car_trending')== TRUE ? '1':'0';
        $product->update();
        return redirect('products')->with('status', "Product updated successfully");

    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if($product->image)
        {
            $path = "assets/uploads/products/".$product->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
        }
        $product->delete();
        return redirect('products')->with('status',"Product Deleted Success");
    }
}
