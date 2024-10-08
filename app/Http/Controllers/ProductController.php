<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    const PATH_VIEW = 'admin.products.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::latest('id')->paginate(5);

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|max: 255',
            'description'   => 'required',
            'price'         => 'required',
            'quantity'      => 'required',
            'is_active'     => ['nullable', Rule::in([0, 1])],
            'image'         => 'nullable|image|max: 2048',
        ]);

        try {
            if ($request->hasFile('image')) {
                $data['image'] = Storage::put('products', $request->file('image'));
            }

            Product::query()->create($data);

            return redirect()
                ->route('products.index')
                ->with('success', true);
        } catch (\Throwable $th) {

            if (!empty($data['image']) && Storage::exists($data['image'])) {
                Storage::delete($data['image']);
            }

            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
