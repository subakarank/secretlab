<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderPostRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all()->sortBy('timestamp');
        return $this->customResponse($orders);
    }

    /**
     * Store a newly created resource in storage and update if the key iis existed
     *
     * @param  OrderPostRequest $orderPostRequest
     * @return \Illuminate\Http\Response
     */
    public function store(OrderPostRequest $orderPostRequest)
    {
        $data = $orderPostRequest->only('name', 'value', 'updated_at');
        $order = Order::updateOrCreate(
            [
                'name' => $data['name']
            ], 
            [
                'value' => $data['value'],
                'updated_at' => $data['updated_at']
        ]);
        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  $name
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($name, Request $request)
    {
        $order = Order::where('name', $name);
        if ( is_null($order->first())) {
            return $this->error(['message' => 'No key is found'], Response::HTTP_BAD_REQUEST);
        }
        // check request has timestamp or not and if have the apply for the filter
        if ( $request->has('timestamp')) {
            $order = $order->where('updated_at', $request->get('timestamp'));
        }
        $order = $order->first();
        return ($order) ? new OrderResource($order): 
                $this->error(['message' => 'No value is found for the given key and timestamp'], Response::HTTP_BAD_REQUEST);
        
    }
}
