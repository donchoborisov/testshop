@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit {{$products->name}}</div>

                <div class="card-body">

               


                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
<div class="mt-5">
<form action="{{ url('/product/'.$products->id)}}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
  <div class="mb-3">
    <label for="name" class="form-label">Product name</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$products->name}}" id="name">

                               @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
    
  </div>
  <div class="mb-3">
    <label for="price" class="form-label">Product Price</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="price" value="{{$products->price}}" id="price">
                              @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
  </div>
  <div class="mb-3 text-center">
    
    <image src="{{asset($products->image)}}">
    <div class="mt-3">
    <input type="file" class="form-control @error('name') is-invalid @enderror" name="new_image" id="image">
                               @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>                           
  </div>
  <div class="d-flex justify-content-between">
  <button type="submit" class="btn btn-primary">Update</button>
  <a href="{{route('home')}}" class="btn btn-danger text-right">Cancel</a>
  </div>
</form>
</div>




                  
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
