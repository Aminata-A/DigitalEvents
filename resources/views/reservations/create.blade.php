<!-- resources/views/evenements/show.blade.php -->
{{-- @extends('layouts.app')

@section('content') --}}
<div class="container">
    <h1>{{ $evenement->title }}</h1>
    <p>{{ $evenement->description }}</p>

    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <input type="hidden" name="evenement_id" value="{{ $evenement->id }}">
        <button type="submit" class="btn btn-primary">Réserver</button>
    </form>
</div>
{{-- @endsection --}}
