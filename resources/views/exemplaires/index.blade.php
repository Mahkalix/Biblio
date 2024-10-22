<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Exemplaires de : {{ $ouvrage->titre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 style="margin-bottom:10px;">Liste des exemplaires</h3>
                    @foreach ($exemplaires as $exemplaire)
                    <div>
                        <p>État : {{ $exemplaire->etat }} - Disponible : {{ $exemplaire->disponible ? 'Oui' : 'Non' }}</p>
                    </div>
                    @endforeach
                    <a class="px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest" style="background-color:#FF8801; font-size:10px!important;" href="{{ route('exemplaires.create', $ouvrage->id) }}" class="btn btn-primary">Ajouter un Exemplaire</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>