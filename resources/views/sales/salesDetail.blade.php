@extends('main.main')
@extends('sales.sales')
@section('salesDetail')
    <section class="frontend">
        <div class="row justify-content-center">
            <div class="col-sm-10 statistics">
                <h2 class="titulo-2">Detalle de la información</h2>
                @if(!empty($status))
                    @if($status =='success')
                        <div class="alert alert-success" role="alert">{{$message}}</div>
                    @endif
                    @if($status =='error')
                        <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endif
                @endif
                <table class="table table-sm table-hover table-light">
                    <tbody>
                        <tr>
                            <td>Animal:</td>
                            <td><a href="{{ url('/animals/detail/' . $animal_id) }}">{{ $name }}</a></td>
                        </tr>
                        <tr>
                            <td>Tipo de venta:</td>
                            <td>{{ $sale_type }}</td>
                        </tr>
                        <tr>
                            <td>Fecha de la venta:</td>
                            <td>{{ explode(' ', $sale_date)[0] }}</td>
                        </tr>
                        <tr>
                            <td>Peso del animal (kg):</td>
                            <td>{{ $weight }}</td>
                        </tr>
                        <tr>
                            <td>Monto de la venta:</td>
                            <td>{{ number_format($price_total) }}</td>
                        </tr>
                        <tr>
                            <td>Precio por kilogramo:</td>
                            <td>{{ number_format($price_kg) }}</td>
                        </tr>
                        @if($sale_type == "Subasta")
                            <tr>
                                <td>Nombre de la subasta:</td>
                                <td>{{ $auction_name }}</td>
                            </tr>
                            <tr>
                                <td>Comisión de subasta (%):</td>
                                <td>{{ $auction_commision }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td>Sexo:</td>
                            <td>{{ $sex }}</td>
                        </tr>
                        <tr>
                            <td>Descripción:</td>
                            <td>{{ $description }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="input-group input-group-sm justify-content-center">  
            <div class="col-md-3">
                <a href="{{url('sales/sale/delete-one/' . $sale_id . '/' . $animal_id) }}" class="btn btn-danger btn-sm w-100"  id="btnDeletePurchase"  style="display:none">Borrar Registro</a>
            </div>    
        </div>
        <button class="btn btn-primary btn-md btn-block" id="btnEnablePurchaseUpdate">Habilitar actualización de datos</button>
    </section>
    <div class="accordion mt-3" id="accordionUpdatePurchase" style="display: none">
        <div class="card">
            <div class="card-header" id="headingSix">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                        data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                        <h2 class="titulo-2 ">Editar venta</h2>
                    </button>
                </h2>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionUpdatePurchase">
                <div class="card-body">
                    @include('sales.includes.salesUpdate')
                </div>
            </div>
        </div>
    </div>
@stop
