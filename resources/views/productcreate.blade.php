@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Products</div>

                <div class="card-body">

               


                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

<form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">@csrf
  <div class="mb-3">
    <label for="name" class="form-label">Product name</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name">

                               @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
    
  </div>
  <div class="mb-3">
    <label for="price" class="form-label">Product Price</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="price" id="price">
                              @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
  </div>
  <div class="mb-3">
    <label for="image" class="form-label">Product Image</label>
    <input type="file" class="form-control @error('name') is-invalid @enderror" name="image" id="image">
                               @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
  </div>
<div class="d-flex justify-content-between">
  <button type="submit" class="btn btn-primary">Submit</button>
  <a href="{{route('home')}}" class="btn btn-danger text-right">Cancel</a>
  </div>
</form>





                  
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
