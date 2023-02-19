@props(['active', 'href' => '', 'id' => ''])

@php
$classes = ($active ?? false) ? 'inline-flex items-center w-full text-sm font-semibold text-indigo-600 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100 active' : 'inline-flex items-center w-full text-sm font-medium transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200';

$btn_classes = ($active ?? false) ? 'inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 text-indigo-600 hover:text-indigo-600 dark:hover:text-gray-200 active' : 'inline-flex items-center justify-between w-full text-sm font-medium transition-colors duration-150 text-gray-600 hover:text-indigo-600 dark:hover:text-gray-200';

$toggle = ($id ?? true) ? $id : '';
@endphp

@if($active) <span class="absolute inset-y-0 left-0 w-1 bg-indigo-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span> @endif

@if($href)
<a href="{{$href}}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $icon ?? '' }}
    <span class="ml-4">{{ $slot }}</span>
</a>
@else
<button {{ $attributes->merge(['class' => $btn_classes]) }} class="" @click="toogleMenu('{{$toggle}}')" aria-haspopup="true" >
    <span class="inline-flex items-center">
        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" > <path d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" ></path> </svg>
        <span class="ml-4">{{ $slot }}</span>
    </span>
    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" >
      <path fill-rule="evenodd"  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" ></path> </svg>
    </button>
@endif
