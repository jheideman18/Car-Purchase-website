<?php

namespace App\Http\Controllers\Frontend;

use id;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $old_cartItem = Cart::where('user_id', Auth::id())->get();
        foreach($old_cartItem as $item)
        {
            if(Product::where('id', $item->prod_id)->where('car_qty', '<=', '0')->exists())
            {
                $removeItem = Cart::where('user_id', Auth::id())->where('prod_id', $item->prod_id)->first();
                $removeItem->delete();
            }
        }

        $cartItem = Cart::where('user_id', Auth::id())->get();

        return view('frontend.checkout', compact('cartItem'));
    }

    public function placeorder(Request $request)
    {
        $order = new Order();
        $order->user_id =  Auth::id();
        //$order->total_price = $cart->products->car_price;
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address1 = $request->input('address1');
        $order->address2 = $request->input('address2');
        $order->city = $request->input('city');
        $order->province = $request->input('province');
        $order->country = $request->input('country');
        $order->streetcode = $request->input('streetcode');

        $total = 0;
        $cartItems_total = Cart::where('user_id', Auth::id())->get();
        foreach($cartItems_total as $prod)
        {
            $total += $prod->products->car_price;
        }
        $order->total_price = $total;
        $order->tracking_no ='admin'.rand(1111,9999);
        $order->save();

        $order->id;
        $cartItem = Cart::where('user_id', Auth::id())->get();
        foreach($cartItem as $item)
        {
            OrderItem::create(
                [
                    'order_id'=> $order->id,
                    'prod_id'=> $item->prod_id,
                    'qty'=> 1,
                    'price' => $item->products->car_price,
                ]
                );

                $product = Product::where('id',$item->prod_id)->first();
                $product->car_qty = $product->car_qty - 1;
                $product->update();
        }

        if(Auth::user()->address1 == NULL)
        {
            $user = User::where('id', Auth::id())->first();

            $user->name = $request->input('fname');
            $user->lname = $request->input('lname');
            $user->phone = $request->input('phone');
            $user->address1 = $request->input('address1');
            $user->address2 = $request->input('address2');
            $user->city = $request->input('city');
            $user->province = $request->input('province');
            $user->country = $request->input('country');
            $user->streetcode = $request->input('streetcode');
            $user->update();


        }

        $cartItem = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartItem);

        return redirect('/')->with('status', "Order Placed Successfully");
    }
}
