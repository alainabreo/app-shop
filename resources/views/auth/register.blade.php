@extends('layouts.app')

@section('body-class', 'signup-page')

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('img/city.jpg') }}'); background-size: cover; background-position: top center;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                <div class="card card-signup">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="header header-primary text-center">
                            <h4>Registro</h4>
                            <!-- <div class="social-line">
                                <a href="#pablo" class="btn btn-simple btn-just-icon">
                                    <i class="fa fa-facebook-square"></i>
                                </a>
                                <a href="#pablo" class="btn btn-simple btn-just-icon">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="#pablo" class="btn btn-simple btn-just-icon">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </div> -->
                        </div>
                        <p class="text-divider">Completa tus datos</p>
                        <div class="content">

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">face</i>
                                </span>
                                <input id="name" type="text" class="form-control" placeholder="Nombre..." name="name" value="{{ old('name'), $name }}" required autofocus>
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">fingerprint</i>
                                </span>
                                <input id="username" type="text" class="form-control" placeholder="Username..." name="username" value="{{ old('username') }}" required autofocus>
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">email</i>
                                </span>
                                <input id="email" type="email" class="form-control" placeholder="Correo Electrónico..." name="email" value="{{ old('email') }}" required>                                
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">phone</i>
                                </span>
                                <input id="phone" type="phone" placeholder="Teléfono" class="form-control" name="phone" value="{{ old('phone') }}" required>
                            </div>                            

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">class</i>
                                </span>
                                <input id="address" type="text" placeholder="Dirección" class="form-control" name="address" value="{{ old('address') }}" required>
                            </div> 

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">lock_outline</i>
                                </span>
                                <!-- <input type="password" placeholder="Password..." class="form-control" /> -->
                                <input id="password" type="password" placeholder="Contraseña..." class="form-control" name="password" required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">lock_outline</i>
                                </span>
                                <input id="password-confirm" type="password" placeholder="Confirmar Contraseña..." class="form-control" name="password_confirmation" required>
                            </div>                            

                        </div>
                        <div class="footer text-center">
                            <!-- <a href="#pablo" class="btn btn-simple btn-primary btn-lg">Ingresar</a> -->
                            <button type="submit" class="btn btn-simple btn-primary btn-lg">
                                Confirmar Registro
                            </button>
                        </div>
                        <!-- <a class="btn btn-link" href="{{ route('password.request') }}">
                        Forgot Your Password?
                        </a> -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer');
    
</div>
@endsection
