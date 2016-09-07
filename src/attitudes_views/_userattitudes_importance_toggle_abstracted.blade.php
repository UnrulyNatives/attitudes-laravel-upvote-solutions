<?php $importance = $importance === NULL ? NULL : (int)$importance; ?>
<?php $uid = uniqid(); ?>
<div class="set_intensity un_flex un_flex_ht" data-remote-radio-change="true" data-method="post" data-url="{{ route('attitudes.set_user_importance', ['itemkind' => $itemkind,'id' => $o->id]) }}" data-spinner="true"  title="IK: {{$itemkind}} #{{$o->id}}">

    @foreach([0,1,2,3] as $value)
        <input id="absq{{$o->id}}_{{$value}}_{{$uid}}" type="radio" value="{{$value}}" name="absq{{$o->id}}_{{$uid}}" {{$importance === $value ? 'checked=checked' : ''}}></input>
        <label for="absq{{$o->id}}_{{$value}}_{{$uid}}" class="intensity_{{$value}}">{{ $value }}</label>
    @endforeach

</div>