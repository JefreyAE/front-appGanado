@section('title','Cuenta')
@section('user')
    @if(Route::currentRouteName() =='user.update' || Route::currentRouteName() =='user.profile')
        @yield('userProfile')
    @endif 
    @if(Route::currentRouteName() =='user.register')
        @yield('userRegister')
    @endif 
@stop