<div class="inputArea">
    <label for="title"> {{$label ?? ''}} </label>
    <select id="{{$name}}" name="{{$name}}" {{empty($required) ? '' : 'required'}}>
        <option value="" selected disabled> Selecione a categoria </option>
        {{$slot}}
    </select>
</div>
