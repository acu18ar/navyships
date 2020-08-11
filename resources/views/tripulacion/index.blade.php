@extends('layouts.'.Auth::user()->role->name)
@section('title','Tripulacion1')
@section('content')
<link rel="stylesheet" href="{{ asset('css/leaflet.css')}}"/>
<script src="{{asset('js/leaflet.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.min.css')}}"/>
<script type="text/javascript" src="{{asset('DataTables/datatables.min.js')}}"></script>
<script src="{{ asset('DataTables/dataTables.select.min.js') }}"></script>
<div class="card">
    <h2 class="card-header">
        Tripulacion
    </h2>
    <div class="card-body">
        <table id="tableID" class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Comandante</th>
                    <th scope="col">Tripulantes</th>
                    <th scope="col">Unidad de Superficie</th>
                    <th class="no-sort" scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($tripulaciones as $tripulacion)
                    <tr>
                        <th scope="row">{{ $tripulacion->id }}</th>
                        <td>{{ $tripulacion->k }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($tripulacion->Tripulantes, $limit = 20, $end = '...') }}</td>
                        <td>{{ $tripulacion->buque->code }}</td>
                        <td>
                            <form onsubmit="return confirm('Desea Eliminarlo?');" action="{{ route('tripulacion.delete', $tripulacion) }}" method="POST">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <a href="{{ route('tripulacion.edit', $tripulacion) }}" class="btn btn-link"><span data-feather="edit"></span></a>
                                <button type="submit" class="btn btn-link"><span data-feather="trash-2"></span></button>
                            </form>
                        </td>
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
        "order": [[ 0, "desc" ]],
        "ordering": true,
        columnDefs: [
            { orderable: false, targets: "no-sort"}
        ],
    });
});
</script>
@endsection
