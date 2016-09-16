<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;


class Quote extends Model  {



    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'un_a_quotations';
    // protected $morphClass = 'quote';
    protected $dates = ['deleted_at'];





    // IMPORTANCES and ATTITUDES are for the purpose of Userattitudes and Exemplarattitudes. They are our sustem of upvoting and downvoting
    public function importances()
    {
        return $this->morphMany(\App\Models\Userattitude::class, 'item');
    }


    public function attitudes()
    {
        return $this->morphMany(\App\Models\Userattitude::class, 'item');
    }

    public function user_approach($user)
    {
        return $this->morphMany(\App\Models\Userattitude::class, 'item')->where('creator_id', ($user ? $user->id : NULL))->first();
    }



}