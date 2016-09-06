<?php $attitude = $attitude === NULL ? NULL : (int)$attitude; ?>
<?php $uid = uniqid(); ?>
    <div class="set_attitude un_flex un_flex_ht" data-remote-radio-change="true" data-method="post" data-url="{{ route('abstracted.set_user_attitude', ['itemkind' => $itemkind, 'id' => $o->id]) }}" data-spinner="true" title="IK: {{$itemkind}} #{{$o->id}}">
    @foreach([-1,0,1] as $value)
    <input id="eabs{{$o->id}}_{{$value}}_{{$uid}}" type="radio" value="{{$value}}" name="eabs{{$o->id}}_{{$uid}}" {{$attitude === $value ? 'checked=checked' : ''}}></input>
    <label for="eabs{{$o->id}}_{{$value}}_{{$uid}}" class="intensity_{{$value}}"></label>
    @endforeach
    </div>


