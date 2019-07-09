<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\User;
use App\Mail\NewOrder;
use Mail;

class CartController extends Controller
{
    public function update()
    {
    	$client = auth()->user(); //Cliente que hace el pedido
    	$cart = $client->cart;
    	$cart->status = 'Pendind';
    	$cart->order_date = Carbon::now();
    	$cart->save(); //UPDATE

    	//Notificar Administradores via Email
    	$admins = User::where('admin', true)->get();
    	Mail::to($admins)->send(new NewOrder($client, $cart));

    	$notification = 'Tu pedido se ha registrado correctamente.  Te contactaremos pronto vía mail';
    	return back()->with(compact('notification'));
    }
}
