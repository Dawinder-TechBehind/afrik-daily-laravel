<select 
    name="{{ $name }}" 
    id="{{ $id }}" 
    class="form-control searchable-dropdown select2 @error($name) is-invalid @enderror" 
    style="width: 100%;"
    @if($required) required @endif
>
    <option value="">{{ $placeholder }}</option>
    @foreach($options as $val => $label)
        @if(is_object($label))
            <option value="{{ $label->id }}" {{ $selected == $label->id ? 'selected' : '' }}>
                {{ $label->name }}
            </option>
        @else
            <option value="{{ $val }}" {{ $selected == $val ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endif
    @endforeach
</select>