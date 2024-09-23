
[SABOTAGE]

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
            <h2 class="text-lg font-medium text-gray-900">Compte usager</h2>
            @if(session('status'))
            <p class="mt-1 text-sm text-gray-600">
                {{ session('status') }}
            </p>
            @endif

            <form action="{{ route('usagers.update',$usager->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
    
                    [SABOTAGE]
                
                    <div>
                    <label class="block font-medium text-sm text-gray-700" for="email">
                    Adresse mail
                    </label>
                    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="email" name="email" type="text" value="{{ $usager->email }}" required="required" autofocus="autofocus" autocomplete="email">
                    </div>
                     @error('email')
                    <p><strong>{{ $message }}</strong></p>
                    @enderror
                    
                    [SABOTAGE]
    
                <button type="submit" class="inline-flex items-right px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest" style="margin-top:20px;background-color:#3B71CA;">Enregistrer</button>
            </form>

            </div>
        </div>
    </div>
</div>

[SABOTAGE]
                    Retour
[SABOTAGE]