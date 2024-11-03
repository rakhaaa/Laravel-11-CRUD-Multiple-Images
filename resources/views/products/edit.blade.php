@extends('products.layout')

@section('content')
    <div class="card">
        <h2 class="card-header">Edit Product</h2>
        <div class="card-body">

            <div class="d-grip gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('products.index') }}" class="btn btn-info text-white">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="inputImage" class="form-label"><strong>Images: </strong></label>
                    <div class="row mb-2">
                        @php
                            $images = explode(',', $product->images);
                        @endphp
                        <div class="col-sm">
                            @forelse ($images as $image)
                                <img src="/storage/{{ $image }}" alt="" class="img-thumbnail"
                                    style="height: 200px; width: 200px; object-fit: contain;">
                            @empty
                                <span></span>
                            @endforelse
                        </div>
                    </div>
                    <input type="file" name="images[]" id="inputImage" class="form-control" placeholder="Images"
                        multiple>
                </div>

                <div class="mb-3">
                    <label for="inputName" class="form-label"><strong>Name: </strong></label>
                    <input type="text" name="name" id="inputName" value="{{ $product->name }}"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Name Product">
                    @error('name')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="inputDesc" class="form-label"><strong>Description: </strong></label>
                    <textarea name="desc" id="inputDesc" style="height:150px" class="form-control" placeholder="Description">{{ $product->desc }}</textarea>
                </div>

                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Update
                    Product</button>
            </form>

        </div>
    </div>
@endsection
