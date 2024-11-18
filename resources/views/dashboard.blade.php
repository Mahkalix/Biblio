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
                            id="searchQueryUsagers"
                            name="query"
                            placeholder="Rechercher un usager (prénom, nom)"
                            required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 text-gray-800"
                            value="{{ old('query', '') }}">
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

                <script>
                    // Lorsque la page se charge, on vérifie s'il y a des résultats stockés dans le localStorage
                    window.addEventListener('DOMContentLoaded', () => {
                        const storedResults = localStorage.getItem('searchResultsUsagers');
                        const storedQuery = localStorage.getItem('searchQueryUsagers');
                        const inputField = document.getElementById('searchQueryUsagers');
                        const resultsContainer = document.getElementById('searchResultsUsagers');

                        if (storedQuery) {
                            inputField.value = storedQuery; // Remettre la dernière valeur de recherche
                        }

                        if (storedResults) {
                            resultsContainer.innerHTML = storedResults; // Afficher les résultats précédents
                        }
                    });

                    // Formulaire de recherche des usagers
                    document.getElementById('searchFormUsagers').addEventListener('submit', async function(e) {
                        e.preventDefault();

                        const query = document.getElementById('searchQueryUsagers').value.trim();
                        const token = document.querySelector('input[name="_token"]').value;
                        const resultsContainer = document.getElementById('searchResultsUsagers');

                        // Vérifier si le champ de recherche est vide
                        if (!query) {
                            resultsContainer.innerHTML = '<p class="text-red-500">Veuillez entrer un usager</p>';
                            return;
                        }

                        // Afficher un message de chargement
                        resultsContainer.innerHTML = '<p class="text-gray-600">Recherche en cours...</p>';

                        try {
                            const response = await fetch(`{{ route('usager.rechercher') }}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': token
                                },
                                body: JSON.stringify({
                                    query
                                })
                            });

                            // Vérification si la requête a échoué
                            if (!response.ok) throw new Error('Erreur réseau ou serveur');

                            const data = await response.json();
                            resultsContainer.innerHTML = ''; // Réinitialiser le conteneur de résultats

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

                            // Sauvegarder les résultats dans localStorage
                            localStorage.setItem('searchResultsUsagers', resultsContainer.innerHTML);
                            localStorage.setItem('searchQueryUsagers', query); // Sauvegarder la recherche
                        } catch (error) {
                            console.error('Erreur:', error);
                            resultsContainer.innerHTML = '<p class="text-red-500">Une erreur est survenue. Veuillez réessayer plus tard.</p>';
                        }
                    });
                </script>

                <!-- Formulaire de recherche Ouvrages-->
                <form id="searchFormOuvrages" class="mb-6">
                    @csrf
                    <div class="flex items-center space-x-4">
                        <input
                            type="text"
                            id="searchQueryOuvrages"
                            name="query"
                            placeholder="Rechercher un ouvrage"
                            required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 text-gray-800"
                            value="{{ old('query', '') }}">
                        <button
                            type="submit"
                            class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-md transition-colors duration-300">
                            Rechercher
                        </button>
                    </div>
                </form>

                <!-- Résultats de recherche des Ouvrages -->
                <div id="searchResultsOuvrages" class="mt-6">
                    <!-- Les résultats seront injectés ici -->
                </div>

                <script>
                    // Lorsque la page se charge, on vérifie s'il y a des résultats stockés dans le localStorage
                    window.addEventListener('DOMContentLoaded', () => {
                        const storedResults = localStorage.getItem('searchResultsOuvrages');
                        const storedQuery = localStorage.getItem('searchQueryOuvrages');
                        const inputField = document.getElementById('searchQueryOuvrages');
                        const resultsContainer = document.getElementById('searchResultsOuvrages');

                        if (storedQuery) {
                            inputField.value = storedQuery; // Remettre la dernière valeur de recherche
                        }

                        if (storedResults) {
                            resultsContainer.innerHTML = storedResults; // Afficher les résultats précédents
                        }
                    });

                    // Formulaire de recherche des ouvrages
                    document.getElementById('searchFormOuvrages').addEventListener('submit', async function(e) {
                        e.preventDefault();

                        const query = document.getElementById('searchQueryOuvrages').value.trim();
                        const token = document.querySelector('input[name="_token"]').value;
                        const resultsContainer = document.getElementById('searchResultsOuvrages');

                        // Vérifier si le champ de recherche est vide
                        if (!query) {
                            resultsContainer.innerHTML = '<p class="text-red-500">Veuillez entrer un ouvrage</p>';
                            return;
                        }

                        // Afficher un message de chargement
                        resultsContainer.innerHTML = '<p class="text-gray-600">Recherche en cours...</p>';

                        try {
                            const response = await fetch(`{{ route('bibliotheque.rechercher') }}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': token
                                },
                                body: JSON.stringify({
                                    query
                                })
                            });

                            // Vérification si la requête a échoué
                            if (!response.ok) throw new Error('Erreur réseau ou serveur');

                            const data = await response.json();
                            resultsContainer.innerHTML = ''; // Réinitialiser le conteneur de résultats

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

                            // Sauvegarder les résultats dans localStorage
                            localStorage.setItem('searchResultsOuvrages', resultsContainer.innerHTML);
                            localStorage.setItem('searchQueryOuvrages', query); // Sauvegarder la recherche
                        } catch (error) {
                            console.error('Erreur:', error);
                            resultsContainer.innerHTML = '<p class="text-red-500">Une erreur est survenue. Veuillez réessayer plus tard.</p>';
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</x-app-layout>