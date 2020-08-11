@extends('layouts.'.Auth::user()->role->name)
@section('title')
Reporte UUSS: {{$buque->nombre}}
@endsection
@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
crossorigin=""></script>
<link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.min.css')}}"/>
<script type="text/javascript" src="{{asset('DataTables/datatables.min.js')}}"></script>
<script src="{{ asset('DataTables/dataTables.select.min.js') }}"></script>
<div class="card">
    <h2 class="card-header">
        {{$buque->code}} - {{$buque->nombre}} - {{$buque->localidad->nombre}}
    </h2>
    <div class="card-body">
        <p>{{$buque->description}}</p>
        <table id="tableID" class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Latitud</th>
                    <th scope="col">Longitud</th>
                    <th scope="col">Fecha y Hora</th>
                    <th class="no-sort" scope="col"></th>
                </tr>
            </thead>
            <tbody id="tBody">
                @foreach($buque->tracker->positions as $hist)
                    <tr>
                        <th scope="row">{{ $hist->id }}</th>
                        <th scope="row">{{ $hist->lat }}</th>
                        <th scope="row">{{ $hist->lon }}</th>
                        <td>{{ $hist->created_at }}</td>
                        <td><button type="button" class="btn btn-primary" onclick="locate({{$hist->lat}},{{$hist->lon}})">LOCALIZAR</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div id="mapid" style="height: 400px;"></div>
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
        "order": [[ 0, "desc" ]],
        "ordering": true,
        columnDefs: [
            { orderable: false, targets: "no-sort"}
        ],
    });
});
</script>
<script>
var idBuque={{$buque->id}};
setInterval(function(){
//   window.location.reload(1);
    $.get(`/api/buque/getDates/${idBuque}`, function( data ) {
        console.log(data);
        var content='';
        data.forEach(function(item){
            content+=`
                <tr>
                    <th scope="row">${item['id']}</th>
                    <th scope="row">${item['lat']}</th>
                    <th scope="row">${item['lon']}</th>
                    <td>${item['created_at']}</td>
                    <td><button type="button" class="btn btn-primary" onclick="locate(${item['lat']},${item['lon']})">LOCALIZAR</button></td>
                </tr>
            `;
        });
        document.getElementById('tBody').innerHTML=content;
    });
}, 5000);
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