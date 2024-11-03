@extends('products.layout')

@section('content')
    <div class="card">
        <h2 class="card-header">Laravel CRUD With Image</h2>
        <div class="card-body">
            @session('success')
                <div class="alert alert-success" role="alert">
                    {{ $value }}
                </div>
            @endsession
            <div class="d-grip gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('products.create') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i> Create New Product
                </a>
            </div>
            <table class="table table-bordered table-striped mt-4 text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td class="text-truncate" style="max-width: 50px">{{ $product->id }}</td>
                            <td>
                                @php
                                    $arr = explode(',', $product->images);
                                @endphp
                                @foreach ($arr as $key => $item)
                                    <img src="/storage/{{ $item }}" alt="" class="img-thumbnail" style="height: 60px; width: 60px; border-radius: 50%; object-fit: cover;">
                                @endforeach
                            </td>
                            <td>{{ $product->name }}</td>
                            <td width="250" class="text-truncate" style="max-width: 300px">{{ $product->desc }}</td>
                            <td width="250">
                                <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning text-white btn-sm">
                                        <i class="fa fa-pen"></i> Edit
                                    </a>

                                    <a href="{{ route("products.show", $product->id) }}" class="btn btn-primary text-white btn-sm"><i class="fa fa-eye"></i> Show</a>

                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Empty Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
