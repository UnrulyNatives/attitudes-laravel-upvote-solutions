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

trait AttitudesUserExtensions  

{
    // use Authenticatable, Authorizable, CanResetPassword, AdminPermissionsTrait, HasRoles;


    
    public static function boot()
    {
        parent::boot();

        // User::observe(new UserActionsObserver);
    }

    // print $user->testuserattitudes to check if the trait has integrated successfully
    public function getTestuserattitudesAttribute() {
        
        return "testing if the package is correctly integrated!";
    }



    
    public function importances() {
        return $this->hasMany(\App\Models\Userattitude::class, 'creator_id');
    }
    
    public function attitudes() {
        return $this->hasMany(\App\Models\Userattitude::class, 'creator_id');
    }
        


}

