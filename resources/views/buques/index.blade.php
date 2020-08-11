@extends('layouts.'.Auth::user()->role->name)
{{-- realizar un if para ver si puede eliminar o editar.. --}}
@section('title','Buques')
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
    <div class="card-body" style="overflow-x:auto;">
        <table id="tableID" class="table" >
            <thead class="thead-dark">
                <tr>
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
                        <th scope="row">{{ $buque->id }}</th>
                        <td><a href="{{route('buque.view',$buque)}}">{{ $buque->code }}</a></td>
                        <td>{{ $buque->nombre }}</td>
                        <td>{{ $buque->localidad->nombre }}</td>
                        <td><button type="button" class="btn btn-primary" onclick="locate({{$buque->lat}},{{$buque->lon}})">Localizar</button></td>
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
        scrollY: 500,
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
<script>
    // setTimeout(function(){
    //    window.location.reload(1);
    // }, 10000);
    var mymap = L.map('mapid').setView([-17.393879, -66.156943], 13);
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
