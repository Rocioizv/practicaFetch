<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

    public function index()
    {
        $reservations = Reservation::all();
        return view('reservations', compact('reservations'));
    }

    public function store(Request $request)
    {
        // Validar los datos de la reserva
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'date' => 'required|date',
            // Otros campos de validación
        ]);

        // Crear la reserva
        $reservation = new Reservation();
        $reservation->user_id = Auth::id();
        $reservation->table_id = $request->table_id;
        $reservation->date = $request->date;
        $reservation->save();

        // Devolver la respuesta en formato JSON
        return response()->json([
            'message' => 'Reserva creada con éxito',
            'reservation' => $reservation,
        ]);
    }

    public function create()
    {
        $tables = Table::all();

        return view('reservations.create', compact('tables'));
    }


    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $tables = Table::all();

        return view('reservations.edit', compact('reservation', 'tables'));
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'table_id' => $request->table_id,
            'date' => $request->date,
            'reservation_time' => $request->reservation_time,
        ]);

        if ($request->ajax()) {
            return response()->json(['message' => 'Reserva actualizada correctamente'], 200);
        }

        return redirect()->route('reservations.index')->with('success', 'Reserva actualizada');
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reserva eliminada correctamente.');
    }
}
