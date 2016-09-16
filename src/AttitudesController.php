<?php 

namespace UnrulyNatives\Attitudes;
 
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Feature;
use App\Models\Quote;
 
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


        // As I cannot make seeding work (see http://stackoverflow.com/questions/39521913/laravel-5-3-dbseed-command-simply-doesnt-work) this will make sure that you have data for test run.
        if(Feature::count() < 10){
            Feature::insert([
                'name' => 'Feature. Random integer: '.rand(100,200).'.',
                'description' => 'A random description of feature. Random integer: '.rand(100,200).'.',

            ]);            
        }

        // As I cannot make seeding work (see http://stackoverflow.com/questions/39521913/laravel-5-3-dbseed-command-simply-doesnt-work) this will make sure that you have data for test run.
        if(Quote::count() < 10){
            Quote::insert([
                'text' => 'I never learned from a man who agreed with me. Random integer: '.rand(100,200).'.',
                'author' => 'Robert A. Heinlein',

            ]);            
        }

        $object = Quote::get();

        return view('userattitudes.feature.index', compact('current_time','features','object'))->with('itemkind', 'features');
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