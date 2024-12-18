<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    protected $fillable = [
        'title',
        'comment',
    ];
    /** @use HasFactory<\Database\Factories\InterventionFactory> */
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
