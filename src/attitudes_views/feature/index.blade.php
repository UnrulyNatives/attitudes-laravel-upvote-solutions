@extends('unstarter.layouts.master_bootstrap_scaffold')


@section('content')


        <div class="communique-danger communique-cleared" id="">
            <h4>An example of Attitudes</h4>
            <p>You need to be logged in in order to see the feature work</p>

       @if(Auth::check())
       logged correctly!
       @else
       not logged
       @endif

        </div>

            <h1>Feature Index:</h1>
            <form class = 'col s3' method = 'get' action = '{{url("feature")}}/create'>
                <button class = 'btn btn-primary' type = 'submit'>Create New Feature</button>
            </form>
            <br>
            
            <br>
            <table class = "table table-striped table-bordered">
                <thead>
                    
                    <th>name</th>
                    
                    <th>description</th>
                    
                    <th>demonstration_URL</th>
                    
                    
                    <th>actions</th>
                    <th>Attitudes package</th>
                </thead>
                <tbody>
                    @foreach($features as $o)
                    <tr>
                        
                        <td>{{$o->name}}</td>
                        
                        <td>{{$o->description}}</td>
                        
                        <td>{{$o->demonstration_URL}}

                            @includeif('starter.features.'.$o->id)

                        </td>
                        
                        
                        <td>
                                <a data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/feature/{{$o->id}}/deleteMsg" ><i class = 'material-icons'>delete</i></a>
                                <a href = '#' class = 'viewEdit btn btn-primary btn-xs' data-link = '/feature/{{$o->id}}/edit'><i class = 'material-icons'>edit</i></a>
                                <a href = '#' class = 'viewShow btn btn-warning btn-xs' data-link = '/feature/{{$o->id}}'><i class = 'material-icons'>info</i></a>
                        </td>
                        
                        <td>


                        @include('userattitudes._userattitudes_attitude_toggle_abstracted', ['itemkind' => $itemkind,'o' => $o, 'attitude' => (($cua = $o->user_approach(Auth::user())) ? $cua->attitude : NULL)])

                        @include('userattitudes._userattitudes_importance_toggle_abstracted', ['itemkind' => $itemkind,'o' => $o, 'importance' => (($cua = $o->user_approach(Auth::user())) ? $cua->importance : NULL)])

            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


@stop        


@push('css')

<link href="{{URL::to('css/unrulynatives_attitudes.css')}}" rel="stylesheet">

@endpush
@push('scripts_in_head')


@endpush
@push('scripts_in_tail')

<script type="text/javascript" src="{{URL::to('js/minitool_attitudes.js')}}"></script>

@endpush