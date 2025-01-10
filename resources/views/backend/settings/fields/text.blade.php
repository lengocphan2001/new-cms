@php
$required = (Str::contains($field['rules'], 'required')) ? "required" : "";
$required_mark = ($required != "") ? '<span class="text-danger"> <strong>*</strong> </span>' : '';
@endphp

<div class="form-group mb-3 {{ $errors->has($field['name']) ? ' has-error' : '' }}">
    <label class="form-label" for="{{ $field['name'] }}">
        <strong>{{ __($field['label']) }}</strong> ({{ $field['name'] }}) {!! $required_mark !!}
    </label>
    <div class="form-input">
        <input 
            type="{{ $field['type'] }}"
            name="{{ $field['name'] }}"
            value="{{ old($field['name'], setting($field['name'])) }}"
            class="form-control {{ Arr::get( $field, 'class') }} {{ $errors->has($field['name']) ? ' is-invalid' : '' }}"
            id="{{ $field['name'] }}"
            placeholder="{{ $field['label'] }}" 
            {{ $required }}
        >
    </div>
    @if ($errors->has($field['name'])) <small class="invalid-feedback">{{ $errors->first($field['name']) }}</small> @endif
</div>
