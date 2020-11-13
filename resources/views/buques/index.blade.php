@extends('layouts.'.Auth::user()->role->name)
{{-- realizar un if para ver si puede eliminar o editar.. --}}
@section('title','Unidades de Superficie1')
@section('content')
<script src="{{asset('js/leaflet.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.min.css')}}"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="{{ asset('css/leaflet.css')}}"/>

<script type="text/javascript" src="{{asset('DataTables/datatables.min.js')}}"></script>
<script src="{{ asset('DataTables/dataTables.select.min.js') }}"></script>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Desde AQUI --}}
    <div class="w3-sidebar w3-light-grey w3-bar-block" style="width:25%">
        <font size=1.5>
            <h2 class="card-header">Unidades de Superficie</h2>

        <table id="tableID" class="table" >

            <thead class="thead-dark">

                <tr>
                    <th><img src="{{ asset('img/estnr.JPG')}} " style=" height: 30px; with: 30px;"></th>
                    <th scope="col">Codigo</th>
                    {{-- <th scope="col">Agencia</th> --}}
                    <th class="no-sort" scope="col">Ubicación </th>
                    <th class="no-sort" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($buques as $buque)
                {{-- @foreach($buque->tracker->positions as $hist) --}}
                    <tr>
                        <td></td>
                        <td><span style="color:#004c8c; font-weight: 600;"><a href="{{route('buque.view',$buque)}}">{{ $buque->code }}</a></span><br><span>{{ $buque->localidad->nombre }}</span></td>
                        {{-- <td>{{ $buque->localidad->nombre }}</td> --}}
                        {{-- <td><button type="button" class="btn btn-primary" onclick="locate({{$buque->tracker->positions->last()->lat}}, {{$buque->tracker->positions->last()->lon}})">Localizar</button></td> --}}
                        <td><button type="button" class="btn btn-primary" onclick="locate('{{$buque->nombre}}')">Localizar</button></td>
                        <td>
                            <form onsubmit="return confirm('Desea Eliminarlo?');" action="{{ route('buque.delete', $buque) }}" method="POST">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <a href="{{ route('buque.edit', $buque) }}" class="btn btn-link"><span data-feather="edit"></span></a>
                                <button type="submit" class="btn btn-link"><span data-feather="trash-2"></span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </font>
    </div>
    <div style="margin-left:25%">


        <div class="w3-container w3-teal">
        <h2 class="card-header">Unidades de Superficie TRANSNAVAL</h2>
        </div>
        {{-- <nav class="w3-container" id="mapid" style="width:100%"></nav> --}}
        <div id="mapid" style="height: 850px;"></div>

    </div>

    {{-- Hasta AQUI --}}



    <div style="margin-left:25%">
    <h2 class="card-header">Unidades de Superficie</h2>
    <nav class="card-body" style="overflow-x:auto;">
        <table class="table" id="tableID2"   >
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Agencia</th>
                    <th scope="col">coordenadas</th>
                    <th class="no-sort" scope="col">Ubicación </th>
                    <th class="no-sort" scope="col">Registros</th>
                    <th class="no-sort" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($buques as $buque)
                {{-- @foreach($buque->tracker->positions as $hist) --}}
                    <tr>
                        <th scope="row">{{ $buque->id }}</th>
                        <td><a href="{{route('buque.view',$buque)}}">{{ $buque->code }}</a></td>
                        <td>{{ $buque->nombre }}</td>
                        <td>{{ $buque->localidad->nombre }}</td>
                        {{-- <td>{{ $buque->tracker->positions }}</td> --}}
                        {{-- Me muestra solo el primer registro, necesito que solo muestre el ultimo registro --}}
                        <td>{{$buque->tracker->positions->last()->lat}}, {{$buque->tracker->positions->last()->lon}}</td>
                        <td><button type="button" class="btn btn-primary" onclick="locate({{$buque->tracker->positions->last()->lat}}, {{$buque->tracker->positions->last()->lon}})">Localizar</button></td>
                        <td><a class="btn btn-primary" href="{{route('buque.view',$buque)}}" role="button">Ver Registros</a></td>
                        <td>
                            <form onsubmit="return confirm('Desea Eliminarlo?');" action="{{ route('buque.delete', $buque) }}" method="POST">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <a href="{{ route('buque.edit', $buque) }}" class="btn btn-link"><span data-feather="edit"></span></a>
                                <button type="submit" class="btn btn-link"><span data-feather="trash-2"></span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div id="mapid" style="height: 800px;"></div>
    </nav>
</div>
<style>
div.dt-buttons {
    float: right;
    margin-left:20px;
}
</style>
<script>
$(document).ready( function () {
    $('#tableID').DataTable( {
        scrollY: 400,
        lengthMenu: [
            [25, 50, 100, -1],
            [25, 50, 100,"TODO"]
        ],
        language: {
            "url": "{{asset('DataTables/Spanish.json')}}"
        },
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'print',
                messageTop: '           UNIDADE DE SUPERFICIE       ',
                exportOptions: {
                    stripHtml : false,
                    columns: ':visible'
                },
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                         .prepend(
                             '<img src="{{ asset('img/estnr.JPG')}}" style="position:absolute; top:80; left:5; height: 100px; with: 100px;" />'
                        );

                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );

                },
            },

            {extend: 'colvis',
                        columns: ':not(.noVis)'},

            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ],

        //"order": [[ 0, "desc" ]],
        "ordering": false,
        columnDefs: [
            { orderable: false, targets: "no-sort"}
        ],
    });
});
</script>
<script>
    // setTimeout(function(){
    //    window.location.reload(1);
    // }, 10000);
    var mymap = L.map('mapid').setView([-17.393879, -66.156943], 13);
    // L.tileLayer('{{asset('mapas/{z}/{x}/{y}.png')}}', {
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mymap);
    var markers=[];
    var marker = null;
    @foreach($buques as $buque)
        @if(isset($buque->tracker->positions[0]))
            marker=L.marker([{{$buque->tracker->positions->last()->lat}}, {{$buque->tracker->positions->last()->lon}}]).addTo(mymap);

            marker.bindPopup('{!!$buque->nombre!!}').openPopup();
            markers.push(['{!!$buque->nombre!!}', marker]);
        @endif
    @endforeach
</script>
<script>
    function locate(nombre) {
            markers.forEach(function (item) {
                console.log(nombre);

                if (item[0]==nombre) {
                    mymap.setView(item[1].getLatLng(),mymap.getZoom());
                    item[1].openPopup();
                }
            });
        }
</script>
//para reportes
<script>
$(document).ready( function () {
    $('#tableID2').DataTable( {
        scrollY: 300,
        lengthMenu: [
            [25, 50, 100, -1],
            [25, 50, 100,"TODO"]
        ],
        language: {
            "url": "{{asset('DataTables/Spanish.json')}}"
        },
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ],
        //"order": [[ 0, "desc" ]],
        "ordering": false,
        columnDefs: [
            { orderable: false, targets: "no-sort"}
        ],
    });
});
</script>
@endsection
