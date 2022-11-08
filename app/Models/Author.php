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
        'slug',
    ];


    // Filter
    public function scopeFilter($query, array $filters) {
        // Get Request
        $request = request();

        // Check if search filter exists
        if(array_key_exists('search' ,$filters)) {
            // Query authors
            $query->where('fullname', 'LIKE', '%'. $request->search . '%')
            ->when($request->subjects, function($query) use($request) {
                $query->whereHas('items', function($query) use($request) {
                    $query->whereHas('subjects', function($query) use($request) {
                        $query->where('title', 'LIKE', '%' . $request->subjects. '%');
                    });
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
