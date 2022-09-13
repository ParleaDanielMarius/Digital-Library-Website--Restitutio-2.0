<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'title'
    ];


    public $timestamps = false;

    // Relationship To Items
    public function items() {
        return $this->belongsToMany(Item::class);
    }
}
