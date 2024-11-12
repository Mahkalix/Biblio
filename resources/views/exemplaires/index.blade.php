<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Exemplaires de : {{ $ouvrage->titre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6" style="gap:20px">
                    <h3 style="margin-bottom:10px;">Liste des exemplaires</h3>
                    <table class="min-w-full text-left text-sm font-light" style="width:100%;margin-bottom:20px;">
                        <thead class="border-b font-medium dark:border-neutral-500">
                            <tr>
                                <th class="px-6 py-4">ID</th>
                                <th class="px-6 py-4">Date</th>
                                <th class="px-6 py-4">État</th>
                                <th class="px-6 py-4">Visibilité</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($exemplaires->isEmpty())
                            <tr>
                                <td colspan="4" style="text-align: center; color: black; font-size: 15px;">
                                    Aucun exemplaire disponible.
                                </td>
                            </tr>
                            @else
                            @foreach ($exemplaires as $exemplaire)
                            <tr class="border-b dark:border-neutral-500">
                                <td class="px-6 py-4">{{ $exemplaire->id }}</td>
                                <td class="px-6 py-4">{{ $exemplaire->date }}</td>
                                <td class="px-6 py-4">{{ $exemplaire->etat }}</td>
                                <td class="px-6 py-4">
                                    <!-- Bouton pour basculer la visibilité -->
                                    <form action="{{ route('ouvrages.exemplaires.toggleVisibility', ['ouvrage' => $ouvrage->id, 'exemplaire' => $exemplaire->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="focus:outline-none">
                                            @if ($exemplaire->visible)
                                            <!-- Icône pour visible (œil ouvert) -->
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            @else
                                            <!-- Icône œil barré -->
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.343 17.657L17.657 6.343" />
                                            </svg>







                                            @endif
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <a class="px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest" style="background-color:#FF8801; font-size:10px!important;" href="{{ route('ouvrages.exemplaires.create', $ouvrage->id) }}">
                        Ajouter un Exemplaire
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>