<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;

class Exercice extends Model
{
    use HasFactory;
    protected $table = 'exercices';

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
