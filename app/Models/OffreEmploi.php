<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OffreEmploi extends Model
{
    use HasFactory;

    // S'assurer que le nom de la table est correct si différent de la convention Laravel
    protected $table = 'offre_emplois';

    protected $fillable = [
        'title',
        'description',
        'requirements',
        'salary_range',
        'location',
        'department',
        'status',
        'recruiter_id',
        'deadline',
    ];

    // Pour s'assurer que la date est traitée comme un objet Carbon
    protected $casts = [
        'deadline' => 'date',
    ];

    /**
     * Obtenir l'employé recruteur associé à cette offre.
     */
    public function recruiter(): BelongsTo
    {
        return $this->belongsTo(Employe::class, 'recruiter_id');
    }

    /**
     * Helper pour obtenir la classe CSS du badge de statut
     */
     public function getStatusBadgeClass(): string
     {
         return match ($this->status) {
             'brouillon' => 'bg-gray-100 text-gray-800',
             'publiee' => 'bg-blue-100 text-blue-800',
             'fermee' => 'bg-red-100 text-red-800',
             default => 'bg-gray-100 text-gray-800',
         };
     }
}