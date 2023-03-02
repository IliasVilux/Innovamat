<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;

class Itinerary extends Model
{
    use HasFactory;
    protected $table = 'itineraries';

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
