<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class CartController extends Controller
{
    public function addToCart(Request $request) {
        $user_id = $request->user_id;
        $product_id = $request->product_id;

        if (Cart::where('product_id', $product_id)->where('user_id', $user_id)->exists()) {
            return response()->json(['Product existed in cart', 400]);
        } else {
            $cart = Cart::create($request->all());
        }

        return response()->json($cart, 200);
    }

    public function showCart() {
        $cart = Cart::all();

        return response()->json($cart, 200);
    }

    public function updateQuantity(Request $request) {
        $product = Cart::where('user_id', $request->user_id)
                        ->where('product_id', $request->product_id)->first();

        if ($product == null) {
            return response()->json(['Product does not exist', 400]);
        } else {
            $product->quantity = $request->quantity;
        }

        $product->save();

        return response()->json($product, 200);
    }

    public function deleteProduct(Request $request, $id) {
        $product = Cart::where('user_id', $request->user_id)
                        ->where('product_id', $id)->first();

        if ($product == null) {
            return response()->json(['Product does not exist', 400]);
        } else {
            $result = $product->delete();
        }

        return response()->json(['Delete completed!', 200]);
    }

}
