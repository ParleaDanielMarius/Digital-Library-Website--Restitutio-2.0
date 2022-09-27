<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'fullname',
        'created_by',
        'updated_by',
    ];

// TODO: Find something better than whatever these abominations are
    // Basic Filters
    public function scopeFilter($query, array $filters) {
        // Subject Filter for Subject Tags
        $request = request();
        if(array_key_exists('search' ,$filters)) {
            $query->where('fullname', 'LIKE', '%'. $request->search . '%');
        }
    }
//

    //  -- RelationShips --

    // Relationship To User
    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relationship To User Update
    public function userUpdate() {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Relationship to Items
    public function items() {
        return $this->belongsToMany(Item::class, 'author_item');
    }
}
