<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exercice;
use App\Models\Itinerary;
use App\Models\Interaction;

class Activity extends Model
{
    use HasFactory;
    protected $table = 'activities';

    public function itinerary()
    {
        return $this->belongsTo(Itinerary::class);
    }

    public function exercices()
    {
        return $this->hasMany(Exercice::class, 'activity_id');
    }

    public function interaction()
    {
        return $this->hasMany(Interaction::class);
    }
}
