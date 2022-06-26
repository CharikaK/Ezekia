<?php

declare(strict_types=1);

namespace Activity;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Action;

trait HasActions
{
    // TODO: Write trait for models that have actions performed on them

    // A trait called HasActions to be added to the models that should have their events recorded into actions 
    // The trait should allow the developer to access all actions performed on an item
    // The logic for generating actions based on Laravel events should be in the trait
    

    // same as Models, traits also get automaticcaly booted
    public static function bootHasActions()
    {

        // if it is only create event for any Model that uses the trait
        static::create(function($model) {
            $user = $model->user();

            $model->actions()->create([
                'user_id'=>auth()->id(),
                'actionable_id'=>$this->id,
                'actionable_type'=>get_class($this), // get the name of the class
                'action_type'=>'create'
                ]);
        }); 
       

        // to extend to other evebts in Model
        // loop through Model events and find the fired event
        // then tell the code what to do in each event

        foreach($itemEvents as $event){
            static::$event(function($model) use($event){
                // Also we can introduce another function to find the Model using php new \ReflectionClass($this))->getShortName()
                // and pass the type to action table
                // $type = strtolower(( new \ReflectionClass($model))->getShortName());
                $model->performAction($event);
            });
        }

        

    }








    //The actions() method should be inside the HasActions trait, and use polymorphic relationships
    public function actions():MorphMany
    {
        return $this->morphMany(Action::class,'actionable');
    }

  
}