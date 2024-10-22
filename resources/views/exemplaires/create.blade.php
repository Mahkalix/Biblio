<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajouter un Exemplaire pour l'Ouvrage : {{ $ouvrage->titre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form style="display: flex; flex-direction: column; gap: 10px;" action="{{ route('exemplaires.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="ouvrage" value="{{ $ouvrage->id }}">

                        <div class="form-group">
                            <label for="etat">État</label>
                            <select style="border-radius: 5px;" name="etat" class="form-control">
                                @foreach ($etats as $key => $etat)
                                <option value="{{ $key }}">{{ $etat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="disponible">Disponible</label>
                            <input style="border-radius: 5px;" type="checkbox" name="disponible" checked>
                        </div>

                        <div class="form-group">
                            <label for="date_retour_souhaitee">Date de retour souhaitée</label>
                            <input style="border-radius: 5px;" type="date" name="date_retour_souhaitee" class="form-control">
                        </div>

                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest" style="width:100px;background-color:#FF8801; font-size:10px!important;" href="{{ route('exemplaires.create', $ouvrage->id) }}" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>