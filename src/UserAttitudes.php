<?php

namespace UnrulyNatives\Attitudes;



trait UserAttitudes  

{
    // use Authenticatable, Authorizable, CanResetPassword, AdminPermissionsTrait, HasRoles;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    // protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = ['name', 'email', 'password', 'role_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = ['password', 'remember_token'];

    public static function boot()
    {
        // parent::boot();

        // User::observe(new UserActionsObserver);
    }


    // print $this->userattitudestest to check if the trait has integrated successfully
    public function getUserattitudestestAttribute() {
        
        return "The trait has integrated successfully!";
    }


    // gives count of ALL votes casts by users (including neutral votes (`attitude` =0))
    public function getCountallvotesAttribute()
    {
        return $this->morphMany(\App\Models\Userattitude::class, 'item')->count();
    }
    // gives count of all UPvotes casts by users
    public function getCountupvotesAttribute()
    {
        return $this->morphMany(\App\Models\Userattitude::class, 'item')->where('attitude', '>',0)->count();
    }
    // gives count of all DOWNvotes casts by users
    public function getCountdownvotesAttribute()
    {
        return $this->morphMany(\App\Models\Userattitude::class, 'item')->where('attitude', '<',0)->count();
    }



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

