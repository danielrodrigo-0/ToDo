{{-- {{dd(($onclick . 1))}} --}}
<div class="inputArea">
    <label for="{{$name}}"> {{$label ?? ''}} </label>
    <input type="{{empty($type) ? 'text' : $type}}"
    id="{{$name}}" name="{{$name}}"
    placeholder="{{$placeholder ?? ''}}"
     {{empty($required) ? '': 'required'}}
     value="{{$value ?? ''}}"
     {{((!empty($type)) && $type == 'dateTime-local') ? $onfocus : ''}}
     />
</div>
