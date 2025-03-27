<?php
namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne; // Import this for MorphOne
use App\Models\UserInfo;
use App\Models\Interactions;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $fillable = [
        'id',
        'nick_name',
        'bio',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'logout_at',
        'created_at',
        'updated_at',
    ];


    public function posts() {

        return $this->hasMany(Content::class,'user_id')->where('content_id',null);

    }

    public function user_info(): HasOne
    {
        return $this->hasOne(UserInfo::class);
    }
    public function avatar(): MorphOne
    {
        return $this->morphOne(Images::class, 'origin');

    }

    public function getAvatar()
    {

        if (isset($this->avatar)) {
            return $this->avatar->getDir();
        } else {
            return '../img/user.png';
        }

    }

    public function followers(){

        return $this->morphMany( Interactions::class, 'interaction');

    }

    public function postsInteractions() {

       return $this->hasMany(Interactions::class, 'user_id')->where('interaction_type','Post');
    }


    public function likedPost($postId){

        $post = $this->postsInteractions->where('interaction_id',$postId);

        if($post->count() > 0) {return true;} else {return false;}
    }
    public function isFollowing($postId){

        $post = User::find($postId)
        ->followers->where('user_id',$this->id)
        ->first();

        if($post) {return true;} else {return false;}
    }

    public function followings() {
        return $this->HasMany( Interactions::class, 'user_id')->where('interaction_type','User');
    }

    public function followersCount() {
       return $this->followers->count();
    }

    public function followingsCount() {
        return $this->followings->count();
    }

    public function isOnline()
    {
        
        $sessionLifetime = Config::get('session.lifetime');

        
        $session = DB::table('sessions')
        ->where('user_id', $this->id)
        ->latest('last_activity')
        ->first();

        if (!$session) {
            return false;
        }

        $lastActivity = $session->last_activity;

        $expirationTime = Carbon::createFromTimestamp($lastActivity)->addMinutes($sessionLifetime);

        if (isset($this->logout_at) || now() >= $expirationTime) {
            return false;
        }

        return true;
    }

}