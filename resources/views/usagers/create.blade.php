
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usagers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
				<h2 class="text-lg font-medium text-gray-900">Nouvel usager</h2>
		        @if(session('status'))
		        <p class="mt-1 text-sm text-gray-600">
			        {{ session('status') }}
		        </p>
		        @endif

		        <form action="{{ route('usagers.store') }}" method="POST" enctype="multipart/form-data">
		            @csrf
		
						<div>
						<label class="block font-medium text-sm text-gray-700" for="nom">
						Nom
						</label>
						<input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="nom" name="nom" type="text" value="" required="required" autofocus="autofocus" autocomplete="nom">
						</div>
						@error('nom')
						<p><strong>{{ $message }}</strong></p>
						@enderror
						                    
						[SABOTAGE]
		
		            <button type="submit" class="inline-flex items-right px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest" style="margin-top:20px;background-color:#3B71CA;">Enregistrer</button>
		        </form>

                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<a class="inline-flex items-right px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest" href="{{ route('usagers.index') }}">
					Retour
				</a>
        </div>
    </div>

</x-app-layout>












