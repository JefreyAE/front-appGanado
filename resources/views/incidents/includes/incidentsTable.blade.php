@section('incidentsTable')
    <section class="frontend row"> 
        <h1 class="titulo col-md-12">Listado de incidentes registrados</h1>
        <div class="table-responsive">
            <table class="animals purchases table table-striped table-sm table-hover table-light" >
                <thead>
                    <tr class="table-primary">
                        <th>Tipo</th>
                        <th>Fecha del incidente</th>
                        <th>Descripción</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($listIncidents))
                        @foreach($listIncidents as $incident)
                        <tr>
                            <td>{{$incident['incident_type']}}</td>
                            <?php //$fecha = explode(' ',$injectable['application_date'])?>
                            <td>{{explode(' ',$incident['incident_date'])[0]}}</td>
                            <td>{{$incident['description']}}</td>
                            <td><a id="btnDeleteRegister" class="btn btn-sm btn-danger buttonsTable" href="{{ url('incidents/incident/delete-one/' . $incident['id'] . '/' . $animal['id'] .'/' . '2') }}">Borrar</a></td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </section>
@stop

@yield('incidentsTable')