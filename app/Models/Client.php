<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
    ];
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

}
