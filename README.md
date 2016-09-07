# A complete upvote and downvote solution

This package delivers several solutions. Pick and use all or the one which meets your needs. 



Current version: 0.0.5 (pre-release) 



## Features

Three different values available for storing likes and upvotes


    - `importance` - might be used for observing and prioritizing content with values from range `0` to `10`.

    - `attitude` - might store values `-1`, `0`, `1` for likes and dislikes.

    - `activated` - might store values `-1`, `0`, `1` for likes and dislikes.

    - `favoritetype_id` - Just a scaffold for future development. An item might be stored in favorites under a certain subcategory. `null` would mean the root folder. This feature would require an extra model `Favoritetype`.




## Installation

1. Add this line to your 'composer.json`

`"unrulynatives/attitudes": "0.0.5"`

2. register the service provider in `config/app.php`.

3. Update your `User.php` model with this package's trait.

Add these two functions (this package's trait is still not developed, contributors welcome!)
```
    
    public function importances() {
        return $this->hasMany(\App\Models\Userattitude::class, 'creator_id');
    }
    
    public function attitudes() {
        return $this->hasMany(\App\Models\Userattitude::class, 'creator_id');
    }
        

```

4. Publish migrations, views, controller and other assets from this package into your Laravel app:

`php artisan vendor:publish --provider="Unrulynatives\Attitudes\AttitudesServiceProvider"`

Now run the migrations with command `php artisan migrate`. Verify that the table `userattitudes` was created.

5. Update your models with this package's trait.

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


7. Include the below view files in your `foreach` loop. Note that the looped variable should be changed accordingly. Here I use `$o->`.

```
	$itemkind = 'features'; // features is a name of your model
    @include('userattitudes._userattitudes_attitude_toggle_abstracted', ['itemkind' => $itemkind,'o' => $o, 'attitude' => (($cua = $o->user_approach(Auth::user())) ? $cua->attitude : NULL)])

    @include('userattitudes._userattitudes_importance_toggle_abstracted', ['itemkind' => $itemkind,'o' => $o, 'importance' => (($cua = $o->user_approach(Auth::user())) ? $cua->importance : NULL)])


```
Note: `itemkind` is plural lovercase name of your model. Take a look at the controller function: the `itemkind` name is changed into class name in order to process your request.

Note 2: The models which are attituded should have the morph class defined. The names are stored in the DB table `userattitudes` in column `item_type`.
I myself define the morph class definitions manually, just to be sure that Laravel functions won't use some unusual defaults. 
Do it in `app\Providers\AppServiceProvider.php`. Use the instructions in https://laravel.com/docs/5.3/upgrade.



8. That's it! Now  user choices should be stored in the database table `userattitudes`.

9. Working demo. 

If you installed this package correctly, point your browser to `attitudes-demo`.
- You should be logged in
- you sould have the `app\Models\Feature` model defined and at least one record in your database present. You can just simply use your own model for your test run - it's up to you.

An online demo is available at http://dev.unrulynatives.com/attitudes-demo



## Help and documentation

point your browser to `attitudes-docs` to see instructions. If you cannot see the docs, then you have a problem to solve. Good luck!