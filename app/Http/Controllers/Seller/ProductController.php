<?php

namespace App\Http\Controllers\Seller;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Seller\ProductStoreRequest;

class ProductController extends Controller
{

    // Get Product
    public function index()
    {
        try {
            $products = Product::where('user_id', Auth::id())
                ->with('category')
                ->latest()
                ->paginate(10);

            return view('seller.products.index', compact('products'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Unable to load products. Please try again.');
        }
    }

    // Store Product
    public function store(ProductStoreRequest $request)
    {
        try {
            $imagePath = null;

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                // Validate image size (20MB = 20480 KB)
                if ($image->getSize() > 20971520) { // 20MB in bytes
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['image' => 'Image size cannot exceed 20MB.']);
                }

                // Generate unique filename
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('products', $filename, 'public');
            }

            // Create product
            $product = Product::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'user_id' => Auth::id(),
                'image' => $imagePath,
            ]);

            return redirect()->route('seller.dashboard')
                ->flash('success', 'Product "' . $product->name . '" added successfully!');
        } catch (\Exception $e) {
            // Clean up uploaded image if product creation failed
            if (isset($imagePath) && $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to add product. Please try again.']);
        }
    }

    public function destroy(Product $product)
    {
        try {
            // Check if user owns this product
            if ($product->user_id !== Auth::id()) {
                return redirect()->back()->with('error', 'Unauthorized action.');
            }

            // Delete image if exists
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $productName = $product->name;
            $product->delete();

            return redirect()->back()
                ->with('success', 'Product "' . $productName . '" deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete product. Please try again.');
        }
    }
}
