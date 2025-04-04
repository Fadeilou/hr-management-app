@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Ajouter un Nouvel Employé</h1>

    <form action="{{ route('employes.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nom Complet</label>
            <input type="text" name="name" id="name" required value="{{ old('name') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('name') border-red-500 @enderror">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" required value="{{ old('email') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('email') border-red-500 @enderror">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="position" class="block text-sm font-medium text-gray-700">Poste</label>
            <input type="text" name="position" id="position" required value="{{ old('position') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('position') border-red-500 @enderror">
             @error('position')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="department" class="block text-sm font-medium text-gray-700">Département</label>
            <input type="text" name="department" id="department" required value="{{ old('department') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('department') border-red-500 @enderror">
             @error('department')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

         <div>
            <label for="hire_date" class="block text-sm font-medium text-gray-700">Date d'embauche</label>
            <input type="date" name="hire_date" id="hire_date" required value="{{ old('hire_date') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('hire_date') border-red-500 @enderror">
             @error('hire_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

         <div>
            <label for="salary" class="block text-sm font-medium text-gray-700">Salaire (Optionnel)</label>
            <input type="number" step="0.01" name="salary" id="salary" value="{{ old('salary') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('salary') border-red-500 @enderror">
             @error('salary')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
            <select name="status" id="status" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('status') border-red-500 @enderror">
                <option value="actif" {{ old('status', 'actif') == 'actif' ? 'selected' : '' }}>Actif</option>
                <option value="en_conge" {{ old('status') == 'en_conge' ? 'selected' : '' }}>En Congé</option>
                <option value="licencie" {{ old('status') == 'licencie' ? 'selected' : '' }}>Licencié</option>
            </select>
            @error('status')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end space-x-4">
             <a href="{{ route('employes.index') }}" class="text-gray-600 hover:text-gray-900">Annuler</a>
             <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Enregistrer
            </button>
        </div>
    </form>
@endsection