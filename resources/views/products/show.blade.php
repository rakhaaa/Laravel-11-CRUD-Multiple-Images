@extends('products.layout')

@section('content')
    <div class="card">
        <h2 class="card-header">Show Product</h2>
        <div class="card-body">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-info text-white btn-sm" href="{{ route('products.index') }}"><i class="fa fa-arrow-left"></i>
                    Back</a>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <strong>Images:</strong> <br />
                        @php
                            $images = explode(',', $product->images);
                        @endphp
                        <div class="col-sm mt-2">
                            @forelse ($images as $image)
                                <img src="/storage/{{ $image }}" alt="" class="img-thumbnail m-1"
                                    style="height: 200px; width: 200px; object-fit: contain;">
                            @empty
                                <span></span>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong> <br />
                        {{ $product->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <strong>Description:</strong> <br />
                        {{ $product->desc }}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
