@extends('admin.master')

@section('title')
    xem chi tiết sinh viên
@endsection

@section('content')
    <div class="container">
        <h2>Thông Tin Chi Tiết Sinh Viên</h2>

        <!-- Thông Tin Sinh Viên -->
        <div class="card mb-4">
            <div class="card-header">
                Thông Tin Sinh Viên
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $student->id }}</p>
                <p><strong>Tên:</strong> {{ $student->name }}</p>
                <p><strong>Email:</strong> {{ $student->email }}</p>
                <p><strong>Lớp Học:</strong> {{ $student->classroom->name }} - Giáo Viên:
                    {{ $student->classroom->teacher_name }}</p>
                <p><strong>Ngày Tạo:</strong> {{ $student->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Ngày Cập Nhật:</strong> {{ $student->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <!-- Thông Tin Hộ Chiếu -->
        <div class="card mb-4">
            <div class="card-header">
                Thông Tin Hộ Chiếu
            </div>
            <div class="card-body">
                @if ($student->passport)
                    <p><strong>Số Hộ Chiếu:</strong> {{ $student->passport->passport_number }}</p>
                    <p><strong>Ngày Cấp:</strong>
                        {{ \Carbon\Carbon::parse($student->passport->issued_date)->format('d/m/Y') }}</p>
                    <p><strong>Ngày Hết Hạn:</strong>
                        {{ \Carbon\Carbon::parse($student->passport->expiry_date)->format('d/m/Y') }}</p>
                @else
                    <p>Chưa có thông tin hộ chiếu.</p>
                @endif
            </div>
        </div>

        <!-- Môn Học Đăng Ký -->
        <div class="card mb-4">
            <div class="card-header">
                Môn Học Đăng Ký
            </div>
            <div class="card-body">
                @if ($student->subjects->count() > 0)
                    <ul class="list-group">
                        @foreach ($student->subjects as $subject)
                            <li class="list-group-item">
                                {{ $subject->name }} ({{ $subject->credits }} tín chỉ)
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>Chưa đăng ký môn học nào.</p>
                @endif
            </div>
        </div>

        <!-- Nút Hành Động -->
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary">Chỉnh sửa</a>
    </div>
@endsection
