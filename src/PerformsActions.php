<?php

declare(strict_types=1);

namespace Activity;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait PerformsActions
{
    // TODO: Write trait for models that perform actions, e.g. User

    // A trait called PerformsActions which can be added to the User to allow the developer to easily fetch the users activity

   public function bootPerformsActions():MorphMany
   {
        $users = $this->performedActions();
        return $users;

   }

   public  function performedActions():MorphMany
   {
       return $this->morphMany(Action::class,'actionable');
   }

}