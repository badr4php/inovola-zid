<?php

namespace App\Http\Controllers\Consumers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Consumers\CartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;

class CartController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function add(CartRequest $request, Cart $cart)
    {
        $this->authorize('add', Cart::class);
        $cart = $cart->createCart($request->get('product_id'), $request->get('quantity'));
        return new CartResource($cart);
    }
}
