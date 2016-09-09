<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ThyagoBrejao\Commentable\Traits\Commentable;

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



    public function user()
    {
        return $this->belongsTo(App\User::class, 'creator_id');
    }

    public function item()
    {
        return $this->morphTo('item');
    }


    public function users()
    {
        return $this->morphTo('item')->where('item_type', 'user');
    }

    public function packages()
    {
        return $this->morphTo('item')->where('item_type', 'package');
    }


    public function features()
    {
        return $this->morphTo('item')->where('item_type', 'feature');
    }



}