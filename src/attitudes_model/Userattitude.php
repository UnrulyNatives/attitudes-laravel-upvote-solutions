<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Slynova\Commentable\Traits\Commentable;

class Userattitude extends Model
{

    use Commentable;
    protected $dates = ['deleted_at'];
    protected $table = 'userattitudes';
    protected $fillable = [];


    public static function boot()
    {
        parent::boot();

        static::observe(new \App\Models\Observers\UserattitudeObserver);
    }


    public function relatedlinks()
    {
        return $this->hasMany(\App\Models\Related::class, 'item_id')->Where('itemkind', '=', 'userattitudes', 'and')->Where('status', '!=', '2');
    }

    public function user()
    {
        return $this->belongsTo(App\User::class, 'creator_id');
    }

    public function item()
    {
        return $this->morphTo('item');
    }

    public function questions()
    {
        return $this->morphTo('item')->where('item_type', 'question');
    }


    public function topics()
    {
        return $this->morphTo('item')->where('item_type', 'topic');
    }



    public function entities()
    {
        return $this->morphTo('item')->where('item_type', 'entity');
    }

        public function countries()
    {
        return $this->morphTo('item')->where('item_type', 'country');
    }


        public function actions()
    {
        return $this->morphTo('item')->where('item_type', 'action');
    }

            public function counteractions()
    {
        return $this->morphTo('item')->where('item_type', 'counteraction');
    }
            public function tactics()
    {
        return $this->morphTo('item')->where('item_type', 'tactic');
    }

        public function taskgroups()
    {
        return $this->morphTo('item')->where('item_type', 'taskgroup');
    }

        public function tasks()
    {
        return $this->morphTo('item')->where('item_type', 'task');
    }


        public function exemplars()
    {
        return $this->morphTo('item')->where('item_type', 'exemplar');
    }

        public function skills()
    {
        return $this->morphTo('item')->where('item_type', 'skill');
    }


        public function widgets()
    {
        return $this->morphTo('item')->where('item_type', 'widget');
    }

        public function percepts()
    {
        return $this->morphTo('item')->where('item_type', 'percept');
    }

        public function inquiries()
    {
        return $this->morphTo('item')->where('item_type', 'inquiry');
    }

        public function examples()
    {
        return $this->morphTo('item')->where('item_type', 'example');
    }

        public function entityrelationtypes()
    {
        return $this->morphTo('item')->where('item_type', 'entityrelationtype');
    }

        public function entityrelations()
    {
        return $this->morphTo('item')->where('item_type', 'entityrelation');
    }


        public function relateds()
    {
        return $this->morphTo('item')->where('item_type', 'related');
    }




    public function country()

        {
            return $this->belongsTo (\App\Models\Country::class, 'item_id');
        }


    public function topic()

        {
            return $this->belongsTo (\App\Models\Topic::class, 'item_id');
        }

    public function question()

        {
            return $this->belongsTo (\App\Models\Question::class, 'item_id');
        }


    public function entity()

        {
            return $this->belongsTo (\App\Models\Entity::class, 'item_id');
        }

    public function eventrelation()

        {
            return $this->belongsTo (\App\Models\Eventrelation::class, 'item_id');
        }


    public function event()

        {
            return $this->belongsTo (\App\Models\Event::class, 'item_id');
        }


    public function action()

        {
            return $this->belongsTo (\App\Models\Action::class, 'item_id');
        }

    public function taskgroup()

        {
            return $this->belongsTo (\App\Models\Taskgroup::class, 'item_id');
        }

    public function task()

        {
            return $this->belongsTo (\App\Models\Task::class, 'item_id');
        }


    public function exemplar()

        {
            return $this->belongsTo (\App\Models\Exemplar::class, 'item_id');
        }


    public function widget()

        {
            return $this->belongsTo (\App\Models\Widget::class, 'item_id');
        }



    public function percept()

        {
            return $this->belongsTo (\App\Models\Percept::class, 'item_id');
        }



    public function inquiry()

        {
            return $this->belongsTo (\App\Models\Inquiry::class, 'item_id');
        }



    public function example()

        {
            return $this->belongsTo (\App\Models\Example::class, 'item_id');
        }



    public function entityrelationtype()

        {
            return $this->belongsTo (\App\Models\Entityrelationtype::class, 'item_id');
        }


    public function entityrelation()

        {
            return $this->belongsTo (\App\Models\Entityrelation::class, 'item_id');
        }

    public function skill()

        {
            return $this->belongsTo (\App\Models\Skill::class, 'item_id');
        }


    public function related()

        {
            return $this->belongsTo (\App\Models\Related::class, 'item_id');
        }




    public function forStandpoint()

        {
            return $this->belongsTo (\App\Models\Entitystandpoint::class, 'standpoint_id');
        }

    public function wrongdoings()

        {
            return $this->hasMany (\App\Models\Entitystandpoint::class, 'standpoint_id');
        }


    // public function events()
    // {
    //     return $this->morphTo('item')->where('item_type', 'event');
    // }



    public function events(){
        return $this->morphedByMany(\App\Models\Event::class, 'item', null, null, 'creator_id');
    }


    public function entitystandpoint()
    {
        if ($this->item_type == 'entitystandpoint') {
            return $this->belongsTo(\App\Models\Entitystandpoint::class, 'item_id');
        } else {
            return null;
        }
    }

}