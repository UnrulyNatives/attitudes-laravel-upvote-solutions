
        @include('userattitudes._userattitudes_attitude_toggle_abstracted2', ['css_attitude_style' => 'un_attitude_icons2 btn-group btn-group-sm','itemkind' => $itemkind,'o' => $o, 'attitude' => (($cua = $o->user_approach(Auth::user())) ? $cua->attitude : NULL)])

	


        @include('userattitudes._userattitudes_importance_toggle_abstracted2', ['css_importance_style' => 'btn-group btn-group-sm','itemkind' => $itemkind,'o' => $o, 'importance' => (($cua = $o->user_approach(Auth::user())) ? $cua->importance : NULL)])
