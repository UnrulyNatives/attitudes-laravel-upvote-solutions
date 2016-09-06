<div class="un_choices csch_dark2">
    <h3>
    {{config('unruly_attitudes.relateds_attitude')}}
   {{ trans('buttons.approve_or_disapprove') }}
    </h3>

            @include('abstracted._userattitudes_attitude_toggle_abstracted', ['itemkind' => $itemkind,'o' => $o, 'attitude' => (($cua = $o->user_approach(Auth::user())) ? $cua->attitude : NULL)])

    <h3>
    	{{config('unruly_attitudes.relateds_importance')}}
    	{{ trans('buttons.set_importance') }}
    </h3>
            @include('abstracted._userattitudes_importance_toggle_abstracted', ['itemkind' => $itemkind,'o' => $o, 'importance' => (($cua = $o->user_approach(Auth::user())) ? $cua->importance : NULL)])

</div> <!-- un_choices -->