<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-5 text-gray-900">
                {{ __("You're logged in!") }}
            </div>


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Formulaire de recherche pour usagers -->
                <form id="searchFormUsagers" class="mb-6">
                    @csrf
                    <div class="flex items-center space-x-4">
                        <input
                            type="text"
                            id="searchQuery"
                            name="query"
                            placeholder="Rechercher un usager (prénom, nom)"
                            required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 text-gray-800">
                        <button
                            type="submit"
                            class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-md transition-colors duration-300">
                            Rechercher
                        </button>
                    </div>
                </form>


                <!-- Résultats de recherche -->
                <div id="searchResultsUsagers" class="mt-6">
                    <!-- Les résultats seront injectés ici -->
                </div>

                <!-- Script AJAX pour la recherche d'usagers -->
                <script>
                    document.getElementById('searchFormUsagers').addEventListener('submit', function(e) {
                        e.preventDefault();

                        const query = document.getElementById('searchQuery').value;
                        const token = document.querySelector('input[name="_token"]').value;

                        fetch(`{{ route('usager.rechercher') }}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': token
                                },
                                body: JSON.stringify({
                                    query: query
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                let resultsContainer = document.getElementById('searchResultsUsagers');
                                resultsContainer.innerHTML = '';

                                if (data.length === 0) {
                                    resultsContainer.innerHTML = '<p class="text-gray-600">Aucun usager trouvé</p>';
                                } else {
                                    let list = '<ul class="space-y-4">';
                                    data.forEach(usager => {
                                        list += `
                            <li class="border-b border-gray-200 pb-2">
                                <strong>${usager.prenom} ${usager.nom}</strong>
                                <br>
                                <span class="text-gray-600">${usager.email}</span>
                                <br>
                                <a href="/usagers/${usager.id}" class="text-orange-500 hover:underline">Voir détails</a>
                            </li>`;
                                    });
                                    list += '</ul>';
                                    resultsContainer.innerHTML = list;
                                }
                            })
                            .catch(error => console.error('Erreur:', error));
                    });
                </script>


                <!-- Formulaire de recherche -->
                <form id="searchForm" class="mb-6">
                    @csrf
                    <div class="flex items-center space-x-4">
                        <input
                            type="text"
                            id="searchQuery"
                            name="query"
                            placeholder="Rechercher un ouvrage"
                            required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 text-gray-800">
                        <button
                            type="submit"
                            class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-md transition-colors duration-300">
                            Rechercher
                        </button>
                    </div>
                </form>
                <!-- Résultats de recherche des usagers -->
                <div id="searchResults" class="mt-6">
                    <!-- Les résultats seront injectés ici -->
                </div>

                <script>
                    document.getElementById('searchForm').addEventListener('submit', function(e) {
                        e.preventDefault();

                        const query = document.getElementById('searchQuery').value;
                        const token = document.querySelector('input[name="_token"]').value;

                        fetch(`{{ route('bibliotheque.rechercher') }}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': token
                                },
                                body: JSON.stringify({
                                    query: query
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                let resultsContainer = document.getElementById('searchResults');
                                resultsContainer.innerHTML = '';

                                if (data.length === 0) {
                                    resultsContainer.innerHTML = '<p class="text-gray-600">Aucun ouvrage trouvé</p>';
                                } else {
                                    let list = '<ul class="space-y-4">';
                                    data.forEach(ouvrage => {
                                        list += `
                                        <li class="border-b border-gray-200 pb-2">
                                            <strong>${ouvrage.titre}</strong> par ${ouvrage.auteur}
                                            <br>
                                            <a href="/ouvrages/${ouvrage.id}" class="text-orange-500 hover:underline">Voir détails</a>
                                        </li>`;
                                    });
                                    list += '</ul>';
                                    resultsContainer.innerHTML = list;
                                }
                            })
                            .catch(error => console.error('Erreur:', error));
                    });
                </script>
            </div>
        </div>
    </div>
</x-app-layout>