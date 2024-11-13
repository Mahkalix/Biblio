@extends('layouts.app')

@section('title', 'Détails de l\'ouvrage')

@section('content')
<div class="container mt-5">
    <h2>{{ $ouvrage->titre }}</h2>
    <p>Auteur : {{ $ouvrage->auteur }}</p>
    <p>Éditeur : {{ $ouvrage->editeur }}</p>
    @if($ouvrage->image)
    <img src="{{ asset('images/' . $ouvrage->image) }}" alt="{{ $ouvrage->titre }}" style="max-width: 200px;">
    @endif
    <a href="{{ route('bibliotheque.recherche') }}" class="btn btn-secondary mt-3">Retour à la recherche</a>
</div>
@endsection