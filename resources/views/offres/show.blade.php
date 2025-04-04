@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Détails de l'Offre d'Emploi</h1>
        <div>
             <a href="{{ route('offres.edit', $offre) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Modifier
            </a>
            <a href="{{ route('offres.index') }}" class="text-gray-600 hover:text-gray-900 py-2 px-4">
                Retour à la liste
            </a>
        </div>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ $offre->title }}
            </h3>
             <p class="mt-1 max-w-2xl text-sm text-gray-500">
                {{ $offre->department }} - {{ $offre->location }}
            </p>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
            <dl class="sm:divide-y sm:divide-gray-200">
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Statut</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                         <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $offre->getStatusBadgeClass() }}">
                            {{ ucfirst($offre->status) }}
                        </span>
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Recruteur</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{-- Lien vers la page de détails de l'employé recruteur --}}
                        @if($offre->recruiter)
                            <a href="{{ route('employes.show', $offre->recruiter) }}" class="text-indigo-600 hover:text-indigo-900">
                                {{ $offre->recruiter->name }} ({{ $offre->recruiter->position }})
                            </a>
                        @else
                            N/A
                        @endif
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Date limite de candidature</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $offre->deadline->format('d/m/Y') }}</dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Fourchette Salariale</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $offre->salary_range ?: 'Non spécifiée' }}</dd>
                </div>
                 <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                    
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 whitespace-pre-wrap">{!! nl2br(e($offre->description)) !!}</dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Exigences</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 whitespace-pre-wrap">{!! nl2br(e($offre->requirements)) !!}</dd>
                </div>

            </dl>
        </div>
    </div>
@endsection