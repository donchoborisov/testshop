<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductCreationRequest;
use Illuminate\Support\Str;
use App\Product;
use Auth;
use DB;
use Response;

class ProductsController extends Controller
{
    
    public function allproducts()
    {

       
       
            $allproducts = Product::all()->sortBy('created_at');
            return view('allproducts',compact('allproducts'));
       
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productcreate');
    }

  
    public function store(ProductCreationRequest $request)
    {


        $file = $request->file('image');
        $name = Str::random(10);
        $url = \Storage::putFileAs('images',$file, $name . '.' .$file->extension());
        
              
        $product = new Product([

            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'price' => $request->price,
            'image' => $url

        ]);

       

        $product->save();

        return redirect()->back()->with("status","Successfully Created");

        
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $products = Product::where('id',$id)->first();

        return view('productedit',compact('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->has('new_image')) {

        $product = Product::where('id',$id)->first();  

        $old_image = $product->image;
        unlink($old_image);


        $file = $request->file('new_image');
        $name = Str::random(10);
        $url = \Storage::putFileAs('images',$file, $name . '.' .$file->extension());

        $data = array();
        $data['name'] = $request->name;
        $data['price'] = $request->price;
        $data['image'] = $url;

        $update = DB::table('products')->where('id',$id)->update($data);



        } else {
            $product = Product::find($id);
            $product->update($request->only('name','price'));
        }

        return redirect()->back()->with("status","Successfully Updated");



    }


    public function modal($id){

        $productid = Product::where('id',$id)->first();

        return response::json($productid);

    }

    public function delete(Request $request){

        $id = $request->pid;

        Product::destroy($id);

       return redirect()->route('home')->with("Status","Product Deleted");
    }


    public function single($id) {
       
        $product = Product::where('id',$id)->first();

        return view('singleproduct',compact('product'));


    }

    public function checkout($id){

        $checkoutproduct = Product::where('id',$id)->first();

        return view('checkout',compact('checkoutproduct'));
        
    }


public function show(){
    


}   

}
