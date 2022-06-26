<?php

declare(strict_types=1);

namespace Activity;

use Illuminate\Database\Eloquent\Model;

use Activity\Action;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Post extends Model
{
    // TODO: Write logic for actions model
    // For simplicity, you can assume that any application using this package would have a posts table and that the post model is the "performer"
    
    use HasActions;   
   
    protected $fillable =['title','body'];
    
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,'id','postId');
    }

}
