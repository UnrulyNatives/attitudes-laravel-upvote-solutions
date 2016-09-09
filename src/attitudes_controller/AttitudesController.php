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
