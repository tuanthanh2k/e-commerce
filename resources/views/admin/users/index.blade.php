@extends('admin.layouts.app')
@section('title', 'Users')
@section('content')
    <div class="card">

        <h1>
            User list
        </h1>
        @if (session('message'))
            <h1 class="text-primary">{{ session('message') }}</h1>
        @endif
        <div>
            <a href="{{ route('users.create') }}" class="btn btn-primary">Create</a>

        </div>
        <div>
            <table class="table table-hover">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>

                @foreach ($users as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><img src="{{ $item->images->count() > 0 ? asset('upload/users/' . $item->images->first()->url) : asset('upload/users/download.png') }}"
                                width="200px" height="200px" alt=""></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>

                        <td>{{ $item->phone }}</td>
                        <td>
                            @can('update-user')
                                <a href="{{ route('users.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                            @endcan
                            @can('delete-user')
                                <form action="{{ route('users.destroy', $item->id) }}" id="form-delete{{ $item->id }}"
                                    method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-delete btn-danger" type="submit"
                                        data-id={{ $item->id }}>Delete</button>
                                </form>
                            @endcan
                        </td>

                    </tr>
                @endforeach
            </table>
            {{ $users->links() }}
        </div>

    </div>

@endsection

@section('script')
@endsection
