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
                    <form style="display: flex; flex-direction: column; gap: 10px;" action="{{ route('ouvrages.exemplaires.store', ['ouvrage' => $ouvrage->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="ouvrage" value="{{ $ouvrage->id }}">

                        <div class="form-group">
                            <label for="etat">État</label>
                            <select id="etat" name="etat" class="form-control" style="border-radius: 5px;">
                                @foreach ($etats as $key => $etat)
                                <option value="{{ $key }}">{{ $etat }}</option>
                                @endforeach
                            </select>
                            @error('etat')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="date">Date</label>
                            <input id="date" style="border-radius: 5px;" type="date" name="date" checked>
                            @error('date')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest" style="width:100px;background-color:#FF8801; font-size:10px!important;" class="btn btn-primary">Ajouter</button>

                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>