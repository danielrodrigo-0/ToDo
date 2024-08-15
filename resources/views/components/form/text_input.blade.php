{{-- {{dd(($onclick . 1))}} --}}
{{-- @dd($onchange) --}}
<div class="inputArea">
    <label for="{{$name}}"> {{$label ?? ''}} </label>
    <input type="{{empty($type) ? 'text' : $type}}"
    id="{{$name}}" name="{{$name}}"
    placeholder="{{$placeholder ?? ''}}"
     {{empty($required) ? '': 'required'}}
     value="{{$value ?? ''}}"
     onchange="{{!empty($onchange) ? $onchange : ''}}"
     onfocus="{{((!empty($type)) && ($type == 'dateTime-local' || $type == 'date')) ? $onfocus : ''}}"
     />
</div>
