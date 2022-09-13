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
        if($filters['subject'] ?? false) {
            $query -> whereHas('items', function($query) {
                $query -> whereHas('subjects', function($query) {
                    $query->where('title' , '=', request('subject'));
                });
            });
        }

        // Simple Search for Main Search Bar
        if($filters['search'] ?? false) {
            $query ->whereHas('items', function($query) {
                $query->where('title', 'like', '%' . request('search') . '%')
                    ->orwhere('description', 'like', '%' . request('search') . '%')
                    ->orwhereHas('subjects', function ($query) {
                        $query->where('title', 'like', '%' . request('search') . '%');
                    })
                    ->orwhere('publisher', 'like', '%' . request('search') . '%')
                    ->orwhereHas('authors', function ($query) {
                        $query->where('fullname', 'like', '%' . request('search') . '%');
                    });
            });

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
