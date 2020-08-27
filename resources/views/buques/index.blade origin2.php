<?php ob_start("comprimir_pagina"); ?>


@extends('layouts.'.Auth::user()->role->name)
{{-- realizar un if para ver si puede eliminar o editar.. --}}
@section('title','Unidades de Superficie')
@section('content')
<link rel="stylesheet" href="{{ asset('css/leaflet.css')}}"/>
<script src="{{asset('js/leaflet.js')}}"></script>
{{-- <link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.min.css')}}"/> --}}
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script type="text/javascript" src="{{asset('DataTables/datatables.min.js')}}"></script>
<script src="{{ asset('DataTables/dataTables.select.min.js') }}"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
  margin: 0;
  font-family: "Lato", sans-serif;
}

.sidebar {
  margin: 0;
  padding: 0;
  width: 320px;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}

.sidebar a.active {
  background-color: #4CAF50;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}

div.content {
  margin-left: 100px;
  padding: 1px 16px;
  height: 1000px;
}

@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}
</style>
<div class="card">

    {{-- Desde AQUI --}}
    <div class="sidebar">
        <a class="active" href="#home">Home</a>
        <font size=1.5>
            <h2 class="card-header">Unidades de Superficie</h2>

        <table id="tableID" class="table" >
            <thead class="thead-dark">
                <tr>
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
                        <td><span style="color:#004c8c; font-weight: 600;"><a href="{{route('buque.view',$buque)}}">{{ $buque->code }}</a></span><br><span>{{ $buque->localidad->nombre }}</span></td>
                        {{-- <td>{{ $buque->localidad->nombre }}</td> --}}
                        <td><button type="button" class="btn btn-primary" onclick="locate({{$buque->tracker->positions[0]->lat}}, {{$buque->tracker->positions[0]->lon}})">Localizar</button></td>
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
        <div class="content" style="width: 95%;">
        <h2 class="card-header">Unidades de Superficie TRANSNAVAL</h2>
        <div id="mapid" style="height: 850px;"></div>
        {{-- <div id="mapid" style="height: 850px;"></div> --}}
      </div>

</div>
    {{-- Hasta AQUI --}}



<div class="content" style="width: 85%;">
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
                        <td>{{$buque->tracker->positions[0]->lat}}, {{$buque->tracker->positions[0]->lon}}</td>
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
    // L.tileLayer('{{asset('mapas/{z}/{x}/{y}.png')}}', {
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mymap);

    @if(isset($buque->tracker->positions[0]))
        var marker = L.marker([{{$buque->tracker->positions[0]->lat}}, {{$buque->tracker->positions[0]->lon}}]).addTo(mymap);
        marker.bindPopup("{{$buque->nombre}}").openPopup();
    @endif
    // Necesitaba colocar nombre al marker, solo da el primer registro
    // @foreach($buques as $buque))
    //     var marker = L.marker([{{$buque->tracker->positions[0]->lat}}, {{$buque->tracker->positions[0]->lon}}]).addTo(mymap);
    //     marker.bindPopup("{{$buque->nombre}}").openPopup();
    // @endforeach

</script>
<script>
        function locate(lat, lng) {
            var newLatLng = new L.LatLng(lat, lng);
            marker.setLatLng(newLatLng);
            mymap.setView(marker.getLatLng(),mymap.getZoom());
        }
</script>


//para reportes
<script>
$(document).ready( function () {
    $('#tableID2').DataTable( {
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
@endsection

<?php
  // Una vez que el búfer almacena nuestro contenido utilizamos "ob_end_flush" para usarlo y deshabilitar el búfer
  ob_end_flush();

  // Función para eliminar todos los espacios en blanco
 function comprimir_pagina($buffer) {

    $search = array(
        '/\>[^\S ]+/s',     // elimina espacios en blanco después de las etiquetas, excepto el espacio
        '/[^\S ]+\</s',     // elimina en blanco antes de las etiquetas, excepto el espacio
        '/(\s)+/s',         // Acortar múltiples secuencias de espacios en blanco.
        '/<!--(.|\s)*?-->/' // Borrar comentarios html
    );

    $replace = array(
        '>',
        '<',
        '\\1',
        ''
    );

    $buffer = preg_replace($search, $replace, $buffer);

    return $buffer;
   }
?>
