@extends('admin.master')

@section('title')
    Danh sách người dùng
@endsection

@section('content')
    <h1>danh sách người dùng

        <a class="btn btn-info" href="{{ route('users.create') }}">create</a>
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
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">email_verified_at</th>
                    <th scope="col">password</th>
                    <th scope="col">role</th>
                    <th scope="col">remember_token</th>
                    <th scope="col">created_at</th>
                    <th scope="col">updated_at</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $user)
                    <tr class="">
                        <td scope="row">{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->email_verified_at }}</td>
                        <td>{{ $user->password }}</td>
                        <td>
                            @if ($user->role == 'admin')
                                <span class="badge bg-primary">admin</span>
                            @else
                                <span class="badge bg-warning">client</span>
                            @endif
                        </td>
                        <td>{{ $user->remember_token }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('users.show', $user) }}">show</a>
                            <a class="btn btn-warning" href="{{ route('users.edit', $user) }}">edit</a>

                            <form action="{{ route('users.destroy', $user) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" onclick="return confirm('có chắc chắn xóa không?')"
                                    class="btn btn-danger">
                                    XM
                                </button>
                            </form>
                            <form action="{{ route('admin.users.forceDestroy', $user) }}" method="post">
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
