<?php 

namespace UnrulyNatives\Attitudes;
 
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Feature;
use App\Models\Quote;
use App\Models\Userattitude;
use DB;
use Input;
 
class AttitudesController extends Controller
{
 
    // public function index($timezone)
    // {
    //     echo Carbon::now($timezone)->toDateTimeString();
    // }
 

    public function index($timezone = NULL)
    {
        $current_time = ($timezone)
            ? Carbon::now(str_replace('-', '/', $timezone))
            : Carbon::now();
        return view('attitudes::time', compact('current_time'));
    }


    public function docs()
    {

        return view('attitudes::docs', compact('current_time'));
    }


    public function demo($timezone = NULL)
    {
        $current_time = ($timezone)
            ? Carbon::now(str_replace('-', '/', $timezone))
            : Carbon::now();

        $features = Feature::all();


        // this will make sure that you have at least one record in DB for test run.
        if(Feature::count() < 10){
            Feature::insert([
                'name' => 'Yet another random feature. Random integer: '.rand(100,200).'.',
                'description' => 'A random description of feature. Random integer: '.rand(100,200).'.',

            ]);            
        }

        // // Filling the table without seeding 
        // this will make sure that you have data for test run.
        // if(Quote::count() < 10){
        //     Quote::insert([
        //         'text' => 'I never learned from a man who agreed with me. Random integer: '.rand(100,200).'.',
        //         'author' => 'Robert A. Heinlein',

        //     ]);            
        // }

        $object = Quote::get();

        return view('userattitudes.feature.index', compact('current_time','features','object'))->with('itemkind', 'features');
    }




    public function migrate_likeables($perform = NULL)
    {
       $source = DB::table('likeable_likes')->get();
       $target = Userattitude::count();



       // executing the migration if the 
       $perform = Input::get('perform');
       $marker = Input::get('marker');
       if(isset($perform) && $perform = 1) {

            foreach($source as $o) {

                // prevent overwriting your existing entries
                $object = Userattitude::where('creator_id', $o->user_id)->where('item_id',$o->likeable_id)->where('item_type',$o->likeable_type)->first();
                if(!$object) {
                    $object = new Userattitude;
                    $object->attitude = 1;
                    $object->creator_id = $o->user_id;
                    $object->created_at = $o->created_at;
                    $object->updated_at = $o->updated_at;
                    $object->item_id = $o->likeable_id;
                    $object->item_type = $o->likeable_type;

                    if(isset($marker) && $marker = 1) {
                        $object->user_notes = 'migrated OK';
                    }
                    $object->save();


                } else {
                    $overwrite_warning = 1;
                }

                    // migrate data from counters table
                    // in this place the counters will migrate even if the likeables are overwritten
                    $counters = DB::table('likeable_like_counters')->get();
                    foreach($counters as $c) {
                        $counter = DB::table('userattitudes_counters')->where('item_id',$c->likeable_id)->where('item_type',$c->likeable_type)->first();
                        if(!$counter) {
                            DB::table('userattitudes_counters')->insert(['item_id' => $c->likeable_id, 'item_type' => $c->likeable_type, 'count' => $c->count]);

                        } else {

                            $present_count = $counter->count;
                            $migrated_count = $c->count;
                            $sum_of_counts = $present_count + $migrated_count;
                            DB::table('userattitudes_counters')->insert(['item_id' => $c->likeable_id, 'item_type' => $c->likeable_type, 'count' => $sum_of_counts]);

                            unset($sum_of_counts); // just in case
                        }
                    
                    } 


           }
        }



       $affected = Userattitude::where('user_notes', 'migrated OK')->count();


        return view('userattitudes.migrate_likeables', compact('source','target','affected','overwrite_warning'))->with('itemkind', 'features');
    }




    public function set_user_attitude($itemkind, $id) {
        // $id = (int)$id;
        $value = (int)Input::get('value');

        // $itemtype = (int)Input::get('itemtype');
        // $itemtype = (int)$itemtype;

        if (!Auth::check()) return App::abort(403);

        //getting Class name
        $itemtype = str_singular($itemkind);
        $class_name = ucfirst($itemtype);
        $name = "App\\Models\\" . $class_name;
        $class = new $name;
        if (class_exists($name) && get_parent_class($class) == 'Illuminate\Database\Eloquent\Model') {
            $model = $class->find($id);
        }


        $object = $model->attitudes()->where('creator_id', Auth::id())->first();
        if (!$object) {
            $object = new Userattitude;
            $object->creator_id = Auth::id();
            $object->item_type = $itemtype;
            $object->item_id = $id;
            $object->importance = '1';
            $object->attitude = $value;
        }
        $object->attitude = $value;
        $object->save();



        //        return Response::json(['status' => true]);
        return Response::json();
    }




    public function set_user_importance($itemkind, $id) {
        // $id = (int)$id;

        $value = (int)Input::get('value');

        // $itemtype = Input::get('itemtype');

        if (!Auth::check()) return App::abort(403);

        //getting Class name
        $itemtype = str_singular($itemkind);
        $class_name = ucfirst($itemtype);
        $name = "App\\Models\\" . $class_name;
        $class = new $name;
        if (class_exists($name) && get_parent_class($class) == 'Illuminate\Database\Eloquent\Model') {
            $model = $class->find($id);
        }

        // $user_id = Auth::id()->id;
        $object = $model->importances()->where('creator_id', Auth::id())->first();
        if (!$object) {
            $object = new Userattitude;
            $object->creator_id = Auth::id();
            $object->item_type = $itemtype;
            $object->item_id = $id;
        }
        $object->importance = $value;

        $object->save();

        // return Response::json(['status' => true]);
        return Response::json();
    }





}