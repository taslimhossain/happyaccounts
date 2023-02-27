@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block w-full mt-1 text-sm dark:text-gray-300 border-gray-300 dark:border-gray-700 dark:bg-gray-900 form-textarea focus:border-indigo-500 focus:outline-none focus:shadow-outline-indigo dark:focus:shadow-outline-gray rounded-md']) !!}> {{$slot}} </textarea>