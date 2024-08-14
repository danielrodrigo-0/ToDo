{{-- {{dd(($onclick . 1))}} --}}
<div class="inputArea">
    <label for="{{$name}}"> {{$label ?? ''}} </label>
    <input type="checkbox"
    id="{{$name}}" name="{{$name}}"
     {{empty($required) ? '': 'required'}}
     {{$checked ? 'checked' : ''}}
     />
</div>
