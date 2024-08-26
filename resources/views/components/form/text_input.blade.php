{{-- {{dd(($onclick . 1))}} --}}
{{-- @dd($onchange) --}}
<div class="{{empty($class) ? 'inputArea' : $class}}">
    @if($name)
        <label for="{{$name}}"> {{$label ?? ''}} </label>
    @endif
    <input
    @if($id)
        id="{{$id}}"
    @endif
    type="{{empty($type) ? 'text' : $type}}"
    id="{{$name}}" name="{{$name}}"
    placeholder="{{$placeholder ?? ''}}"
     {{empty($required) ? '': 'required'}}
     value="{{$value ?? ''}}"
     onchange="{{!empty($onchange) ? $onchange : ''}}"
     onfocus="{{((!empty($type)) && ($type == 'dateTime-local' || $type == 'date')) ? $onfocus : ''}}"
     />
</div>
