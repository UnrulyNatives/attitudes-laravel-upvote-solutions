# What it is

This is a complete upvote and downvote solution for Laravel >= 5.3 application.

Contributors welcome. Any feature suggestions? Submit an issue.

- Allows upvoting & downvoting, 
- records memos (comments) by the voting user in the same table
- Allows migration of data from `rtconner/laravel-likeable`
- allows assigning objects to favorite categories (only one per voted object though)

Current version: 

[![Latest Stable Version](https://poser.pugx.org/unrulynatives/attitudes/v/stable)](https://packagist.org/packages/unrulynatives/attitudes)

[![Total Downloads](https://poser.pugx.org/unrulynatives/attitudes/downloads)](https://packagist.org/packages/unrulynatives/attitudes)


## Features

- This package delivers several solutions working in the same DB table. Pick and use all or the one which meets your needs. Three different values available for storing likes and upvotes.

- `importance` - might be used for observing and prioritizing content with values from range `0` to `10`, or just any.

- `attitude` - might store values `-1`, `0`, `1` for likes and dislikes. The scope of the values can be decided by developer, e. `-2` for hate and `-3` for going Berserk over the object is possible.

- `activated` - might store values `-1`, `0`, `1` for content filtering features.

- `favoritetype_id` - Just a scaffold for future development. An item might be stored in favorites under a certain subcategory. `null` would mean the root folder. This feature would require an extra model `Favoritetype`.

- `user_notes` - allows user to take notes concerning a model (still to do).


## To do

- functions for votes counters
- example views for various cases of voting counters
- example for adding user notes
- splitting the collection used for migrating from rtconner - now it submits to php timeout limits


## Conntributing
 While the package does the job perfectly now, please give me some time to make the code look more professional. Contributors welcome!


## Installation

1. Add this line to your 'composer.json`

`"unrulynatives/attitudes": "^1.0"`

2. register the service provider in `config/app.php`.

    `Unrulynatives\Attitudes\AttitudesServiceProvider::class,`
    

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


$a. (optional)

While the DB in demonstration page will be seeded by controller function, you can also seed the DB here. 

in your `\database\seeds\DatabaseSeeder.php` `run()` function declare this seed file:
`\database\seeds\UnAQuotationsTableSeeder.php` and run `php artisan db:seed`.


UnAQuotationsTableSeeder

5. (unfinished) Update your models with this package's trait.

This package's trait is still under development. For now just paste the below functions to the models for which you wish to enable:

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

Properly working routes necessary for this package to work are locatad within ths package:

```
Route::any('{itemkind}/{id}/set_user_attitude', ['as' => 'attitudes.set_user_attitude', 'uses' => 'AttitudesController@set_user_attitude']);
Route::any('{itemkind}/{id}/set_user_importance', ['as' => 'attitudes.set_user_importance', 'uses' => 'AttitudesController@set_user_importance']);
```

You can put them in your location of choice, but make sure that the new location is parsed first. In case of problems, reverse the order of service providers of this package and `App\Providers\RouteServiceProvider::class,`


7. Attach the js and css files to your template. Mind the file paths if you decide to place them somewhere else than they are published to.

```
<link href="{{URL::to('css/unrulynatives_attitudes.css')}}" rel="stylesheet">

<script type="text/javascript" src="{{URL::to('js/minitool_attitudes.js')}}"></script>
```

8. Include the below view files in your `foreach` loop. Note that the looped variable should be changed accordingly. Here I use `$o->`.

```
    <?php $itemkind = 'quotes'; ?> // features is a name of your model
    @include('userattitudes._userattitudes_attitude_toggle_abstracted', ['itemkind' => $itemkind,'o' => $o, 'attitude' => (($cua = $o->user_approach(Auth::user())) ? $cua->attitude : NULL)])

    @include('userattitudes._userattitudes_importance_toggle_abstracted', ['itemkind' => $itemkind,'o' => $o, 'importance' => (($cua = $o->user_approach(Auth::user())) ? $cua->importance : NULL)])


```
Note: `itemkind` is plural lovercase name of your model. Take a look at the controller function: the `itemkind` name is changed into class name in order to process your request.

9. Define the morph class
The models which are attituded should have the morph class defined. The names are stored in the DB table `userattitudes` in column `item_type`.
I myself define the morph class definitions manually, just to be sure that Laravel functions won't use some unusual defaults. 
Do it in `app\Providers\AppServiceProvider.php`. Use the instructions in https://laravel.com/docs/5.3/upgrade.


For this package to work with predefined example, open the file and inside the 
put the following code:

```
use Illuminate\Database\Eloquent\Relations\Relation;

// ...

    public function boot()
    {

        Relation::morphMap([
            'user' => User::class,
            'quotation' => \App\Models\UnAQuotation::class,
        ]);
    }
```

10. Define a csrf token
Be sure that the head of your page contains the below declaration, otherwise you will meet with unexpected behavior of the script:
`<meta name="csrf-token" content="{{ csrf_token() }}" />`

11. That's it! Now  user choices should be stored in the database table `userattitudes`.

## Working demo. 

If you installed this package correctly, point your browser to `attitudes-demo`.
- You should be logged in
- you sould have the `app\Models\Feature` model defined and at least one record in your database present. You can just simply use your own model for your test run - it's up to you.

An online demo is available at http://dev.unrulynatives.com/attitudes-demo


## Data migration from other packages

Added feature to migrate data from rtconner's package. See url `attitudes-migrate-likeable`



## Help and documentation

point your browser to `attitudes-docs` to see instructions. If you cannot see the docs, then you have a problem to solve. Good luck!
After you use the `publish` command, the file will be located at `resources/views/userattitudes/features/index.blade.php`