@extends('main.main')
@extends('sales.sales')
@section('salesRegister')
<section class="frontend row justify-content-center"> 
    <h1 class="titulo col-md-12">Registro de ventas</h1>
    <div class="form col-md-8" id='formSaleAnimal'>
        <h2 class="titulo-2">Ingrese los datos de la venta</h2>
        @if(!empty($response))
            @if($response['status']=='success')
                <div class="alert alert-success" role="alert">{{$response['message']}}</div>
            @endif
            @if($response['status'] =='error')
                <div class="alert alert-danger" role="alert">{{$errorMsg}}</div>
            @endif
        @endif
        <form class="form_data" method="POST" action="{{ url('/sales/create/')}}">
            {{csrf_field()}}
            <div class="mb-3">
                <label class="form-label" for='animal_id'>Seleccione animal:</label>
                <select class="form-control" id="animal_id" name="animal_id" required>
                    @if(!empty($listAnimals))
                        @foreach($listAnimals as $animal)
                            <option value="{{$animal["id"]}}">{{$animal['code'].' '.$animal['nickname'].' '.$animal['certification_name']}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for='sale_type'>Tipo de venta:</label>
                <select class="form-control" id="sale_type" name="sale_type" required>
                    <option value="Subasta" selected>Subasta</option>
                    <option value="Particular">Particular</option>
                    <option value="Intercambio">Intercambio</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for='weight'>Peso de venta:</label>
                <select class="form-control" id="weight" name="weight" required></select> 
            </div>
            <div class="mb-3">
                <label class="form-label" for='price_total'>Monto total de la venta:</label>
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
                    <input class="form-control" id="price_total" name="price_total" type="text" required>
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
                            <input class="form-control" id="price_kg" name="price_kg" type="text">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for='auction_commission'>Comisi??n de la subasta (%):</label>
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
                            <select class="form-control" id="auction_commission" name="auction_commission" type="text"></select>
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
                                <option value="Subasta Ganadera Rio Blanco">Subasta Ganadera Rio Blanco</option>
                                <option value="Subasta ExpoPococi">Subasta Expococ?? (Gu??piles)</option>
                                <option value="Subasta de Valle la Estrella">Subasta de Valle la Estrella</option>
                                <option value="Camara de Ganaderos Unidos del Sur" >C??mara de Ganaderos Unidos del Sur</option>
                                <option value="Subasta Ganadera UPAP">Subasta Ganadera UPAP</option>
                                <option value="Subasta Ganadera Sancarle??a S.A.">Subasta Ganadera Sancarle??a S.A.</option>
                                <option value="Subasta Ganadera Maleco Guatuso S.A.">Subasta Ganadera Maleco Guatuso S.A.</option>
                                <option value="Subasta Ganadera Montecillos Upala">Subasta Ganadera Montecillos, Upala</option>
                                <option value="Grupo de Subastas Sarapiqu?? PJ">Grupo de Subastas Sarapiqu?? PJ</option>
                                <option value="Subasta Ganadera El Progreso de Nicoya">Subasta Ganadera El Progreso de Nicoya</option>
                                <option value="Subasta C??mara de Ganaderos de Santa Cruz">Subasta C??mara de Ganaderos de Santa Cruz</option>
                                <option value="Subasta C??mara de Ganaderos de Ca??as">Subasta C??mara de Ganaderos de Ca??as</option>
                                <option value="Subasta Limonal">Subasta Limonal</option>
                                <option value="Subasta de Tilar??n">Subasta de Tilar??n</option>
                                <option value="Subasta C??mara de Ganaderos de Hojancha">Subasta C??mara de Ganaderos de Hojancha</option>
                                <option value="Subasta de Ganadera Liberia 07">Subasta de Ganadera Liberia 07</option>
                                <option value="Subasta Ganadera AGAINPA">Subasta Ganadera AGAINPA</option>
                                <option value="Subasta Ganadera El Progreso">Subasta Ganadera El Progreso</option>
                                <option value="Subasta Ganadera de Parrita">Subasta Ganadera de Parrita</option>
                                <option value="Subasta Salama">Subasta Salam?? (Neilly)</option>
                                <option value="Subasta San Vito">Subasta San Vito (Cotobruce??a)</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="mb-3">  
                <label class="form-label" for='sale_date'>Fecha de la venta:</label>
                <input class="form-control" id="sale_date" name="sale_date" type="date" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for='description'>Descripci??n de la venta:</label>
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
                    <textarea class="form-control" id="description" name="description" required></textarea>
                </div>
            </div>
            <input class="btn btn-success btn-lg btn-block" id="btnRegister" type="submit" value="Registrar">  
        </form>
    </div> 
</section>
@stop