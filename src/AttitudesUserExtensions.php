<?php

namespace UnrulyNatives\Attitudes;



trait AttitudesUserExtensions  

{

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

