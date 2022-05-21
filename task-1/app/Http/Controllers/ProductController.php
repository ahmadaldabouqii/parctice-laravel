<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Eloquent;
/**
 * Product
 *
 * @mixin Eloquent
 */

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product-views.products', ['products' => Product::getAllProducts()]);
    }

    public function addProduct()
    {
        return view('admin.product-views.add-product', ['sub_categories' => SubCategory::getAllSubCategories()]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $product = new Product();

        $request->validate([
            'image'          => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'name'           => 'required|min:3|max:20',
            'parentCategory' => 'required',
            'price'          => 'required|min:3'
        ]);

        $image = $request->file('image');
        $input['image'] = strtolower(str_replace(' ','-', $image->getClientOriginalName()));
        $destinationPath = public_path('storage/uploads');

        if(!file_exists(public_path('storage/uploads' . $input['image']))){
            $image->move($destinationPath, $input['image']);
        }

        $parent                   = SubCategory::findOrFail($request->parentCategory);
        $product->image           = $input['image'];
        $product->name            = $request->name;
        $product->parent_category = $parent->name;
        $product->price           = $request->price;
        $product->save();

        Alert::success('Added!', 'Product added successfully!');
        return redirect()->route('admin.product.products');
    }

    public function show(Product $product)
    {
        //
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product-views.edit', [
           'product' => $product,
           'sub_categories' => SubCategory::getAllSubCategories()
        ]);
    }

    public function update(Request $request, $id)
    {
        $product  = Product::findOrFail($id);
        $products = Product::getAllProducts();
        $parent   = SubCategory::findOrFail($request->parentCategory);

        $request->validate([
            'image'          => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'name'           => 'required|min:3|max:20',
            'parentCategory' => 'required',
            'price'          => 'required|min:3'
        ]);

        if($request->hasFile('image')){
            foreach ($products as $cloudProduct){
                if($cloudProduct->image !== $product->image){
                    unlink(public_path('storage/uploads/' . strtolower($product->image)));
                }
            }

            $input['image'] = strtolower(str_replace(' ', '-', $request->file('image')->getClientOriginalName()));
            $request->file('image')->move(public_path('storage/uploads'), $input['image']);
            $product->image = $input['image'];
        }

        $product->name            = $request->name;
        $product->parent_category = $parent->name;
        $product->price           = $request->price;
        $product->update();

        Alert::success("Updated!","Product updated successfully");
        return redirect()->route("admin.product.products");
    }

    public function filterProducts(Request $request)
    {
        $request->validate([
           'filterProducts' => 'required'
        ]);

        $filterProductValue = $request->filterProducts;
        $products = [];

        switch ($filterProductValue){
            case 'ascending': $products = Product::orderBy('price', 'ASC')->get();
            break;
            case 'descending': $products = Product::orderBy('price', 'DESC')->get();
            break;
            default: Product::getAllProducts();
        }

        return view('admin.product-views.products', ['products' => $products]);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        Alert::Success('Deleted!', 'Product successfully deleted!');
        return redirect()->back();
    }
}
