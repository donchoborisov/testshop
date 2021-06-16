@extends('layouts.app')

@section('content')



<section>
    <div class="container-fluid">
       
        <div class="row banner-contact justify-content-center align-items-center ">
            <div class="col-sm-10 text-right">
                <h1 class="display-3 text-capitalize"><span class="text-info">Check out</span></h1>
                    
                    
                  
            </div>

        </div>
    </div>


  </section>
 
    <div class="container-fluid  ">
        <div class="row justify-content-around ">


            <div  class="col-lg-4 col-sm-8 col-xs-12 mt-2 border text-center">


            
                <div class=" mb-5 ">
                <h5 class="font-weight-bolder mt-2">Product Information</h5>
                </div>

                <div class="row  mb-3 pt-3">
               
               <div class="col-10 ">
               <p  class="font-weight-bold">{{$checkoutproduct->name}}</p>
               <img src="{{asset($checkoutproduct->image)}}" style="150px; width:150px" >
               </div>
           </div> 

                <div class="row mb-3 pt-3 ">
                <div class="col-10">
              Price <p  class="font-weight-bold">{{$checkoutproduct->price}}</p>
            </div>
        </div>
        
      
       
                
                  
               
              </div>


              <div class="col-lg-4 col-md-6 col-sm-6 mt-2">
                  <div class="contact-heading mb-3">
                <h5 class="font-weight-bolder">Enter your e-mail</h5>
                </div>
                @if (session('status'))
                        <div class="alert alert-danger">
                            {{ session('status') }}
                        </div>
                    @endif
              
               
                <form id="mailform" action="{{route('payment.process')}}" class="mt-5"  method="POST" action="">@csrf
                   
                        <div class="col" >
                          <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email">
                          <input type="hidden"  name="pid" value={{$checkoutproduct->id}} >
                          @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          <button type="submit" class="btn btn-info mt-3 ">Pay now</button>
                        </div>
                      </div>
                  
                    
                      
                </form>
              
              
              </div>

           

               
      
              



         </div>    
      

          
    </div>



@endsection