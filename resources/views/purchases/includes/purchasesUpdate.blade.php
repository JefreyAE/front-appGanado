
@section('purchasesUpdate')
<section class="frontend row justify-content-center"> 
    <h1 class="titulo col-md-12">Actualización de datos de la compra</h1>
    <div class="form col-md-8" id='formUpdatePurchase'>
        <h2 class="titulo-2">Ingrese los datos del animal</h2>
        <form class="form_data" method="post" action="{{ url('/purchases/update/')}}">
            {{csrf_field()}}
            <div class="mb-3">
                <label class="form-label" for='purchase_type'>Tipo de compra:</label>
                <select class="form-control" id="purchase_type" name="purchase_type" required>
                    <option value="Subasta">Subasta</option>
                    <option value="{{$purchase_type}}" selected>{{$purchase_type}}</option>
                    <option value="Particular">Particular</option>
                    <option value="Intercambio">Intercambio</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for='weight'>Peso de compra:</label>
                <select class="form-control" id="weight" name="weight" required>
                    <option value="{{$weight}}" selected>{{$weight}}</option>
                </select> 
            </div>
            <div class="mb-3">
                <label class="form-label" for='price_total'>Monto total de la compra:</label>
                @if(!empty($response))
                    @if($response['status'] =='error')
                        @if(!empty($response['validationErrors']['price_total']))
                            @foreach($response['validationErrors']['price_total'] as $error)
                                <div class='error'>{{$error}}</div>
                            @endforeach
                        @endif
                    @endif
                @endif
                <div>
                    <input class="form-control" id="price_total" name="price_total" type="text" value="{{$price_total}}" required>
                </div>
            </div>
            <div id="action_options">
                <div id="options">
                    <div class="mb-3">
                        <label class="form-label" for='price_kg'>Monto por kilogramo:</label>
                        @if(!empty($response))
                            @if($response['status'] =='error')
                                @if(!empty($response['validationErrors']['price_kg']))
                                    @foreach($response['validationErrors']['price_kg'] as $error)
                                        <div class='error'>{{$error}}</div>
                                    @endforeach
                                @endif
                            @endif
                        @endif
                        <div>
                            <input class="form-control" id="price_kg" name="price_kg" type="text" value="{{$price_kg}}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for='auction_commission'>Comisión de la subasta (Porcentaje): (Ejem: 5)</label>
                        @if(!empty($response))
                            @if($response['status'] =='error')
                                @if(!empty($response['validationErrors']['auction_commission']))
                                    @foreach($response['validationErrors']['auction_commission'] as $error)
                                        <div class='error'>{{$error}}</div>
                                    @endforeach
                                @endif
                            @endif
                        @endif
                        <div>
                            <select class="form-control" id="auction_commission" name="auction_commission" type="text">
                                <option value="{{$auction_commision}}" selected>{{$auction_commision}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for='auction_name'>Nombre de la subasta:</label>
                        @if(!empty($response))
                            @if($response['status'] =='error')
                                @if(!empty($response['validationErrors']['auction_name']))
                                    @foreach($response['validationErrors']['auction_name'] as $error)
                                        <div class='error'>{{$error}}</div>
                                    @endforeach
                                @endif
                            @endif
                        @endif
                        <div>
                            <select class="form-control" id="auction_name" name="auction_name" required>
                                <option value="{{$auction_name}}" selected>{{$auction_name}}</option>
                                <option value="Subasta Ganadera Rio Blanco">Subasta Ganadera Rio Blanco</option>
                                <option value="Subasta ExpoPococi">Subasta Expococí (Guápiles)</option>
                                <option value="Subasta de Valle la Estrella">Subasta de Valle la Estrella</option>
                                <option value="Camara de Ganaderos Unidos del Sur" >Cámara de Ganaderos Unidos del Sur</option>
                                <option value="Subasta Ganadera UPAP">Subasta Ganadera UPAP</option>
                                <option value="Subasta Ganadera Sancarleña S.A.">Subasta Ganadera Sancarleña S.A.</option>
                                <option value="Subasta Ganadera Maleco Guatuso S.A.">Subasta Ganadera Maleco Guatuso S.A.</option>
                                <option value="Subasta Ganadera Montecillos Upala">Subasta Ganadera Montecillos, Upala</option>
                                <option value="Grupo de Subastas Sarapiquí PJ">Grupo de Subastas Sarapiquí PJ</option>
                                <option value="Subasta Ganadera El Progreso de Nicoya">Subasta Ganadera El Progreso de Nicoya</option>
                                <option value="Subasta Cámara de Ganaderos de Santa Cruz">Subasta Cámara de Ganaderos de Santa Cruz</option>
                                <option value="Subasta Cámara de Ganaderos de Cañas">Subasta Cámara de Ganaderos de Cañas</option>
                                <option value="Subasta Limonal">Subasta Limonal</option>
                                <option value="Subasta de Tilarán">Subasta de Tilarán</option>
                                <option value="Subasta Cámara de Ganaderos de Hojancha">Subasta Cámara de Ganaderos de Hojancha</option>
                                <option value="Subasta de Ganadera Liberia 07">Subasta de Ganadera Liberia 07</option>
                                <option value="Subasta Ganadera AGAINPA">Subasta Ganadera AGAINPA</option>
                                <option value="Subasta Ganadera El Progreso">Subasta Ganadera El Progreso</option>
                                <option value="Subasta Ganadera de Parrita">Subasta Ganadera de Parrita</option>
                                <option value="Subasta Salama">Subasta Salamá (Neilly)</option>
                                <option value="Subasta San Vito">Subasta San Vito (Cotobruceña)</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                    </div>
                </div>    
            </div>
            <div class="mb-3">
                <label class="form-label" for='purchase_date'>Fecha de la compra:</label>
                <input class="form-control" id="purchase_date" name="purchase_date" type="date"  value='{{ explode(' ', $purchase_date)[0] }}' required>
            </div>
            <div class="mb-3">
                <label class="form-label" for='description'>Descripción de la compra:</label>
                @if(!empty($response))
                    @if($response['status'] =='error')
                        @if(!empty($response['validationErrors']['description']))
                            @foreach($response['validationErrors']['description'] as $error)
                                <div class='error'>{{$error}}</div>
                            @endforeach
                        @endif
                    @endif
                @endif
                <div>
                    <textarea class="form-control" id="description" name="description" required>{{$description}}</textarea>
                </div>
            </div>
            <input id="sex" name="sex" type="hidden" value="{{$sex}}">
            <input id="name" name="name" type="hidden" value="{{$name}}">
            <input id="animal_id" name="animal_id" type="hidden" value="{{$animal_id}}">
            <input id="purchase_id" name="purchase_id" type="hidden" value="{{$purchase_id}}">
            <input id="father_id" name="father_id" type="hidden" value="unknown">
            <input id="mother_id" name="mother_id" type="hidden" value="unknown">
           
            <input class="btn btn-success btn-lg btn-block" id="btnRegister" type="submit" value="Actualizar">     
        </form>
    </div> 
</section>
@stop
@yield('purchasesUpdate')