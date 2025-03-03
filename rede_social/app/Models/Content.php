<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\Users;
use App\Models\Images;

class Content extends Model
{
    protected $fillable = [

        'id',
        'users_id',
        'status',
        'content_id',
        'content_type',
        'content',
        'created_at',
        'updated_at'

    ];

    public function originalcomment() {

        if(!$this->content_id) {
            return False;
        }

        $originalcomment = Content::where('id',$this->content_id)
        ->where('content_type','Comment')
        ->first();
  
        return $originalcomment;

    }

    public function getOrignalCommentNickname() {

        if(!$this->originalComment()) {
            return false;
        }

        return $this->originalComment()->user->nick_name;

    }

    public function enjoyers(){

        return $this->morphMany( Interactions::class, 'interaction');

    }

    public function validComments() {

        return $this->where('content_id',$this->id)->where('content_type','Comment')->where('status',true)->get();

    }

    public function allComments() {

        return $this->where('content_id',$this->id)->where('content_type','Comment')->get();

    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'users_id', 'id');
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Images::class, 'origin');
    }

    public function getTime() {

        $created_time = strtotime($this->created_at);
        $current_time = time();

        $post_age = $current_time - $created_time;

        if($post_age > 31535965.4396976) {

            $years = $post_age/31535965.4396976;

            return round($years) . ' year(s) ago';

        }

        if($post_age > 2.628e+6) {

            $months = $post_age/2.628e+6;

            return round($months) . ' month(s) ago';

        }

        if($post_age > 604800) {

            $weeks = $post_age/604800;

            return round($weeks) . ' week(s) ago';

        }

        if($post_age > 86400) {

            $days = $post_age/86400;

            return round( $days) . ' day(s) ago.';
        }

        if($post_age > 3600) {

            $hours = $post_age/3600;

            return round($hours) . ' hour(s) ago.';
        }

        if($post_age > 60) {

            $minutes = $post_age/60;

            return round($minutes) . ' minute(s) ago.';
        }

        return 'Posted now.';

    }
}
