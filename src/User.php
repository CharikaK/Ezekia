<?php

declare(strict_types=1);

namespace Activity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Model\Post;
use Activity\Action;


class User extends Model
{
    // TODO: Write logic for actions model
    
    // A trait called PerformsActions which can be added to the User to allow the developer to easily fetch the users activity

    protected $fillable =['name','username','password'];

    use PerformsActions;

    public function posts():HasMany
    {
        return $this->hasMany(Post::class, 'user_id','id');
    }
}