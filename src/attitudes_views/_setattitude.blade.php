<div class="un_choices {{@$choicebox_classes}}">
  <h3>
    @if(isset($header1))
     <h3> {{$header1}}</h3>
    @else
         <h3> Udziel przybliżonej odpowiedzi:</h3>
    @endif
    </h3>
      @unless(!isset($name))
      <div class="">
           {{-- <p>{{$question->question_to_user}}</p> --}}
      </div>
      @endunless


        @include('userattitudes._userattitudes_attitude_toggle_abstracted', ['itemkind' => $itemkind,'o' => $object, 'attitude' => (($cua = $o->user_approach(Auth::user())) ? $cua->attitude : NULL)])

        @include('userattitudes._userattitudes_importance_toggle_abstracted', ['itemkind' => $itemkind,'o' => $object, 'importance' => (($cua = $o->user_approach(Auth::user())) ? $cua->importance : NULL)])

    @if(isset($header3))
      <h4>{{$header3}}</h4>
    @else

    @endif
</div>

