<?php

namespace UnrulyNatives\Attitudes;


// use Illuminate\Auth\Authenticatable;
// use Illuminate\Auth\Passwords\CanResetPassword;
// use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
// use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
// use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Foundation\Auth\Access\Authorizable;
// use App\Role;
// use Laraveldaily\Quickadmin\Observers\UserActionsObserver;
// use Laraveldaily\Quickadmin\Traits\AdminPermissionsTrait;
// use Spatie\Permission\Traits\HasRoles;

trait Attitudes  

{
    // use Authenticatable, Authorizable, CanResetPassword, AdminPermissionsTrait, HasRoles;


    
    public function importances() {
        return $this->hasMany(\App\Models\Userattitude::class, 'creator_id');
    }
    
    public function attitudes() {
        return $this->hasMany(\App\Models\Userattitude::class, 'creator_id');
    }


    public function user_approach($user)
    {
        return $this->morphMany(\App\Models\Userattitude::class, 'item')->where('creator_id', ($user ? $user->id : NULL))->first();
    }



    public static function boot()
    {
        parent::boot();

        // User::observe(new UserActionsObserver);
    }

    public function getAllattitudescountAttribute() {
        
        return "testing if the package is correctly integrated";
    }


}

