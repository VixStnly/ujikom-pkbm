<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Meeting;

class Forum extends Model
{
    protected $fillable = ['meeting_id', 'user_id', 'message', 'image_path','parent_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function meeting() {
        return $this->belongsTo(Meeting::class);
    }

    public function parent()
{
    return $this->belongsTo(Forum::class, 'parent_id');
}

public function replies()
{
    return $this->hasMany(Forum::class, 'parent_id');
}

public function likes()
{
    return $this->belongsToMany(User::class, 'forum_user_likes')->withTimestamps();
}


}
