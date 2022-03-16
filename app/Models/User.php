<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name'
    ];

       /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function scopeContactsInformations($search, $sort = 'created_at', $order = 'asc') {
        return $this->with(['phones', 'addresses'])
        ->when($search != null, function($query) use ($search) {
            $query->where(function($query) use ($search) {
                $query->where('first_name', 'LIKE', "%{$search}%")
                ->orWhere('last_name', 'LIKE', "%{$search}%")
                ->orWhereHas('addresses', function ($query) use ($search) {
                    $query->where('address', 'LIKE', "%{$search}%");
                })
                ->orWhereHas('phones', function($query) use ($search) {
                    $query->where('phone', 'LIKE', "%{$search}%");
                });
            });
        })->orderBy($sort, $order)->get();
    }
}
