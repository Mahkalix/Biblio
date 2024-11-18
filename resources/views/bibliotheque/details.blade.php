@extends('layouts.app')

@section('title', 'Détails de l\'ouvrage')

@section('content')
<div class="container mt-5">
    <h2>{{ $ouvrage->titre }}</h2>
    <p>Auteur : {{ $ouvrage->auteur }}</p>
    <p>Éditeur : {{ $ouvrage->editeur }}</p>
    <p>Pages : {{ $ouvrage->pages }}</p>
    <p>Date de publication : {{ $ouvrage->date_publication }}</p>
    <p>ISBN : {{ $ouvrage->isbn }}</p>
    @if($ouvrage->image)
    <img src="{{ asset('images/' . $ouvrage->image) }}" alt="{{ $ouvrage->titre }}" style="max-width: 200px;">
    @endif
    <a href="{{ route('bibliotheque.rechercher') }}" class="btn btn-secondary mt-3">Retour à la recherche</a>
</div>
@endsection