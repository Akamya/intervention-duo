<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'title',
        'categorie',
        'commentaire',
        'statut'
    ];
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory;

    // Constantes des statuts disponibles
    public const DONE = 'Done';
    public const PENDING = 'Pending';
    public const TODO = 'ToDo';

    public static function statuts(): array
    {
        return [
            self::DONE,
            self::PENDING,
            self::TODO,
        ];
    }

    // Constantes des catégories disponibles
    public const BUG = 'Bug';
    public const REPARATION = 'Reparation';
    public const MODIFICATION = 'Modification';
    public const ENTRETIEN = 'Entretien';
    public const LOGICIELLE = 'Logicielle';
    public const RESTAURATION = 'Restauration';
    public const INSTALLATION = 'Installation';
    public const CAFE = 'Cafe';

    public static function categories(): array
    {
        return [
            self::BUG,
            self::REPARATION,
            self::MODIFICATION,
            self::ENTRETIEN,
            self::LOGICIELLE,
            self::RESTAURATION,
            self::INSTALLATION,
            self::CAFE,
        ];
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
