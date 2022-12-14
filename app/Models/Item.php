<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

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
        'slug',
    ];

    //public $keyType = "string";

    // A ton of constants for items used pretty much everywhere (To make life easier? Did they?)
    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;
//    public const TYPES = ['Book', 'Old Book', 'Manuscript', 'Map', 'Serial', 'Ex Libris', 'Photograph', 'Document', 'Postcard','Other'];
    public const type_Book = 'Carte';
    public const type_OldBook = 'Carte Veche';
    public const type_Manuscript = 'Manuscris';
    public const type_Map = 'Hartă';
    public const type_Serial = 'Serial';
    public const type_ExLibris = 'Ex Libris';
    public const type_Photograph = 'Fotografie';
    public const type_Document = 'Document';
    public const type_Postcard = 'Carte Poștală';
    public const type_Other = 'Other';
    public const null_Unknown = 'Necunoscut'; // Used if a field is null (Example: When publishing year is not known)
                                             // Not really used anymore as front-end should take care of this (SHOULD)

    // Filters
    public function scopeFilter($query, array $filters) {
        // Get Request
        $request = request();

        // Initialize arrays
//        $authors = array();
//        $subjects = array();

        // Used to allow search for multiple authors in the same field
//        if($request->authors != null) {
//            $authors = explode(', ', $request->authors);
//        }
//        // Same as above
//        if($request->subjects != null) {
//            $subjects = explode(', ', $request->subjects);
//        }

//        // Checks if one-digit month was entered and add 0 in front of it
//        if($request->month_from != null) {
//            if(strlen($request->month_from) == 1) {
//                $request->month_from = 0 . $request->month_from;
//            }
//        }
//        // Same as above
//        if($request->month_to != null) {
//            if(strlen($request->month_to) == 1) {
//                $request->month_to = 0 . $request->month_to;
//            }
//        }
        // Check if search filter exists
        if(array_key_exists('search' ,$filters)) {
            $query->when($request->search, function($query) use($request) {
                $query->where(function($query) use($request) {
                        $query->where('title', 'like', '%' . $request->search . '%')
                            ->orWhere('title_long', 'like', '%' . $request->search . '%');
                        });
                    })
                ->when(!empty($request->authors[0]), function ($query) use ($request) {
                    // Queries each author
                        foreach($request->authors as $author) {
                            $query->whereHas('authors', function ($query) use ($author) {
                                $query->where('fullname', 'like', '%' . $author . '%');
                            });
                        }
                })
                ->when(!empty($request->subjects[0]), function ($query) use ($request) {
                    // Queries each subject
                        foreach($request->subjects as $subject) {
                            $query->whereHas('subjects', function ($query) use ($subject) {
                                $query->where('title', 'like', '%' . $subject . '%');
                            });
                        }
                })
                ->when($request->language, function ($query) use ($request) {
                    $query->where('language', 'like', '%' . $request->language . '%');
                })
                ->when($request->year_from ?? $request->year_to, function ($query) use ($request) {
                    $query->whereBetween('publisher_year', [($request->year_from ?? $request->year_to), ($request->year_to ?? $request->year_from)]);
                })
                ->when($request->month_from ?? $request->month_to, function ($query) use ($request) {
                    $query->whereBetween('publisher_month', [($request->month_from ?? $request->month_to), ($request->month_to ?? $request->month_from)]);
                })

                ->when($request->type && $request->type != self::type_Other, function ($query) use ($request) {
                    $query->where('type', $request->type);
                })

                ->when($request->additionalType, function ($query) use ($request) {
                    $query->where('type', $request->additionalType);
                });



        }
    }


    //  -- Relationships --  \\

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
        return $this->belongsToMany(Author::class, 'author_item')
            ->withPivot('contribution');
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
