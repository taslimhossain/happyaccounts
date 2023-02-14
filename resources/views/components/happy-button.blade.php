@props(['href' => '', 'px' => 4, 'py' => 2, 'bgColor' => 'indigo', 'textColor' => 'white', 'iconPosition' => 'left', 'width' => '48'])

@php
$icon = isset($icon) ? $icon : '';
$leftIcon = $iconPosition === 'left' ? $icon : '';
$rightIcon = $iconPosition === 'right' ? $icon : '';
@endphp


@if($href)
    <a {{ $attributes->merge(['href' => $href, 'class' => 'inline-flex items-center justify-between px-'.$px.' py-'.$py.' text-sm font-medium leading-5 text-'.$textColor.' transition-colors duration-150 bg-'.$bgColor.'-600 border border-transparent rounded-lg active:bg-'.$bgColor.'-600 focus:outline-none hover:opacity-75 focus:shadow-outline-'.$bgColor]) }}>
        {{ $leftIcon }}
        <span>{{ $slot }}</span>
        {{ $rightIcon }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-between px-'.$px.' py-'.$py.' text-sm font-medium leading-5 text-'.$textColor.' transition-colors duration-150 bg-'.$bgColor.'-600 border border-transparent rounded-lg active:bg-'.$bgColor.'-600 hover:opacity-75 focus:outline-none focus:shadow-outline-'.$bgColor]) }}>
        {{ $leftIcon }}
        <span>{{ $slot }}</span>
        {{ $rightIcon }}
    </button>
@endif
