@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your Products</div>

                <div class="card-body">

               
                
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                



<a href="{{route('product.create')}}"><button  class="btn btn-success btn-sm mt-3">Add Product <i class="fas fa-plus"></i></button></a>

               



 <table class="table caption-top mt-5">
 
  <thead>
    <tr>
      
      <th scope="col">Name</th>
      <th scope="col">Image</th>
      <th scope="col">Price</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($products as $product)
    <tr>
      
      <td>{{$product->name}}</td>
      <td><img style="width:30px;" src="{{asset($product->image)}}"></td>
      <td>{{$product->price}}</td>
      <td><a href="{{url('product/'. $product->id . '/edit')}}" > <i class="far fa-edit text-info"></i></a> | <a href="#" id="{{$product->id}}" onclick="getid(this.id)" data-bs-toggle="modal" data-bs-target="#exampleModal"  ><i class="fas fa-trash text-danger"  ></i></a></td>
    </tr>
 
 @endforeach
  </tbody>
</table>


                  
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  
    <div class="modal-content">
    <form action="{{route('product.remove')}}" method="post">@csrf 
    @method('DELETE')
      <div class="modal-header">
      
     
      </div>
      <div class="modal-body text-center">
     
      <i class="fas fa-exclamation-triangle fa-2x text-danger "></i>
        <h2>Are you sure ?</h2>
       
        <input type="hidden" id="pid" name="pid" value="">
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-danger">Yes</button>
       
        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
      </div>
      </form>
    </div>
  </div>
  
</div>

<script type="text/javascript">
    function getid(id){
        $.ajax({
         url: "{{ url('/product/remove') }}/"+id, 
         type: "GET",
         dataType:"json",
         success:function(data){
       $('#pid').val(data.id);
       
     }  
        })
    }
 </script>   


@endsection
