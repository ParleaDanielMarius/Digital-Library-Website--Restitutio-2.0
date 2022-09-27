<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'location',
        'status',
    ];

    public const role_Admin = 'Admin';
    public const role_Librarian = 'Librarian';
    public const STATUS_ACTIVE = 'Active';
    public const STATUS_INACTIVE = 'Inactive';


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function isAdmin() {
        if ($this->role == self::role_Admin) {
            return $this;
        } else {
            return null;
        }
    }


    // Advanced Search for User Manage View
    public function scopeFilter($query, array $filters)
    {
        $request = request();
        if(array_key_exists('username' ,$filters)) {
            $query->when($request->first_name, function ($query) use ($request) {
                $query->where('first_name', 'LIKE', '%' . $request->first_name . '%');
            })
                ->when($request->last_name, function ($query) use ($request) {
                    $query->where('last_name', 'LIKE', '%' . $request->last_name . '%');
                })
                ->when($request->email, function ($query) use ($request) {
                    $query->where('email', 'LIKE', '%' . $request->email . '%');
                })
                ->when($request->username, function ($query) use ($request) {
                    $query->where('username', 'LIKE', '%' . $request->username . '%');
                })
                ->when($request->location, function ($query) use ($request) {
                    $query->where('location', 'LIKE', '%' . $request->location . '%');
                })
                ->when($request->status, function ($query) use ($request) {
                    $query->where('status', $request->status);
                })
                ->latest();
        }
    }

    // Relationship to Authors
    public function authors() {
        return $this->hasMany(Author::class, 'created_by');
    }

    // Relationship to Authors
    public function deletions() {
        return $this->hasMany(Deletion::class, 'deleted_by');
    }

    // Relationship to Items
    public function items() {
        return $this->hasMany(Item::class, 'created_by');
    }

    // Relationship to Collections
    public function collections() {
        return $this->hasMany(Collection::class, 'created_by');
    }


}
