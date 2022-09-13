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

    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';

    public function scopeFilter($query, array $filters) {
        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orwhere('description', 'like', '%' . request('search') . '%');


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
