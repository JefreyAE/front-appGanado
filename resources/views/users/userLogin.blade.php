@extends('layouts.master')

@section('title','Sistema de Registro Ganadero')

@section('title_header')
    <div   div class=" justify-content-center">
        <div id="companyName" class="mb-3">
            <h1>
                <a href="{{ url('/main/index/') }}">Sistema de Registro Ganadero</a>
            </h1>
        </div> 
    </div>
@stop

@section('content')
    {{$titulo ?? ''}}
    <div class="row">
        <div class="form col-lg-4" id='formLogin'>
            <h2>Ingrese sus credenciales</h2>
            <form method="POST" id="formLog" action="{{action('UserController@login')}}">
                {{csrf_field()}}
                @if(!empty($listErrors['email']))
                    @foreach($listErrors['email'] as $error)
                        <div class='error'>{{$error}}</div>
                    @endforeach
                @endif
                <div class="mb-3">
                    <label class="form-label">Correo Electrónico:</label>
                    <input class="form-control" id="email" name='email' type="email" placeholder="@" autofocus required>
                </div>
                @if(!empty($listErrors['password']))
                    @foreach($listErrors['password'] as $error)
                        <div class='error'>{{$error}}</div>
                    @endforeach
                @endif
                <div class="mb-3">
                    <label class="form-label">Contraseña:</label>
                    <input class="form-control" id="password" name="password" type="password" placeholder="Contraseña" required>
                </div> 
                @if(!empty($message))
                    <div class='error'>{{$message}}</div>
                @endif
                <button type="submit" class="large green button-login " id="btnLogin" >Ingresar</button>  
                <a href="{{ url('/user/register') }}" class="link">Registrarse</a>
            </form>
        </div> 
    </div>
    <div class="row mt-4 justify-content-center">
        <div class="col-md-7">
                @include('users.includes.carouselImageSamples')
        </div>
    </div>  
@stop
@section('footer')
    <div class="clearfix"></div>
    @include('includes.footer')
@stop