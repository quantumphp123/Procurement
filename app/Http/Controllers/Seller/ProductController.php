<?php

namespace App\Http\Controllers\Seller;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Seller\ProductStoreRequest;
use Illuminate\Support\Facades\Log;

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

                // Generate unique filename
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('products', $filename, 'public');
            }

            // Create product
            Product::create([
                'category_id' => $request->category_id,
                'user_id' => Auth::id(),
                'image' => $imagePath,
            ]);

            return redirect()->route('seller.dashboard')
                ->with('success', 'Product added successfully!');

        } catch (\Exception $e) {
            // Clean up uploaded image if product creation failed
            if (isset($imagePath) && $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            Log::error($e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to add product. Please try again.');
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

            $product->delete();

            return redirect()->back()
                ->with('success', 'Product deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete product. Please try again.');
        }
    }
}
