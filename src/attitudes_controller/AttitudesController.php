<?php
namespace App\Http\Controllers;

use DB;
use Session;
use Redirect;

use View;
use HTML;
use Auth;
use Input;
use Image;
use Response;
use Theme;
use Cookie;
use Illuminate\Cookie\CookieJar;


use App\Models\Userattitude;


class AttitudesController extends Controller
{

    public function __construct() {
        // $this->middleware('moderators', ['only' => array('refine_relations') ]);
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
        }
        $object->attitude = $value;
        $object->save();

        if($itemtype == 'exemplar') {
            // saving new exemplar as active
            Session::put('active_exemplar', $model);
            Cookie::queue(Cookie::forever('active_exemplar', $model));

            if (Auth::check()) {
                $ae = UserWorkspace::where('user_id', '=', Auth::id())->first();
                $ae->active_exemplar = $id;
                $ae->save();
            }

        }

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
         // tu 'importance' to komórka tabeli
        $object->save();

        //        return Response::json(['status' => true]);
        return Response::json();
    }






    public function collect($itemkind, $importance, $attitude, $param1, $param2, $param3, $maxcount=null, $sorting='created_at') {

        if($maxcount == '' || $maxcount == 'all') {
            $maxcount = 1000;
        }
        if($itemkind == 'questions') {
            $object = Question::
                // limit($param2)->
                paginate($maxcount);

        } else {
            $object = Entitystandpoint::where('question_id',93)->get();
            // $question = Question::find($maxcount);

        }


        // return "DEV Resp in Controller Widzisz ". $object->count() . " obiektów typu ".$itemkind.". Importance: ". $importance . "; attitude: ". $attitude . "; par 1: " . $param1 .  "-; par 2: " . $param2 .  "- par 3: " . $param3 . "- maxcount: " . $maxcount . " Sorting: " . $sorting;



        return View::make('abstracted._collection_judgable', compact('object', 'itemkind','importance','attitude','param1','param2','param3','maxcount','sorting'));
    }







}
