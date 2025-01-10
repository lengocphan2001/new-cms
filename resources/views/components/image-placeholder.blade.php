@props([
    'width' => '100%', 
    'height' => '100%', 
    'text' => 'Costar',
    'bgColor' => '#ddd', 
    'fontColor' => '#fff', 
    'fontSize' => '56px', 
    'class' => 'image-placeholder',
])
<svg 
    xmlns="http://www.w3.org/2000/svg" 
    width="{{$width}}" 
    height="{{$height}}"
    class="{{$class}}"
>
    <rect x="0" y="0" width="{{$width}}" height="{{$height}}" fill="{{$bgColor}}"/>
    <text 
        x="50%" 
        y="50%" 
        style="{{'dominant-baseline:middle;text-anchor:middle;font-size:'.$fontSize}}" 
        fill="{{$fontColor}}"
    >
        {{$text}}
    </text>
</svg>