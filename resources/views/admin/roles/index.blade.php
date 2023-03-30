@extends('admin.layouts.app')
@section('title', 'roles')
@section('content')
    <div class="card">
        @if (session('message'))
            <h1 class="text-primary">{{ session('message') }}</h1>
        @endif
        <h1>
            Role List
        </h1>
        <div>
            <a href="{{ route('roles.create') }}" class="btn btn-primary">Create</a>
        </div>
        <div>
            <table class="table table-hover">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>DisplayName</th>
                    <th>Action</th>
                </tr>

                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->display_name }}</td>
                        <td>
                            @can('update_role')
                                <a class="btn btn-warning" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                            @endcan
                            @can('delete-role')
                                <form method="post" action="{{ route('roles.destroy', $role->id) }}"
                                    id="form-delete{{ $role->id }}">
                                    @csrf
                                    @method('Delete')
                                </form>
                                <button class="btn btn-delete btn-danger" data-id="{{ $role->id }}">Delete</button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $roles->links() }}
        </div>
    </div>
@endsection
