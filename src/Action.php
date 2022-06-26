<?php

declare(strict_types=1);

namespace Activity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Action extends Model
{
    // TODO: Write logic for actions model

    

    //A model called Action that relates to this table and holds the logic for an individual event -DONE
        // - An action should know the type of action (create, update, delete)
        // - Each action should be related to a "performer" model and a "subject" model - DONE
                // - For simplicity, you can assume that any application using this package would have a `users` table and that the `User` model is the "performer"
                // - You can assume that the performer is the currently authenticated user
                // - The "subject" model could be any/all models defined in the application (including the `User`) 
        // - An action should be able to output a translated string summarising the action, including whoever performed the action and the item that it was performed on
            // 1) An action should know the type of action (create, update, delete), 
            // 2) including whoever performed the action,  
            // 3) item that it was performed on

   

    protected $fillable = ['type','userId'];

    private $itemEvents = ['created','updated','destroyed']; // Developer can add more events.

    public function performAction($event){

        if($event == 'created'){
            static::create([
                'user_id'=>auth()->id(),
                'actionable_id'=>$this->id,
                'actionable_type'=>get_class($this), // get the name of the class
                'action_type'=>'create'
                ]);
        }
        if($event == 'updated'){
            //
        }
    }



    //- An action should be able to output a translated string summarising the action, including whoever performed the action and the item that it was performed on - DONE
    public function getDescription(int $actionId) :string
    {
        $action = Action::find($actionId);

        $description = "The action ".$action->type. " was created by ".$action->actionable_type." .";

        return $description;
    }
    
    
   
}