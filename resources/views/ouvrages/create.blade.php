<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un Ouvrage') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h2 class="text-lg font-medium text-gray-900">Ajouter un Ouvrage</h2>

                    @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('ouvrages.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="titre" class="block text-gray-700">Titre</label>
                            <input type="text" id="titre" name="titre" class="block w-full mt-1 rounded-md" value="{{ old('titre') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="auteur" class="block text-gray-700">Auteur</label>
                            <input type="text" id="auteur" name="auteur" class="block w-full mt-1 rounded-md" value="{{ old('auteur') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="editeur" class="block text-gray-700">Éditeur</label>
                            <input type="text" id="editeur" name="editeur" class="block w-full mt-1 rounded-md" value="{{ old('editeur') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="pages" class="block text-gray-700">Pages</label>
                            <input type="number" id="pages" name="pages" class="block w-full mt-1 rounded-md" value="{{ old('pages') }}">
                        </div>

                        <div class="mb-4">
                            <label for="date_publication" class="block text-gray-700">Date de publication</label>
                            <input type="date" id="date_publication" name="date_publication" class="block w-full mt-1 rounded-md" value="{{ old('date_publication') }}">
                        </div>

                        <div class="mb-4">
                            <label for="isbn" class="block text-gray-700">ISBN</label>
                            <input type="text" id="isbn" name="isbn" class="block w-full mt-1 rounded-md" value="{{ old('isbn') }}">
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-gray-700">Image</label>
                            <input type="file" id="image" name="image" class="block w-full mt-1 rounded-md" accept="image/*">
                        </div>

                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Créer</button>
                    </form>
                </div>
            </div>
            <div class="py-12">

                <div class="max-w-7xl mx-auto">
                    <a class="inline-flex items-right px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest" href="{{ route('ouvrages.index') }}">
                        Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>