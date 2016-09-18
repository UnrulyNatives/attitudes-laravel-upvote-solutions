<div>
        @include('userattitudes._userattitudes_attitude_toggle_abstracted', ['css_attitude_style' => 'set_attitude','itemkind' => $itemkind,'o' => $o, 'attitude' => (($cua = $o->user_approach(Auth::user())) ? $cua->attitude : NULL)])
</div>
	

<div>
	
        @include('userattitudes._userattitudes_importance_toggle_abstracted', ['css_importance_style' => 'set_importance','itemkind' => $itemkind,'o' => $o, 'importance' => (($cua = $o->user_approach(Auth::user())) ? $cua->importance : NULL)])
</div>