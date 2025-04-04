<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\OffreEmploi;

class Employe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'position',
        'department',
        'hire_date',
        'salary',
        'status',
    ];

    // Pour s'assurer que la date est traitée comme un objet Carbon
    protected $casts = [
        'hire_date' => 'date',
        'salary' => 'decimal:2',
    ];

    /**
     * Obtenir les offres d'emploi gérées par cet employé (en tant que recruteur).
     */
    public function offresRecrutees(): HasMany
    {
        return $this->hasMany(OffreEmploi::class, 'recruiter_id');
    }

    /**
     * Helper pour obtenir la classe CSS du badge de statut
     */
    public function getStatusBadgeClass(): string
    {
        return match ($this->status) {
            'actif' => 'bg-green-100 text-green-800',
            'en_conge' => 'bg-yellow-100 text-yellow-800',
            'licencie' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}