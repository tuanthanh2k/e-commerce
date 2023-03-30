@extends('admin.layouts.app')
@section('title', 'Categories')
@section('content')
    <div class="card">
        @if (session('message'))
            <h1 class="text-primary">{{ session('message') }}</h1>
        @endif
        <h1>
            Category List
        </h1>
        <div>
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Create</a>
        </div>
        <div>
            <table class="table table-hover">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Parent Name</th>
                    <th>Action</th>
                </tr>

                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->parent_name }}</td>
                        <td>
                            @can('update-category')
                                <a class="btn btn-warning" href="{{ route('categories.edit', $category->id) }}">Edit</a>
                            @endcan
                            @can('delete-category')
                                <form method="post" action="{{ route('categories.destroy', $category->id) }}"
                                    id="form-delete{{ $category->id }}">
                                    @csrf
                                    @method('Delete')
                                </form>
                                <button class="btn btn-delete btn-danger" data-id="{{ $category->id }}">Delete</button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $categories->links() }}
        </div>
    </div>
@endsection
