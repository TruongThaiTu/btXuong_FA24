<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Employee::query()->latest('id')->paginate(5);

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
        // $data = $request->validate( [
        //     'first_name'        => 'required|max:100',
        //     'last_name'         => 'required|max:100',
        //     'email'             => 'required|email|max:150',
        //     'phone'             => 'required', 'string', 'max:15',
        //     'salary'            => 'required',
        //     'is_active'         => ['nullable', Rule::in([0, 1]) ],
        //     'address'           => 'required|max:1000',
        //     'profile_picture'   => 'nullable|image|max:2048',
        // ]);

        $validator = Validator::make($request->all(), [
            'first_name'        => 'required|max:100',
            'last_name'         => 'required|max:100',
            'email'             => 'required|email|max:150',
            'phone'             => 'required', 'string', 'max:10',
            'salary'            => 'required',
            'is_active'         => ['nullable', Rule::in([0, 1]) ],
            'address'           => 'required|max:1000',
            // 'profile_picture'   => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json( [
                'status'  => false,
                'message' =>'thêm mới dữ liệu không thành công',
                'data'    => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        try {
            $employee = Employee::query()->create($data);

            return response()->json( [
                'status'  => true,
                'message' =>'thêm mới dữ liệu thành công',
                'data'    => $employee
            ], 201);

        } catch (\Throwable $th) {

            return response()->json( [
                'status'  => false,
                'message' =>'lỗi hệ thống',
            ], 500);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);

        if ($employee) {
        return response()->json( [
            'status' => true,
            'message' => 'hiển thị dữ liệu thành công',
            'data' => $employee
        ]);
     }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $validator = Validator::make($request->all(), [
            'first_name'        => 'required|max:100',
            'last_name'         => 'required|max:100',
            'email'             => 'required|email|max:150',
            'phone'             => 'required', 'string', 'max:10',
            'salary'            => 'required',
            'is_active'         => ['nullable', Rule::in([0, 1]) ],
            'address'           => 'required|max:1000',
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
           $employee->update($data);
            

            return response()->json( [
                'status'  => true,
                'message' =>'thay đổi dữ liệu thành công',
                'data'    => $employee
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
        Employee::destroy($id);


    }
}
