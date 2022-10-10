<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'updated_by',
        'status',
        'title',
        'cover_path',
        'description'
    ];

    // Status constants for collections (To make life easier? Did they?)
    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';

    // Filters
    public function scopeFilter($query, array $filters) {
        // Get request
        $request = request();
        // Check if search filter exists
        if(array_key_exists('search' ,$filters)) {
            // Query collection
            $query->where('title', 'LIKE', '%'. $request->search . '%')
                ->when($request->subjects, function($query) use($request) {
                    $query->whereHas('items', function($query) use($request) {
                        $query->whereHas('subjects', function($query) use($request) {
                            $query->where('title', 'LIKE', '%' . $request->subjects. '%');
                        });
                    });
                })
            ;
        }
    }


    // Relationship To User
    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relationship To User Update
    public function userUpdate() {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Relationship To Items
    public function items() {
        return $this->belongsToMany(Item::class, 'collection_item');
    }

}
