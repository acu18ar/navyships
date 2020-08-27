@extends('layouts.'.Auth::user()->role->name)
{{-- realizar un if para ver si puede eliminar o editar.. --}}
@section('title','Unidades de Superficie')
@section('content')
<link rel="stylesheet" href="{{ asset('css/leaflet.css')}}"/>
<script src="{{asset('js/leaflet.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.min.css')}}"/>
<script type="text/javascript" src="{{asset('DataTables/datatables.min.js')}}"></script>
<script src="{{ asset('DataTables/dataTables.select.min.js') }}"></script>
<div class="card">
    <h2 class="card-header">
        Unidades de Superficie
    </h2>
    <div class="card-body" style="overflow-x:auto; left:350px;" >
        <table id="tableID"  class="table"  >
            <thead class="thead-dark">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">#</th>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Agencia</th>
                    <th class="no-sort" scope="col">Ubicación </th>
                    <th class="no-sort" scope="col">Registros</th>
                    <th class="no-sort" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($buques as $buque)
                {{-- @foreach($buque->tracker->positions as $hist) --}}
                    <tr>
                        <td scope="row"></th>
                        <th scope="row">{{ $buque->id }}</th>
                        <td><a href="{{route('buque.view',$buque)}}">{{ $buque->code }}</a></td>
                        <td>{{ $buque->nombre }}</td>
                        <td>{{ $buque->localidad->nombre }}</td>
                        <td><button type="button" class="btn btn-primary" onclick="locate({{$buque->tracker->lat}},{{$buque->tracker->lon}})">Localizar</button></td>
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
    </div>
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
        scrollY: 200,
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
                            //  '<img src="{{ asset('img/estnr.JPG')}}" style="position:absolute; top:80; left:5; height: 100px; with: 100px;" />'
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
    @if(isset($buque->tracker->positions[0]))
        var marker = L.marker([{{$buque->tracker->positions[0]->lat}}, {{$buque->tracker->positions[0]->lon}}]).addTo(mymap);
    @endif
</script>
<script>
        function locate(lat, lng) {
            var newLatLng = new L.LatLng(lat, lng);
            marker.setLatLng(newLatLng);
            mymap.setView(marker.getLatLng(),mymap.getZoom());
        }
</script>
@endsection
