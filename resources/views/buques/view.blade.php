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
<div class="card" style="overflow-x:auto;">
    <h4 class="card-header">
        {{$buque->code}} - {{$buque->nombre}} - {{$buque->localidad->nombre}}
    </h4>

    <div>
        <tr>
            <th><h6>{{$buque->description}} </h6></th>
            <th><a class="btn btn-primary btn-sm" href="{{route('buque.viewRep',$buque)}}" role="button">Reporte</a></th>

        </tr>
    </div>

    <div class="card-body" >

        <table id="tableID" class="table" >
            <thead class="thead-dark">
                <tr>
                    {{-- <th scope="col">#</th> --}}
                    <th scope="col">V</th>
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
                        {{-- <th scope="row">{{ $hist->id }}</th> --}}
                        <th scope="row"><input type="checkbox"></input></th>
                        <th scope="row">{{ $hist->id }}</th>
                        <th scope="row">{{ $hist->lat }}</th>
                        <th scope="row">{{ $hist->lon }}</th>
                        <td>{{ $hist->created_at }}</td>
                        <td><button type="button" class="btn btn-primary" onclick="locate({{$hist->lat}},{{$hist->lon}})">LOCALIZAR</button></td>
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
        scrollY: 100,
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
                             '<img src="{{ asset('img/estnr.JPG')}}" style="position:absolute; top:0; right:250; height: 80px; with: 80px;" />'
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
        "order": [[ 1, "desc" ]],
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
        var first=true;
        data.forEach(function(item){
            if (first) {
                first=false;
                locate(item['lat'],item['lon']);
            }
            content+=`
                <tr>
                    {{--la actualizacion a llamada de WS--}}
                    <th scope="row"><input type="checkbox"></input></th>
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

// var ruta = L.polyline([
//         [-18.92, -66.211112],
//         [-17.922, -66.211112],
//         [-17.03200, -68.21111],
//     ],{color:'black'}).addTo(mymap);

    var ruta = L.polyline(
        [
    @foreach($buque->tracker->positions as $hist)
        [{{$hist->lat}},{{$hist->lon}}],
@endforeach
],{color:'black'}).addTo(mymap);


@if(isset($buque->tracker->positions[0]))
    var marker = L.marker([{{$buque->tracker->positions[0]->lat}}, {{$buque->tracker->positions[0]->lon}}],{title: "TNR"}).addTo(mymap);
@endif

// para el rango de fechas las lineas de trayectoria...


</script>
<script>
    function locate(lat, lng) {
        var newLatLng = new L.LatLng(lat, lng);
        marker.setLatLng(newLatLng);
        mymap.setView(marker.getLatLng(),mymap.getZoom());
    }
</script>

// <script>
//     function routes(lat, lng, fini, ffin) {
//         var newLatLng = new L.LatLng(lat, lng);
//         marker.setLatLng(newLatLng);
//         mymap.setView(marker.getLatLng(),mymap.getZoom());
//     }
// </script>
@endsection
