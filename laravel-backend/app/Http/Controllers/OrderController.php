<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Order;
use Session;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $product;
 


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $task = new Order;
      $task->title = $request->input('title'); //retrieving user inputs
      $task->description = $request->input('description');  //retrieving user inputs
      $task->save();
        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'data' => $orders
        ], Response::HTTP_OK);
    }


    public function show($id)
    {
        $product = Product::find($id);
    
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, product not found.'
            ], 400);
        }
    
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //Validate data
        $data = $request->only('name', 'category', 'price', 'quantity');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'category' => 'required',
            'price' => 'required',
            'quantity' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, update product
        $product = $product->update([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'quantity' => $request->quantity
        ]);

        //Product updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'data' => $product
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ], Response::HTTP_OK);
    }
}
