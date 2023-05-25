@props(['value'])
<label {{$attributes->merge([
    'class' => 'text-md text-slate-700'
    ])}}
>
    {{$value ?? $slot}}
</label>
