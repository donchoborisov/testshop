@extends('layouts.app')

@section('content')

<div class="container-fluid">

<div class="row justify-space-bewteen  mt-5">

@foreach($allproducts as $product)
<div class="col-lg-4 col-sm-6 mt-3 ">
<div class="card text-center shadow">

<div>
  <img src="{{asset($product->image)}}" class="card-img-top mt-3 product-img img-fluid" alt="...">
</div>
 
  <div class="card-body">
    <h5 class="card-title">{{$product->title}}</h5>
    <p class="card-text"><b>Price:</b>  {{$product->price}}</p>
    <a href="{{url('/single/product/' . $product->id)}}" class="btn btn-primary">View product</a>
  </div>
</div>
</div>

@endforeach


</div>



</div>









@endsection
