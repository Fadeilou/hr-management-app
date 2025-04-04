@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Gestion des Offres d'Emploi</h1>
        <a href="{{ route('offres.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Créer une Offre
        </a>
    </div>

    <!-- Filtres -->
    <form method="GET" action="{{ route('offres.index') }}" class="mb-6 p-4 bg-gray-50 rounded shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="department" class="block text-sm font-medium text-gray-700">Filtrer par Département</label>
                <select name="department" id="department" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Tous les départements</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>{{ $dept }}</option>
                    @endforeach
                </select>
            </div>
             <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Filtrer par Statut</label>
                <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Tous les statuts</option>
                     @foreach($statuses as $stat)
                        <option value="{{ $stat }}" {{ request('status') == $stat ? 'selected' : '' }}>{{ ucfirst($stat) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mr-2">Filtrer</button>
                <a href="{{ route('offres.index') }}" class="text-gray-600 hover:text-gray-900 py-2 px-4">Réinitialiser</a>
            </div>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Département</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lieu</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Recruteur</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Limite</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($offres as $offre)
                    
                    <tr>
                        {{-- Modifiez la cellule du titre --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            <a href="{{ route('offres.show', $offre) }}" class="text-indigo-600 hover:text-indigo-900">
                                {{ $offre->title }}
                            </a>
                        </td>
                        {{-- Reste des cellules td --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $offre->department }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $offre->location }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{-- Ajout d'un lien vers le recruteur s'il existe --}}
                            @if($offre->recruiter)
                                <a href="{{ route('employes.show', $offre->recruiter) }}" class="text-gray-600 hover:text-indigo-900">
                                    {{ $offre->recruiter->name }}
                                </a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $offre->deadline->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $offre->getStatusBadgeClass() }}">
                                {{ ucfirst($offre->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('offres.edit', $offre) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">Modifier</a>
                            <form action="{{ route('offres.destroy', $offre) }}" method="POST" class="inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                     <tr>
                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Aucune offre d'emploi trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

     <div class="mt-4">
        {{ $offres->links() }} <!-- Liens de pagination (gère les filtres avec withQueryString()) -->
    </div>
@endsection