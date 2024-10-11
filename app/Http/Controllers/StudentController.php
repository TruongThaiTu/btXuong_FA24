<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Passport;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    const PATH_VIEW = 'admin.students.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Student::latest('id')->paginate(5);

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $classrooms = Classroom::all();
        $subjects = Subject::all();

        return view(self::PATH_VIEW . __FUNCTION__, compact('classrooms', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:students,email',
            'classroom_id' => 'required|exists:classrooms,id',
            'passport_number' => 'required|string|max:50|unique:passports,passport_number',
            'issued_date' => 'required|date',
            'expiry_date' => 'required|date|after:issued_date',
            'subjects' => 'required|array',
            'subjects.*' => 'exists:subjects,id',
        ]);

        try {
            // Bước 2: Bắt đầu transaction để đảm bảo tính toàn vẹn dữ liệu
            DB::beginTransaction();

            // Bước 3: Tạo sinh viên
            $student = Student::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'classroom_id' => $validatedData['classroom_id'],
            ]);

            // Bước 4: Tạo hộ chiếu cho sinh viên
            Passport::create([
                'student_id' => $student->id,
                'passport_number' => $validatedData['passport_number'],
                'issued_date' => $validatedData['issued_date'],
                'expiry_date' => $validatedData['expiry_date'],
            ]);

            // Bước 5: Liên kết các môn học cho sinh viên
            $student->subjects()->attach($validatedData['subjects']);

            // Bước 6: Hoàn thành transaction
            DB::commit();

            return redirect()
                ->route('students.index')
                ->with('success', true);
        } catch (\Throwable $th) {
            // Bước 7: Nếu có lỗi, rollback transaction
            DB::rollBack();

            return back()
                ->with('success', false)
                ->with('error', $th->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student->load(['passport', 'classroom', 'subjects']);

        return view(self::PATH_VIEW . __FUNCTION__, compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $classrooms = Classroom::all();
        $subjects = Subject::all();

        return view(self::PATH_VIEW . __FUNCTION__, compact('student', 'classrooms', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:150',
            'classroom_id' => 'required',
            'passport_number' => 'required',
            'issued_date' => 'required|date',
            'expiry_date' => 'required|date',
            'subjects' => 'required|array'
        ]);

        try {
            // Cập nhật thông tin sinh viên
            $student->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'classroom_id' => $data['classroom_id'],
            ]);

            // Cập nhật thông tin hộ chiếu
            if ($student->passport) {
                $student->passport->update([
                    'passport_number' => $data['passport_number'],
                    'issued_date' => $data['issued_date'],
                    'expiry_date' => $data['expiry_date'],
                ]);
            } else {
                // Nếu chưa có hộ chiếu, bạn có thể tạo mới nếu cần
                $student->passport()->create([
                    'passport_number' => $data['passport_number'],
                    'issued_date' => $data['issued_date'],
                    'expiry_date' => $data['expiry_date'],
                ]);
            }

            // Cập nhật môn học
            $student->subjects()->sync($data['subjects']); // Sync subjects

            return redirect()
                ->route('students.index')
                ->with('success', true);
        } catch (\Throwable $th) {
            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try {
            $student->delete();

            return back()->with('success', true);
        } catch (\Throwable $th) {
            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }
}
