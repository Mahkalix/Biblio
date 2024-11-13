@if($ouvrages->isEmpty())
<p>Aucun ouvrage trouvé</p>
@else
<ul>
    @foreach($ouvrages as $ouvrage)
    <li>
        <strong>{{ $ouvrage->titre }}</strong> par {{ $ouvrage->auteur }}
        <br>
        <a href="{{ route('ouvrages.show', $ouvrage->id) }}">Voir détails</a>
    </li>
    @endforeach
</ul>
@endif