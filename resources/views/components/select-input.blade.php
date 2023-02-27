@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm block mt-1 w-full text-sm dark:text-gray-300 border-gray-300 dark:border-gray-300 dark:bg-gray-700 form-select focus:border-indigo-400 focus:outline-none focus:shadow-outline-indigo dark:focus:shadow-outline-gray']) !!}>
    {{ $slot }}
  </select>