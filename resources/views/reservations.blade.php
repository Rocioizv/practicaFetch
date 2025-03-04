@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Reservas de Mesas</h1>

    <div class="card mt-4">
        <div class="card-header">Lista de Reservas</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Mesa</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->user->name }}</td> 
                        <td>{{ $reservation->table_id }}</td>
                        <td>{{ $reservation->date }}</td>
                        <td>
                            <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning">Editar</a>

                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta reserva?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('reservations.create') }}" class="btn btn-success">Nueva Reserva</a>
    </div>
</div>


<script src="{{ asset('js/reservations.js') }}"></script>

@endsection

