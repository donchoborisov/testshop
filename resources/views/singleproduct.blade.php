@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header"> {{$product->name}}</div>

                <div class="card-body">

               


<div class="mt-5">

  <div class="mb-3">
    <label for="name" class="form-label">Product name: {{$product->name}}</label>
   

                         
    
  </div>
  <div class="mb-3">
    <label for="price" class="form-label">Product Price: {{$product->price}}</label>
    
                          
  </div>
  <div class="mb-3 text-center">
    
    <image src="{{asset($product->image)}}" class="product-img-single">
    <div class="mt-3">
                            
  </div>
  <div class="d-flex justify-content-between">
  <a href="{{url('product/checkout/' . $product->id)}}" class="btn btn-primary">Buy</button>
  <a href="{{route('products.all')}}" class="btn btn-danger text-right">Cancel</a>
  </div>
</form>
</div>




                  
                </div>
            </div>
        </div>
    </div>
</div>
       




                  
        
    </div>
</div>



@endsection
