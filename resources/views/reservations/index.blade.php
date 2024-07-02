<!-- resources/views/reservations/index.blade.php -->
{{-- @extends('layouts.app')

@section('content') --}}
<div class="container">
    <div class="container">
        <h1>{{ $evenement->title }}</h1>
        <p>{{ $evenement->description }}</p>
    

    </div>
    <h1>Mes Réservations</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Événement</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->evenement->title }}</td>
                    <td>{{ $reservation->status }}</td>
                    <td>
                        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select">
                                <option value="accepted" {{ $reservation->status == 'accepted' ? 'selected' : '' }}>Accepté</option>
                                <option value="declined" {{ $reservation->status == 'declined' ? 'selected' : '' }}>Refusé</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Mettre à jour</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{-- @endsection --}}
