@extends('admin.layouts.app')
@section('title', 'Products')
@section('content')
    <div class="card">
        @if (session('message'))
            <h1 class="text-primary">{{ session('message') }}</h1>
        @endif
        <h1>
            Category List
        </h1>
        <div>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Create</a>
        </div>
        <div>
            <table class="table table-hover">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Sale</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>

                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td><img src="{{ $product->images->count() > 0 ? asset('upload/users/' . $product->images->first()->url) : asset('upload/users/download.png') }}"
                                width="200px" height="200px" alt=""></td>
                        <td>{{ $product->sale }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            @can('update-product')
                                <a class="btn btn-warning" href="{{ route('products.edit', $product->id) }}">Edit</a>
                            @endcan
                            @can('delete-product')
                                <a class="btn btn-warning" href="{{ route('products.show', $product->id) }}">Show</a>
                                <form method="post" action="{{ route('products.destroy', $product->id) }}"
                                    id="form-delete{{ $product->id }}">
                                    @csrf
                                    @method('Delete')
                                </form>
                                <button class="btn btn-delete btn-danger" data-id="{{ $product->id }}">Delete</button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $products->links() }}
        </div>
    </div>
@endsection
