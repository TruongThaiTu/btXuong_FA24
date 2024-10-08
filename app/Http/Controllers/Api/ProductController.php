<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::query()->latest('id')->paginate(5);

        return response()->json( [
            'status'  => true,
            'message' =>'lấy dữ liệu thành công',
            'data'    => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        if ($product) {
        return response()->json( [
            'status' => true,
            'message' => 'hiển thị dữ liệu thành công',
            'data' => $product
        ]);
     }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|max: 255',
            'description'   => 'required',
            'price'         => 'required|min: 30000|max: 100000',
            'quantity'      => 'required',
            'is_active'     => ['nullable', Rule::in([0, 1]) ],
            // 'image'         => 'nullable|image|max: 2048',
            // 'profile_picture'   => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json( [
                'status'  => false,
                'message' =>'thay đổi dữ liệu không thành công',
                'data'    => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        try {
           $product->update($data);
            

            return response()->json( [
                'status'  => true,
                'message' =>'thay đổi dữ liệu thành công',
                'data'    => $product
            ], 201);

        } catch (\Throwable $th) {

            return response()->json( [
                'status'  => false,
                'message' =>'lỗi hệ thống',
            ], 500);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
