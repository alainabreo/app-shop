<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CartDetail;

//use App\Http\Auth;

class CartDetailController extends Controller
{
    public function store(Request $request)
    {
    	$cartDetail = new CartDetail();
    	$cartDetail->cart_id = auth()->user()->cart->id;
    	$cartDetail->product_id = $request->product_id;
    	$cartDetail->quantity = $request->quantity;
    	$cartDetail->save();

    	$notification = 'El producto se ha cargado a tu carrito de compras correctamente';
    	return back()->with(compact('notification'));
    }

    public function destroy(Request $request)
    {
    	$cartDetail = CartDetail::find($request->cart_detail_id);
    	//Validar que el usuario esté en el carrito propio y nó de otro usuario
    	if ($cartDetail->cart_id == auth()->user()->cart->id)
    		$cartDetail->delete();

    	$notification = 'El producto se ha eliminado del carrito de compras correctamente';
    	return back()->with(compact('notification'));
    }    
}
