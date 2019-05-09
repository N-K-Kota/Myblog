<?php
namespace App\Observers;

use App\Models\Tag;
use App\Notifications\TagCreated;
use App\Event\TagCreatedEvent;
class TagObserver
{
    public function created(Tag $tag)
    {
       
        $tag->notify(new TagCreated($tag));
    }
}
