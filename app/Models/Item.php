<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Item extends Model {
    use HasFactory;

    protected $fillable = [
        'created_by',
        'updated_by',
        'title',
        'title_long',
        'cover_path',
        'pdf_path',
        'publisher',
        'publisher_when',
        'publisher_where',
        'type',
        'language',
        'description',
        'provider',
        'rights',
        'ISBN',
        'status',
    ];

    // protected $casts = [
    //     'publisher_when' => 'date:d-m-Y',
    // ];

    public const STATUS_INACTIVE = 'Inactive';
    public const STATUS_ACTIVE = 'Active';
    public const type_Book = 'Book';
    public const type_OldBook = 'Old Book';
    public const type_Manuscript = 'Manuscript';
    public const type_Map = 'Map';
    public const type_Periodic = 'Periodic';
    public const null_Unknown = 'Unknown'; // Used if a field is null (Example: When publishing year is not known)

    // Basic Filters
    public function scopeFilter($query, array $filters) {
        $request = request();

        // Subject Tag Filter
        if($filters['subject'] ?? false) {
            $query->whereHas('subjects', function($query) {
                $query->where('title', request('subject'));
            });
        }


        // Advanced Search Filter
        if(array_key_exists('search', $filters)) {
            $query->when($request->search, function($query) use($request) {
                $query->where('title', 'like', '%' . $request->search . '%');
                    })
                ->when($request->authors, function ($query) use ($request) {
                    foreach($request->authors as $author) {
                        $query->whereHas('authors', function ($query) use ($author) {
                            $query->where('fullname', $author);
                        });
                    }
                })
                ->when($request->subjects, function ($query) use ($request) {
                    foreach($request->subjects as $subject) {
                        $query->whereHas('subjects', function ($query) use ($subject) {
                            $query->where('title', $subject);
                        });
                    }
                })
                ->when($request->publisher_when, function ($query) use ($request) {
                    $query->where('publisher_when', 'LIKE', '%' . $request->publisher_when . '%');
                })
                ->when($request->collection, function ($query) use ($request) {
                    $query->whereHas('collections', function ($query) use ($request) {
                        $query->where('title', 'LIKE', '%' . $request->collection . '%');
                    });
                })
                ->when($request->type, function ($query) use ($request) {
                    $query->where('type', $request->type);
                });

        }


        // Simple Search for Main Search Bar
        if($filters['NOthing here Yet'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orwhere('description', 'like', '%' . request('search') . '%')
                ->orwhereHas('subjects', function($query) {
                    $query->where('title', 'like', '%' .request('search') . '%');
                })
                ->orwhere('publisher', 'like', '%' . request('search') . '%')
                ->orwhereHas('authors', function($query) {
                    $query->where('fullname', 'like', '%' .request('search') . '%');
                });

        }
    }


    //  -- Relationships --

// Relationship To User
    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }

// Relationship To User Update
    public function userUpdate() {
        return $this->belongsTo(User::class, 'updated_by');
    }

// Relationship To Author
    public function authors() {
        return $this->belongsToMany(Author::class, 'author_item');
    }

// Relationship To Collection
    public function collections() {
        return $this->belongsToMany(Collection::class, 'collection_item');
    }

// Relationship To OneCollection
    public function OneCollection() {
        return $this->belongsToMany(Collection::class, 'collection_item')->limit(1);
    }

// Relationship To Subjects
    public function subjects() {
        return $this->belongsToMany(Subject::class);
    }

}
