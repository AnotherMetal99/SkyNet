<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Profile;
use App\Traits\Likeable ;
use App\Traits\Friendable;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Likeable ;
    use HasProfilePhoto;
    use Notifiable;
    use Friendable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'lastname',
        'username',
        'age',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * The relationships
     *
     * @var array
     */
    protected $with = ['profile'];

    
    /**
    * Get the default profile photo URL if no profile photo has been uploaded.
    *
    * @return string
    */
   protected function defaultProfilePhotoUrl()
   {
       return 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&color=7F9CF5&background=EBF4FF';
   }

    public function profile(){
       return $this->hasOne(Profile::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }
    
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function scopeFollowers($query){
        return $query->noAuth()->orWhereIn('id', auth()->user()->friends_ids());
    }

    public function scopeNoAuth(){
        return $this->where('id', '!=', auth()->id());
    }
}
