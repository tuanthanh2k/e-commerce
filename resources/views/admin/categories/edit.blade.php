@extends('admin.layouts.app')
@section('title', 'Edit Categories'.$categories->name)
@section('content')
    <div class="cart">
        <h1>
            Edit Role
        </h1>

        <div>
            <form action="{{ route('categories.update', $categories->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="input-group input-group-static mb-4">
                    <label>Name</label>
                    <input type="text" value="{{ old('name') ?? $categories->name }}" name="name" class="form-control">
                    @error('name')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                @if ($categories->childrens->count() < 1)
                    <div class="input-group input-group-static mb-4">
                        <label class="ms-0">Parent Category</label>
                        <select name="parent_ids" class="form-control">
                            <option value="">Select Parent Category</option>
                            @foreach ($parentCategories as $category)
                                <option value="{{ $category->id }}" {{ (old('parent_ids') ?? $categories->parent_id) == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                            @endforeach
                        </select>

                        @error('parent_ids')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                @endif
                <button type="submit" class="btn btn-submit btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
