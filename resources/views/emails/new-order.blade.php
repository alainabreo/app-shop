<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nuevo Pedido</title>
</head>
<body>
	<p>Se ha realizado un nuevo pedido!</p>
	<p>Estos son los datos del cliente que realizó el pedido:</p>
	<ul>
		<li>
			<strong>Nombre:</strong>
			{{ $user->name }}
		</li>
		<li>
			<strong>Email:</strong>
			{{ $user->email }}
		</li>
		<li>
			<strong>Fecha del pedido:</strong>
			{{ $cart->order_date }}
		</li>
	</ul>

	<p>Y estos son los detalles del Pedido:</p>
	<ul>
		@foreach ($cart->details as $detail)
		<li>
			{{ $detail->product->name }} x {{ $detail->quantity }} ($ {{ $detail->quantity * $detail->product->price }})
		</li>
		@endforeach
	</ul>
	<p>
		<strong>Total que el cliente debe pagar:</strong> $ {{ $cart->total }}
	</p>
	<hr>
	<p>
		<a href="{{ url('/admin/orders'.$cart->id) }}">Haz click aquí</a>
		para ver más información sobre este pedido.
	</p>
</body>
</html>