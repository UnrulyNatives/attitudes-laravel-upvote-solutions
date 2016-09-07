<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Edit Feature</title>
    </head>
    <body>
        <div class = 'container'>
            <h1>Edit Feature</h1>
            <form method = 'get' action = '{{url("feature")}}'>
                <button class = 'btn btn-danger'>Feature Index</button>
            </form>
            <br>
            <form method = 'POST' action = '{{url("feature")}}/{{$feature->id}}/update'>
                <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                
                <div class="form-group">
                    <label for="name">name</label>
                    <input id="name" name = "name" type="text" class="form-control" value="{{$feature->name}}">
                </div>
                
                <div class="form-group">
                    <label for="description">description</label>
                    <input id="description" name = "description" type="text" class="form-control" value="{{$feature->description}}">
                </div>


    {{-- field: package_id --}}
    @include('forms._segment_select', array('purpose' => $task, 'fieldname' => 'package_id', 'fieldlabel' => 'package_id','selectarray' => 'pac','preselected_val' => '', 'icon' => '', 'class' => '' ))
                

                
                <div class="form-group">
                    <label for="demonstration_URL">demonstration_URL</label>
                    <input id="demonstration_URL" name = "demonstration_URL" type="text" class="form-control" value="{{$feature->demonstration_URL}}">
                </div>
                
                
                <button class = 'btn btn-primary' type ='submit'>Update</button>
            </form>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</html>
