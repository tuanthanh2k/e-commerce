@extends('admin.layouts.app')
@section('title', 'Coupon')
@section('content')
    <div class="card">
        @if (session('message'))
            <h1 class="text-primary">{{ session('message') }}</h1>
        @endif
        <h1>
            Coupon List
        </h1>
        <div>
            <a href="{{ route('coupons.create') }}" class="btn btn-primary">Create</a>
        </div>
        <div>
            <table class="table table-hover">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Expery Date</th>
                    <th>Action</th>
                </tr>

                @foreach ($coupons as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->type }}</td>
                        <td>{{ $item->value }}</td>
                        <td>{{ $item->expery_date }}</td>
                        <td>
                            @can('update-coupon')
                                <a class="btn btn-warning" href="{{ route('coupons.edit', $item->id) }}">Edit</a>
                            @endcan
                            @can('delete-coupon')
                                <form method="post" action="{{ route('coupons.destroy', $item->id) }}"
                                    id="form-delete{{ $item->id }}">
                                    @csrf
                                    @method('Delete')
                                </form>
                                <button class="btn btn-delete btn-danger" data-id="{{ $item->id }}">Delete</button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $coupons->links() }}
        </div>
    </div>
@endsection
