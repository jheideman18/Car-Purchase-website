<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;

class CartController extends Controller
{
    public function addProduct(Request $request)
    {
        $product_id = $request->input('product_id');

        if(Auth::check())
        {
            $prod_check = Product::where('id', $product_id)->first();

            if($prod_check)
            {
                if(Cart::where('prod_id', $product_id)->where('user_id', Auth::id())->exists())
                {
                    return response()->json(['status'=> $prod_check->car_name." Already Added to cart"]);
                }else
                {
                    $cartItem = new Cart();
                    $cartItem->prod_id = $product_id;
                    $cartItem->user_id = Auth::id();
                    $cartItem->save();
                    return response()->json(['status'=> $prod_check->car_name." Added to cart"]);
                }


            }
        }
        else{
            return response()->json(['status'=> "Login to Continue"]);
        }
    }

    public function viewcart()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();

        return view('frontend.cart', compact('cartItems'));
    }

    public function deleteproduct(Request $request)
    {

        if(Auth::check())
        {
            $product_id = $request->input('product_id');
            if(Cart::where('prod_id', $product_id)->where('user_id', Auth::id())->exists())
            {
                $cartItem = Cart::where('prod_id', $product_id)->where('user_id', Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status'=> "Item Deleted Successfully"]);
            }
        }
    else{
        return response()->json(['status'=> "Login to Continue"]);
    }
}
}
