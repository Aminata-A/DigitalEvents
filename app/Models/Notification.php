<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'object',
        'message',
        'id_evenement'
    ];
     
    public function evenements(){
        return $this->belongsTo(Evenement::class);
    }
}
