<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Compte Usager</h2>
                    @if(session('status'))
                    <p class="mt-1 text-sm text-green-600">{{ session('status') }}</p>
                    @endif

                    <form action="{{ route('usagers.update', $usager->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Champ pour le nom -->
                        <div class="mt-4">
                            <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" name="nom" value="{{ $usager->nom }}" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        @error('nom')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <!-- Champ pour le prénom -->
                        <div class="mt-4">
                            <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                            <input type="text" name="prenom" value="{{ $usager->prenom }}" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        @error('prenom')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <!-- Champ pour l'email -->
                        <div class="mt-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Adresse Email</label>
                            <input type="email" name="email" value="{{ $usager->email }}" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <!-- Champ pour l'identifiant -->
                        <div class="mt-4">
                            <label for="identifiant" class="block text-sm font-medium text-gray-700">Identifiant</label>
                            <input type="text" name="identifiant" value="{{ $usager->identifiant }}" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        @error('identifiant')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <!-- Champ pour le mot de passe (facultatif) -->
                        <div class="mt-4">
                            <label for="passe" class="block text-sm font-medium text-gray-700">Mot de passe (laisser vide si inchangé)</label>
                            <input type="password" name="passe" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        @error('passe')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <!-- Champ pour le blocage -->
                        <div class="mt-4">
                            <label for="blocage" class="block text-sm font-medium text-gray-700">Blocage</label>
                            <input type="checkbox" name="blocage" value="1" {{ $usager->blocage ? 'checked' : '' }} class="mt-1">
                        </div>
                        @error('blocage')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <!-- Bouton Enregistrer -->
                        <div class="mt-6">
                            <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 text-center">
        <a href="{{ route('usagers.index') }}" class="text-blue-500 hover:text-blue-700 underline">Retour à la liste des usagers</a>
    </div>
</x-app-layout>