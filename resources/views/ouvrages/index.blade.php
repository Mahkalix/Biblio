<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ouvrages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-lg font-medium text-gray-900">Liste des Ouvrages</h2>

                    @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                    @endif
                    <div class="overflow-x-auto mb-6">
                        <table class="min-w-full text-left text-sm font-light" style="width:100%;margin-bottom:20px;">
                            <thead class="border-b font-medium dark:border-neutral-500">
                                <tr>
                                    <th class="px-6 py-4">Titre</th>
                                    <th class="px-6 py-4">Auteur</th>
                                    <th class="px-6 py-4">Éditeur</th>
                                    <th class="px-6 py-4">Pages</th>
                                    <th class="px-6 py-4">Date de publication</th>
                                    <th class="px-6 py-4">ISBN</th>
                                    <th class="px-6 py-4">Image</th>
                                    <th class="px-6 py-4" style="text-align:right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ouvrages as $ouvrage)
                                <tr class="border-b dark:border-neutral-500">
                                    <td class="px-2 py-4">{{ $ouvrage->titre }}</td>
                                    <td class="px-2 py-4">{{ $ouvrage->auteur }}</td>
                                    <td class="px-2 py-4">{{ $ouvrage->editeur }}</td>
                                    <td class="px-2 py-4">{{ $ouvrage->pages }}</td>
                                    <td class="px-2 py-4">{{ $ouvrage->date_publication }}</td>
                                    <td class="px-2 py-4">{{ $ouvrage->isbn }}</td>
                                    <td class="px-1 py-2">
                                        <img src="{{ asset('images/' . $ouvrage->image) }}" alt="Image de couverture de {{ $ouvrage->titre }}" class="w-24 h-36 object-cover">
                                    </td>

                                    <td class="px-6 py-4" style="text-align:right;">
                                        <form style="gap:10px; display: flex; flex-wrap: nowrap; flex-direction: row;" action="{{ route('ouvrages.destroy', $ouvrage->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet ouvrage ?');">
                                            <a class="px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest" style="background-color:#008000; font-size:10px!important;" href="{{ route('ouvrages.exemplaires.index', $ouvrage->id) }}" class="btn btn-info">Exemplaires</a>
                                            <a class="px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest" style="background-color:#3B71CA; font-size:10px!important;" href="{{ route('ouvrages.edit', $ouvrage->id) }}">Modifier</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest" style="background-color:#DC4C64; font-size:10px!important;">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a class="inline-flex items-right px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest" href="{{ route('ouvrages.create') }}">
                Nouvel ouvrage
            </a>
        </div>
    </div>

</x-app-layout>