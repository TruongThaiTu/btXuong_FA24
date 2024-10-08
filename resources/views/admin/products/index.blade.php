@extends('admin.master')

@section('title')
    Danh sách sản phẩm
@endsection

@section('content')
    <h1>danh sách sản phẩm

        <a class="btn btn-info" href="{{ route('products.create') }}">create</a>
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
                    <th scope="col">description</th>
                    <th scope="col">price</th>
                    <th scope="col">quantity</th>
                    <th scope="col">is_active</th>
                    <th scope="col">image</th>
                    <th scope="col">created_at</th>
                    <th scope="col">updated_at</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $product)
                    <tr class="">
                        <td scope="row">{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>
                            @if ($product->is_active)
                                <span class="badge bg-primary">Yes</span>
                            @else
                                <span class="badge bg-danger">No</span>
                            @endif
                        </td>
                        <td>
                            @if ($product->image)
                                <img src="{{ Storage::url($product->image) }}" width="100px">
                            @endif
                        </td>
                        <td>{{ $product->created_at }}</td>
                        <td>{{ $product->updated_at }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('products.show', $product) }}">show</a>
                            <a class="btn btn-warning" href="{{ route('products.edit', $product) }}">edit</a>

                            <form action="{{ route('products.destroy', $product) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" onclick="return confirm('có chắc chắn xóa không?')"
                                    class="btn btn-danger">
                                    XM
                                </button>
                            </form>

                            <form action="{{ route('admin.products.forceDestroy', $product) }}" method="post">
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
