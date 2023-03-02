<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;

class Interaction extends Model
{
    use HasFactory;
    protected $table= 'interactions';
    protected $fillable = ['user_id', 'activity_id', 'activitySolution'];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
    
}
