@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Créer une Nouvelle Offre d'Emploi</h1>

     <form action="{{ route('offres.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Titre de l'offre</label>
            <input type="text" name="title" id="title" required value="{{ old('title') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('title') border-red-500 @enderror">
            @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

         <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" required
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="requirements" class="block text-sm font-medium text-gray-700">Exigences</label>
            <textarea name="requirements" id="requirements" rows="3" required
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('requirements') border-red-500 @enderror">{{ old('requirements') }}</textarea>
            @error('requirements') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

         <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="salary_range" class="block text-sm font-medium text-gray-700">Fourchette Salariale (Optionnel)</label>
                <input type="text" name="salary_range" id="salary_range" value="{{ old('salary_range') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('salary_range') border-red-500 @enderror">
                @error('salary_range') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
             <div>
                <label for="location" class="block text-sm font-medium text-gray-700">Lieu</label>
                <input type="text" name="location" id="location" required value="{{ old('location') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('location') border-red-500 @enderror">
                @error('location') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="department" class="block text-sm font-medium text-gray-700">Département</label>
                <input type="text" name="department" id="department" required value="{{ old('department') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('department') border-red-500 @enderror">
                 @error('department') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
             <div>
                <label for="deadline" class="block text-sm font-medium text-gray-700">Date Limite de Candidature</label>
                <input type="date" name="deadline" id="deadline" required value="{{ old('deadline') }}" min="{{ now()->toDateString() }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('deadline') border-red-500 @enderror">
                 @error('deadline') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

         <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="recruiter_id" class="block text-sm font-medium text-gray-700">Recruteur Associé</label>
                <select name="recruiter_id" id="recruiter_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('recruiter_id') border-red-500 @enderror">
                    <option value="">-- Sélectionnez un recruteur --</option>
                    @foreach($recruiters as $recruiter)
                        <option value="{{ $recruiter->id }}" {{ old('recruiter_id') == $recruiter->id ? 'selected' : '' }}>
                            {{ $recruiter->name }} ({{ $recruiter->position }})
                        </option>
                    @endforeach
                </select>
                @error('recruiter_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                <select name="status" id="status" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('status') border-red-500 @enderror">
                    <option value="brouillon" {{ old('status', 'brouillon') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                    <option value="publiee" {{ old('status') == 'publiee' ? 'selected' : '' }}>Publiée</option>
                    <option value="fermee" {{ old('status') == 'fermee' ? 'selected' : '' }}>Fermée</option>
                </select>
                 @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
         </div>


        <div class="flex items-center justify-end space-x-4">
             <a href="{{ route('offres.index') }}" class="text-gray-600 hover:text-gray-900">Annuler</a>
             <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Enregistrer l'Offre
            </button>
        </div>
    </form>
@endsection