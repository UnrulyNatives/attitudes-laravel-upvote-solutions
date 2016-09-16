@extends('unattitudes.layouts.master_bootstrap_scaffold')


@section('content')


        <div class="communique-danger communique-cleared" id="">
            <h4>An example of Attitudes</h4>
            <p>You need to be logged in in order to see the feature work</p>

       @if(Auth::check())
       <a href="{{URL::to('login')}}" class="btn btn-success">logged correctly!</a>
       @else
       not logged
       <a href="{{URL::to('login')}}" class="btn btn-danger">Login</a>
       @endif

        </div>

            <h1>Attitudes Demo:</h1>
            <form class = 'col s3' method = 'get' action = '{{url("quote")}}/create'>
                <button class = 'btn btn-primary' type = 'submit'>Create New Quote</button>
            </form>
        <div class="communique-info communique-cleared" id="">
            <h4>New quotes</h4>
            <p>New quotes are added in the package's controller. </p>

       @if(Auth::check())
       <a href="{{URL::to('login')}}" class="btn btn-success">logged correctly!</a>
       @else
       not logged
       <a href="{{URL::to('login')}}" class="btn btn-danger">Login</a>
       @endif

        </div>


<div class="un_container csch_dark_1 csch_subtle3">
@foreach($object as $q)
                   
           <div class="un_object csch_subtle2 un_flex un_flex_hs">             
                        <td>#{{$q->id}} {{$q->text}}</td>
                        

                        
                        <div class="un_choice">


                        @include('userattitudes._userattitudes_attitude_toggle_abstracted', ['itemkind' => 'quotes','o' => $q, 'attitude' => (($cua = $q->user_approach(Auth::user())) ? $cua->attitude : NULL)])

                        @include('userattitudes._userattitudes_importance_toggle_abstracted', ['itemkind' => 'quotes','o' => $q, 'importance' => (($cua = $q->user_approach(Auth::user())) ? $cua->importance : NULL)])

            
                        </div>
                    </div>
                    @endforeach
                    </div>

@stop        


@push('css')

<link href="{{URL::to('css/unrulynatives_attitudes.css')}}" rel="stylesheet">

@endpush
@push('scripts_in_head')


@endpush
@push('scripts_in_tail')
    
    {!! Html::script('js/laravel-ujs.js') !!}

    <script type="text/javascript" src="{{URL::to('js/minitool_attitudes.js')}}"></script>

@endpush