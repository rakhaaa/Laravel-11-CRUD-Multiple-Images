<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::latest()->get();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // $data['image'] = isset($request->image) ? $request->image->storePublicly("images", "public") : "";

        $images = [];

        if (isset($request->images)) {
            foreach ($request->images as $image) {
                $images[] = $image->storePublicly("images", "public");
            }
        }

        $data['images'] = implode(',', $images);

        Product::create($data);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return view("products.edit", compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();

        $images = [];

        if ($request->images) {
            Storage::delete($product->images);
            foreach ($request->images as $image) {
                $images[] = $image->storePublicly('images', 'public');
            }
        }

        $data['images'] = implode(",", $images);

        $product->update($data);

        return redirect()->route("products.index")
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $arr = explode("," , $product->images);
        foreach($arr as $key => $value) {
            Storage::disk('public')->delete($value);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
