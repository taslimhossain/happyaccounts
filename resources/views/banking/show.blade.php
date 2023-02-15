<x-admin-layout>
    <x-slot:page_title>
      <span class="text-gray-500"> Account Details: </span> {{ __( $banking->account_name) }} 
    </x-slot>
    <x-slot:pages_links>
      @include('banking.links')
    </x-slot>

    <div class="py-6">
        <div class="mx-auto">
          <div class="text-sm grid grid-cols-3 gap-3 md:gap-5 xl:gap-6 lg:gap-6 px-4 py-3 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <div class="flex flex-col">
                <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Bank Name </h4>
                <p class="text-gray-600 dark:text-gray-400">{{ $banking->bank_name }}</p>
              </div>
              <div class="flex flex-col">
                <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Branch </h4>
                <p class="text-gray-600 dark:text-gray-400">{{ $banking->branch }}</p>
              </div>
              <div class="flex flex-col">
                <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Account Name</h4>
                <p class="text-gray-600 dark:text-gray-400">{{ $banking->account_name }}</p>
              </div>
              <div class="flex flex-col">
                <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Account No</h4>
                <p class="text-gray-600 dark:text-gray-400">{{ $banking->account_number }}</p>
              </div>
              <div class="flex flex-col">
                <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Initial Balance </h4>
                <p class="text-gray-600 dark:text-gray-400">{{ $banking->initial_balance }}</p>
              </div>
              <div class="flex flex-col">
                <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Current Balance </h4>
                <p class="text-gray-600 dark:text-gray-400">{{ $banking->initial_balance }}</p>
              </div>
          </div>

        </div>
    </div>
</x-admin-layout>