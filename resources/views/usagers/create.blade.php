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

                    @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path d="M14.348 5.652a1 1 0 10-1.414-1.414L10 7.172 7.066 4.238a1 1 0 00-1.414 1.414L8.828 10l-3.176 3.176a1 1 0 101.414 1.414L10 12.828l2.934 2.934a1 1 0 001.414-1.414L11.172 10l3.176-3.176z" />
                            </svg>
                        </span>
                    </div>
                    @endif

                    <!-- Form Start -->
                    <form action="{{ route('usagers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Nom -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700" for="nom">
                                Nom
                            </label>
                            <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                id="nom" name="nom" type="text" value="{{ old('nom') }}" required autofocus>
                            @error('nom')
                            <p class="text-red-500 text-xs mt-1"><strong>{{ $message }}</strong></p>
                            @enderror
                        </div>

                        <!-- Prénom -->
                        <div class="mt-4">
                            <label class="block font-medium text-sm text-gray-700" for="prenom">Prénom</label>
                            <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                id="prenom" name="prenom" type="text" value="{{ old('prenom') }}" required>
                            @error('prenom')
                            <p class="text-red-500 text-xs mt-1"><strong>{{ $message }}</strong></p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <label class="block font-medium text-sm text-gray-700" for="email">Email</label>
                            <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                id="email" name="email" type="email" value="{{ old('email') }}" required>
                            @error('email')
                            <p class="text-red-500 text-xs mt-1"><strong>{{ $message }}</strong></p>
                            @enderror
                        </div>

                        <!-- Identifiant -->
                        <div class="mt-4">
                            <label class="block font-medium text-sm text-gray-700" for="identifiant">Identifiant</label>
                            <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                id="identifiant" name="identifiant" type="text" value="{{ old('identifiant') }}" required>
                            @error('identifiant')
                            <p class="text-red-500 text-xs mt-1"><strong>{{ $message }}</strong></p>
                            @enderror
                        </div>

                        <!-- Mot de passe -->
                        <div class="mt-4">
                            <label class="block font-medium text-sm text-gray-700" for="passe">Mot de passe</label>
                            <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                id="passe" name="passe" type="password" required minlength="8>
                            @error('passe')
                            <p class=" text-red-500 text-xs mt-1"><strong>{{ $message }}</strong></p>
                            @enderror
                        </div>

                        <!-- Accès bloqué -->
                        <div class="mt-4">
                            <label class="block font-medium text-sm text-gray-700" for="blocage">Accès bloqué</label>
                            <select id="blocage" name="blocage" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                <option value="0" {{ old('blocage') == '0' ? 'selected' : '' }}>Non</option>
                                <option value="1" {{ old('blocage') == '1' ? 'selected' : '' }}>Oui</option>
                            </select>
                            @error('blocage')
                            <p class="text-red-500 text-xs mt-1"><strong>{{ $message }}</strong></p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="inline-flex items-right px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest mt-6 hover:bg-indigo-700 focus:bg-indigo-700"
                            style="background-color:#3B71CA;">
                            Enregistrer
                        </button>
                    </form>
                    <!-- Form End -->
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