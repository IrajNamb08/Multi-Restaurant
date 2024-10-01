<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Restaurant;
use App\Models\PointdeVente;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'restaurant_id',
        'pointdevente_id',
        'email',
        'password',
    ];

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
        'password' => 'hashed',
    ];

    protected function type(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return ["admin", "restoAdmin", "manager", "cuisinier"][$value];
            },
            set: function ($value) {
                return array_search($value, ["admin", "restoAdmin", "manager", "cuisinier"]);
            }
        );
    }

    public function getHomeRoute()
    {
        Log::info('User type: ' . $this->type);
       
        switch($this->type) {
            case 'admin':
                return route('admin');
            case 'restoAdmin':
                return route('restoAdmin');
            case 'manager':
                return route('manager');
            case 'cuisinier':
                return route('cuisinier');
            default:
                Log::warning('Unknown user type: ' . $this->type);
                return '/';
        }
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function pointdevente()
    {
        return $this->belongsTo(PointdeVente::class);
    }
}
