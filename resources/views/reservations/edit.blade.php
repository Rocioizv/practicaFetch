@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Editar Reserva</h2>

    <a href="{{ route('reservations.index') }}" class="btn btn-secondary mt-3">⬅ Volver atrás</a>

    @if(isset($reservation))
    <p>ID de reserva: {{ $reservation->id }}</p>
    @else
    <p>⚠ No se encontró la reserva</p>
    @endif

    <form id="editForm">
        @csrf
        <input type="hidden" name="_method" value="PUT"> <!-- Laravel necesita esto -->
        
        <label for="table_id">Mesa</label>
        <select id="table_id" name="table_id" required>
            @foreach($tables as $table)
            <option value="{{ $table->id }}" {{ $reservation->table_id == $table->id ? 'selected' : '' }}>
                Mesa {{ $table->number }} ({{ $table->seats }} asientos)
            </option>
            @endforeach
        </select>

        <label for="date">Fecha</label>
        <input type="date" id="date" name="date" value="{{ $reservation->date }}" required>

        <label for="reservation_time">Hora</label>
        <input type="datetime-local" id="reservation_time" name="reservation_time" value="{{ $reservation->reservation_time }}" required>

        <button type="button" id="update-btn" class="btn btn-primary">Actualizar</button>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('update-btn').addEventListener('click', function () {
            let form = document.getElementById('editForm');
            let formData = new FormData(form);

            fetch("{{ route('reservations.update', $reservation->id) }}", {
                method: "POST", // Laravel no acepta PUT directamente
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "X-Requested-With": "XMLHttpRequest"
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Error en la actualización");
                }
                return response.json();
            })
            .then(data => {
                alert("Reserva actualizada correctamente");
                window.location.href = "{{ route('reservations.index') }}"; // Redirigir tras éxito
            })
            .catch(error => {
                alert("Hubo un problema: " + error.message);
            });
        });
    });
</script>
@endpush
@endsection
