# A complete upvote and downvote solution

This package delivers several solutions. Pick and use all or the one which meets your needs. 



Current version: 
[![Latest Stable Version](https://poser.pugx.org/unrulynatives/attitudes-laravel-upvote-solutions/v/stable)](https://packagist.org/packages/unrulynatives/attitudes-laravel-upvote-solutions)


## Features

Three different values available for storing likes and upvotes


    - `importance` - might be used for observing and prioritizing content with values from range `0` to `10`.

    - `attitude` - might store values `-1`, `0`, `1` for likes and dislikes.

    - `activated` - might store values `-1`, `0`, `1` for likes and dislikes.

    - `favoritetype_id` - Just a scaffold for future development. An item might be stored in favorites under a certain subcategory. `null` would mean the root folder. This feature would require an extra model `Favoritetype`.




## Installation

1. Add this line to your 'composer.json`

`"unrulynatives/attitudes": "0.*"`

2. register the service provider in `config/app.php`.

    

3. Update your `User.php` model with this package's trait. (currently in non-working condition!)



```

    
    public function importances() {
        return $this->hasMany(\App\Models\Userattitude::class, 'creator_id');
    }
    
    public function attitudes() {
        return $this->hasMany(\App\Models\Userattitude::class, 'creator_id');
    }

```

Add these  functions to your model, in which you wish to use voting system (this package's trait is still not developed, contributors welcome!)
```
    
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


        

```

4. Publish migrations, views, controller and other assets from this package into your Laravel app:

`php artisan vendor:publish --provider="Unrulynatives\Attitudes\AttitudesServiceProvider" --force`

Now run the migrations with command `php artisan migrate`. Verify that the table `userattitudes` was created.

5. (unfinished) Update your models with this package's trait.

The trait is under development. For now just paste the below functions to your models:

```

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


```
6. Routes (optional)

Properly working routes necessary to service voting are locatad within ths package:

```
Route::any('{itemkind}/{id}/set_user_attitude', ['as' => 'attitudes.set_user_attitude', 'uses' => 'AttitudesController@set_user_attitude']);
Route::any('{itemkind}/{id}/set_user_importance', ['as' => 'attitudes.set_user_importance', 'uses' => 'AttitudesController@set_user_importance']);
```

You can put them in your location of choice

7. Attach the js and css files to your template. Mind the file paths if you decide to place them somewhere else than they are published to.

```
<link href="{{URL::to('css/unrulynatives_attitudes.css')}}" rel="stylesheet">

<script type="text/javascript" src="{{URL::to('js/minitool_attitudes.js')}}"></script>
```

8. Include the below view files in your `foreach` loop. Note that the looped variable should be changed accordingly. Here I use `$o->`.

```
	$itemkind = 'features'; // features is a name of your model
    @include('userattitudes._userattitudes_attitude_toggle_abstracted', ['itemkind' => $itemkind,'o' => $o, 'attitude' => (($cua = $o->user_approach(Auth::user())) ? $cua->attitude : NULL)])

    @include('userattitudes._userattitudes_importance_toggle_abstracted', ['itemkind' => $itemkind,'o' => $o, 'importance' => (($cua = $o->user_approach(Auth::user())) ? $cua->importance : NULL)])


```
Note: `itemkind` is plural lovercase name of your model. Take a look at the controller function: the `itemkind` name is changed into class name in order to process your request.

Note 2: The models which are attituded should have the morph class defined. The names are stored in the DB table `userattitudes` in column `item_type`.
I myself define the morph class definitions manually, just to be sure that Laravel functions won't use some unusual defaults. 
Do it in `app\Providers\AppServiceProvider.php`. Use the instructions in https://laravel.com/docs/5.3/upgrade.



9. That's it! Now  user choices should be stored in the database table `userattitudes`.

10. Working demo. 

If you installed this package correctly, point your browser to `attitudes-demo`.
- You should be logged in
- you sould have the `app\Models\Feature` model defined and at least one record in your database present. You can just simply use your own model for your test run - it's up to you.

An online demo is available at http://dev.unrulynatives.com/attitudes-demo



## Help and documentation

point your browser to `attitudes-docs` to see instructions. If you cannot see the docs, then you have a problem to solve. Good luck!
After you use the `publish` command, the file will be located at `resources/views/userattitudes/features/index.blade.php`