<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    const CART_STATUS_PENDING = 'pending';
    const CART_STATUS_ORDERED = 'ordered';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'total',
        'status',
    ];

    public function createCart($product_id, $quantity){
        $identifiers = [
            'user_id' => auth()->user()->id,
            'status' => self::CART_STATUS_PENDING
        ];
        $cart = $this->firstOrNew($identifiers, $identifiers);
        //cart already exist
        if($cart->id){
            $cart = $this->addProduct($cart, $product_id, $quantity);
        }else{
            $cart = $this->addFirstProduct($cart, $product_id, $quantity);
        }
        return $cart;
    }

    private function addFirstProduct($cart, $product_id, $quantity){
        $cart->total = $this->getPrice($product_id, $quantity);
        $cart->save();
        $cart->products()->attach($product_id, ['quantity' => $quantity]);
        return $cart;
    }

    private function getPrice($product_id, $quantity){
        $product = Product::find($product_id);
        return $product->getPrice() * $quantity;
    }

    private function addProduct($cart, $product_id, $quantity){
        $product = $cart->products()->find($product_id);
        $cart->total = $cart->total + $this->getPrice($product_id, $quantity);
        $cart->save();
        if($product){
            $cart->products()->updateExistingPivot($product_id, [
                'quantity' => $product->pivot->quantity + $quantity,
            ]);
            
        }else{
            $cart->products()->attach($product_id, ['quantity' => $quantity]);
        }
        return $cart;
    }

    /**
     * The products that belong to the cart.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
