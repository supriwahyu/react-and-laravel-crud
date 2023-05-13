<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::all();
        return response()->json($vendors);
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
    public function store(Request $request)
    {
        //Validate data
        $data = $request->only('name', 'adress', 'phone', 'email');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'adress' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, create new product
            $product = new Vendor;
            $product->name = $request->name;
            $product->adress = $request->adress;
            $product->phone = $request->phone;
            $product->email = $request->email;
            $product->save();

        //Product created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => $product
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Vendor::find($id);
    
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
    public function update(Request $request, Vendor $vendor)
    {
        //Validate data
        $data = $request->only('name', 'adress', 'phone', 'email');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'adress' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, update product
        $vendor = $vendor->update([
            'name' => $request->name,
            'adress' => $request->adress,
            'phone' => $request->phone,
            'email' => $request->email
        ]);

        //Product updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'data' => $vendor
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ], Response::HTTP_OK);
    }
}
