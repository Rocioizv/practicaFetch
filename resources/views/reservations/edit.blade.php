@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Editar Reserva</h2>

    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('reservations.index') }}" class="btn btn-secondary">
            ⬅ Volver atrás
        </a>
    </div>

    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Detalles de la Reserva</h5>
        </div>
        <div class="card-body">
            @if(isset($reservation))
            <p class="text-muted">ID de reserva: <strong>{{ $reservation->id }}</strong></p>
            @else
            <p class="text-danger">⚠ No se encontró la reserva</p>
            @endif

            <form id="editForm">
                @csrf
                <input type="hidden" name="_method" value="PUT"> 

                <div class="mb-3">
                    <label for="table_id" class="form-label">Mesa</label>
                    <select id="table_id" name="table_id" class="form-select" required>
                        @foreach($tables as $table)
                        <option value="{{ $table->id }}" {{ $reservation->table_id == $table->id ? 'selected' : '' }}>
                            Mesa {{ $table->number }} ({{ $table->seats }} asientos)
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Fecha</label>
                    <input type="date" id="date" name="date" value="{{ $reservation->date }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="reservation_time" class="form-label">Hora</label>
                    <input type="datetime-local" id="reservation_time" name="reservation_time" value="{{ $reservation->reservation_time }}" class="form-control" required>
                </div>

                <div class="text-center">
                    <button type="button" id="update-btn" class="btn btn-success px-4">
                        <i class="fas fa-save"></i> Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    var updateReservationUrl = "{{ route('reservations.update', $reservation->id) }}";
    var reservationsIndexUrl = "{{ route('reservations.index') }}";
    var csrfToken = "{{ csrf_token() }}";
</script>

<script src="{{ asset('js/edit-reservation.js') }}"></script>
@endpush
@endsection
