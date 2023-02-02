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
    <div class="clearfix"></div>
    <div id="content" class="row">
        <div id="sectionCentral" class="col-md-10">
            <section class="frontend row justify-content-center"> 
                <div class="form col-md-8" id='formRegisterUser'>
                    <h1 class="titulo-2">Formulario de Registro</h1>
                    @if(!empty($error))
                        <div class="alert alert-danger" role="alert">{{$error}}</div>
                    @endif
                    @if(!empty($message))
                        <div class="alert alert-success" role="alert">{{$message.' '}}<a href="{{url('/')}}">Ingresar</a></div>
                    @endif
                    <form class="form_data mb-4" method="POST" action="{{action('UserController@create')}}">
                        {{csrf_field()}}
                        <div class="mb-3">
                            <label class="form-label" for="name">Ingrese su nombre:</label>
                            <div><input class="form-control" id="name" name="name" type="text" placeholder="Nombre" autocomplete="off" required></div>
                            @if(!empty($listErrors['name']))
                                @foreach($listErrors['name'] as $error)
                                    <div class='error'>{{$error}}</div>
                                @endforeach
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="surname">Ingrese sus apellidos:</label>
                            <div><input class="form-control" id="surname" name="surname" type="text" placeholder="Apellidos" autocomplete="off" required></div>
                            @if(!empty($listErrors['surname']))
                                @foreach($listErrors['surname'] as $error)
                                    <div class='error'>{{$error}}</div>
                                @endforeach
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Ingrese su correo electrónico:</label>
                            <div><input class="form-control" id="email" name="email" type="email" placeholder="Email" autocomplete="off" required></div>
                            @if(!empty($listErrors['email']))
                                @foreach($listErrors['email'] as $error)
                                    <div class='error'>{{$error}}</div>
                                @endforeach
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password1">Ingrese su contraseña:</label>
                            <div><input class="form-control" id="password1" name="password1" type="password" placeholder="Nueva contraseña" autocomplete="off" required></div>
                            @if(!empty($listErrors['password1']))
                                @foreach($listErrors['password1'] as $error)
                                    <div class='error'>{{$error}}</div>
                                @endforeach
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password2">Repita su contraseña:</label>
                            <div><input class="form-control" id="password2" name="password2" type="password" placeholder="Ingrese nuevamente la contraseña"  autocomplete="off" required></div>
                        </div>
                        <label class="form-label" class="message" type="hidden"></label>
                        <div class="mb-3">
                            <input id="btnChangePassword" class="btn btn-danger btn-lg btn-block" type="submit" value="Registrar">  
                        </div>
                        <a href="{{ url('/') }}" class="link">Regresar</a>
                    </form>
                </div> 
            </section>
        </div>  
    </div>
    <div class="clearfix"></div>
@stop
