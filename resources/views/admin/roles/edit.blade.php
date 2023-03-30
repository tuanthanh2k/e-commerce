@extends('admin.layouts.app')
@section('title', 'Edit Role'.$role->name)
@section('content')
    <div class="cart">
        <h1>
            Edit Role
        </h1>

        <div>
            <form action="{{ route('roles.update', $role->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="input-group input-group-static mb-4">
                    <label>Name</label>
                    <input type="text" value="{{ old('name') ?? $role->name }}" name="name" class="form-control">
                    @error('name')
                    <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="input-group input-group-static mb-4">
                    <label>Display Name</label>
                    <input type="text" value="{{ old('display_name') ?? $role->display_name }}" name="display_name" class="form-control">
                    @error('display_name')
                    <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="input-group input-group-static mb-4">
                    <label class="ms-0">Group</label>
                    <select class="form-control" name="group" value="{{ old('group') ?? $role->group }}">
                        <option>User</option>
                        <option>system</option>
                    </select>
                    @error('group')
                    <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Permission</label>
                    <div class="row">
                        @foreach($permissions as $groupName => $permission)
                            <div class="col-5">
                                <h4>{{ $groupName }}</h4>
                                <div>
                                    @foreach($permission as $per)
                                        <div class="form-check">
                                            {{ $role->permissions->contains('name', $per->name) ? 'checked' : '' }}
                                            <input class="form-check-input" type="checkbox" value="{{ $per->id }}" name="permission_ids[]">
                                            <label class="custom-control-label" for="customCheck1">{{ $per->display_name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-submit btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
