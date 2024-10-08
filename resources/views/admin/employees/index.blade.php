@extends('admin.master')

@section('title')
    Danh sách nhân viên
@endsection

@section('content')
    <h1>danh sách nhân viên

        <a class="btn btn-info" href="{{ route('employees.create') }}">create</a>
    </h1>

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
    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">first_name</th>
                    <th scope="col">last_name</th>
                    <th scope="col">email</th>
                    <th scope="col">phone</th>
                    <th scope="col">date_of_birth</th>
                    <th scope="col">hire_date</th>
                    <th scope="col">salary</th>
                    <th scope="col">is_active</th>
                    <th scope="col">department_id</th>
                    <th scope="col">manager_id</th>
                    <th scope="col">address</th>
                    <th scope="col">profile_picture</th>
                    <th scope="col">created_at</th>
                    <th scope="col">updated_at</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $employee)
                    <tr class="">
                        <td scope="row">{{ $employee->id }}</td>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->date_of_birth }}</td>
                        <td>{{ $employee->hire_date }}</td>
                        <td>{{ $employee->salary }}</td>
                        <td>
                            @if ($employee->is_active)
                                <span class="badge bg-primary">Yes</span>
                            @else
                                <span class="badge bg-danger">No</span>
                            @endif
                        </td>
                        <td>{{ $employee->department_id }}</td>
                        <td>{{ $employee->manager_id }}</td>
                        <td>{{ $employee->address }}</td>
                        <td>
                            @if ($employee->profile_picture)
                                <img src="{{ Storage::url($employee->profile_picture) }}" width="100px">
                            @endif
                        </td>
                        <td>{{ $employee->created_at }}</td>
                        <td>{{ $employee->updated_at }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('employees.show', $employee) }}">show</a>
                            <a class="btn btn-warning" href="{{ route('employees.edit', $employee) }}">edit</a>

                            <form action="{{ route('employees.destroy', $employee) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" onclick="return confirm('có chắc chắn xóa không?')"
                                    class="btn btn-danger">
                                    XM
                                </button>
                            </form>

                            <form action="{{ route('admin.employees.forceDestroy', $employee) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" onclick="return confirm('có chắc chắn xóa không?')"
                                    class="btn btn-dark">
                                    XC
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $data->links() }}
    </div>
@endsection
