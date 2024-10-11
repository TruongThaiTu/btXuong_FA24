@extends('admin.master')

@section('title')
    Cập Nhật Sinh Viên
@endsection

@section('content')
    <h1>Cập Nhật Sinh Viên</h1>

    @if (session()->has('success') && !session()->get('success'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    @if (session()->has('success') && session()->get('success'))
        <div class="alert alert-info">
            Thao tác thành công
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Thông tin sinh viên -->
            <div class="card mb-4">
                <div class="card-header">
                    Thông Tin Sinh Viên
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="name">Tên Sinh Viên</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Nhập tên sinh viên" value="{{ old('name', $student->name) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email Sinh Viên</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Nhập email sinh viên" value="{{ old('email', $student->email) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="classroom_id">Lớp Học</label>
                        <select name="classroom_id" id="classroom_id" class="form-control" required>
                            <option value="">-- Chọn Lớp Học --</option>
                            @foreach ($classrooms as $classroom)
                                <option value="{{ $classroom->id }}"
                                    {{ old('classroom_id', $student->classroom_id) == $classroom->id ? 'selected' : '' }}>
                                    {{ $classroom->name }} - Giáo Viên: {{ $classroom->teacher_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Thông tin hộ chiếu -->
            <div class="card mb-4">
                <div class="card-header">
                    Thông Tin Hộ Chiếu
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="passport_number">Số Hộ Chiếu</label>
                        <input type="text" name="passport_number" class="form-control" id="passport_number"
                            placeholder="Nhập số hộ chiếu"
                            value="{{ old('passport_number', $student->passport->passport_number ?? '') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="issued_date">Ngày Cấp Hộ Chiếu</label>
                        <input type="date" name="issued_date" class="form-control" id="issued_date"
                            value="{{ old('issued_date', $student->passport->issued_date ?? '') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="expiry_date">Ngày Hết Hạn Hộ Chiếu</label>
                        <input type="date" name="expiry_date" class="form-control" id="expiry_date"
                            value="{{ old('expiry_date', $student->passport->expiry_date ?? '') }}" required>
                    </div>
                </div>
            </div>

            <!-- Chọn môn học -->
            <div class="card mb-4">
                <div class="card-header">
                    Môn Học Đăng Ký
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="subjects">Chọn Môn Học</label>
                        <select name="subjects[]" id="subjects" class="form-control" multiple required>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ collect(old('subjects', $student->subjects->pluck('id')->toArray()))->contains($subject->id) ? 'selected' : '' }}>
                                    {{ $subject->name }} ({{ $subject->credits }} tín chỉ)
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Giữ phím Ctrl (Windows) hoặc Command (Mac) để chọn nhiều môn
                            học.</small>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Cập Nhật</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
        </form>
    </div>
@endsection
