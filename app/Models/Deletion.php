<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deletion extends Model
{
    use HasFactory;
    protected $fillable = [
        'original_id',
        'created_by',
        'created_at',
        'updated_by',
        'title',
        'title_long',
        'cover_path',
        'pdf_path',
        'publisher',
        'publisher_day',
        'publisher_month',
        'publisher_year',
        'publisher_where',
        'type',
        'language',
        'description',
        'provider',
        'rights',
        'ISBN',
        'ISSN',
        'status',
        'deleted_at',
        'deleted_by',
        'restored_at',
        'had_subjects',
        'had_authors',
        'was_partOf',
        'slug',
        ];

    // protected $casts = [
    //     'publisher_when' => 'date:d-m-Y',
    // ];

    // A ton of constants for deletions used pretty much everywhere (To make life easier? Did they?)
    public const STATUS_INACTIVE = 'Inactive';
    public const STATUS_ACTIVE = 'Active';
    public const type_Book = 'Book';
    public const type_OldBook = 'Old Book';
    public const type_Manuscript = 'Manuscript';
    public const type_Map = 'Map';
    public const type_Periodic = 'Periodic';
    public const null_Unknown = 'Unknown'; // Used if a field is null (Example: When publishing year is not known)
                                            // Not really used anymore as front-end should take care of this (SHOULD)

    // Filters
    public function scopeFilter($query, array $filters) {
        // Get Request
        $request = request();

        // Check if search filter exists
        if(array_key_exists('search' ,$filters)) {
            // Query deletions
            $query->when($request->search, function($query) use($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('title_long', 'like', '%' . $request->search . '%')
                    ->orWhere('deleted_at', 'like', '%' . $request->search . '%');
            });



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

    // Relationship To User Delete
    public function userDelete() {
        return $this->belongsTo(User::class, 'deleted_by');
    }



}
