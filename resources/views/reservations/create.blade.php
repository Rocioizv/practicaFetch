@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Crear Nueva Reserva</h1>
    <a href="{{ route('reservations.index') }}" class="btn btn-secondary mt-3">⬅ Volver atrás</a>

    <div class="card">
        <div class="card-header">Formulario de Reserva</div>
        <div class="card-body">
            <form id="reservationForm">
                @csrf

                <div class="mb-3">
                    <label for="table_id" class="form-label">Número de Mesa</label>
                    <select class="form-control" id="table_id" name="table_id" required>
                        @foreach($tables as $table)
                        <option value="{{ $table->id }}">Mesa {{ $table->number }} ({{ $table->seats }} asientos)</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Fecha</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>

                <button type="button" class="btn btn-success" onclick="submitReservation()">Guardar Reserva</button>
            </form>
        </div>
    </div>

    <div id="responseMessage" class="mt-3"></div>
</div>

<!-- Aquí pasamos la URL desde Blade al archivo JS -->
<script>
    var reservationStoreUrl = "{{ route('reservations.store') }}";
    var csrfToken = "{{ csrf_token() }}"; // Pasa el token CSRF también al JS
</script>

<!-- Aquí agregamos el archivo JS que contiene la función submitReservation -->
<script src="{{ asset('js/reservations.js') }}"></script>
@endsection