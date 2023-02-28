<x-admin-layout>
    <x-slot:page_title>
      <span class="text-gray-500"> Vendor Details: </span> {{ __( $vendor->name) }} 
    </x-slot>
    <x-slot:pages_links>
      @include('vendor.links')
    </x-slot>

    <div class="py-6 animate-bottom">
        <div class="mx-auto">
          <div class="text-sm px-4 py-3 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <h4 class="font-semibold text-gray-700 text-lg underline mb-4 dark:text-white">Basic information:</h4>
              <div class="grid grid-cols-3 gap-3 md:gap-5 xl:gap-6 lg:gap-6">
                <div class="flex flex-col">
                  <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Vendor Name </h4>
                  <p class="text-gray-600 dark:text-gray-400">{{ $vendor->name }}</p>
                </div>
                <div class="flex flex-col">
                  <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Phone </h4>
                  <p class="text-gray-600 dark:text-gray-400">{{ $vendor->phone }}</p>
                </div>
                <div class="flex flex-col">
                  <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Phone 2</h4>
                  <p class="text-gray-600 dark:text-gray-400">{{ $vendor->phone_2 }}</p>
                </div>
                <div class="flex flex-col">
                  <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Email</h4>
                  <p class="text-gray-600 dark:text-gray-400">{{ $vendor->email }}</p>
                </div>
                <div class="flex flex-col col-span-2">
                  <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Address </h4>
                  <p class="text-gray-600 dark:text-gray-400">{{ $vendor->address }}</p>
                </div>
              </div>
              <h4 class="font-semibold text-gray-700 text-lg underline mb-4 mt-8 dark:text-white">Billing information:</h4>
              <div class="grid grid-cols-3 gap-3 md:gap-5 xl:gap-6 lg:gap-6">
                <div class="flex flex-col">
                  <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Billing name </h4>
                  <p class="text-gray-600 dark:text-gray-400">{{ $vendor->billing_name }}</p>
                </div>
                <div class="flex flex-col">
                  <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Billing phone </h4>
                  <p class="text-gray-600 dark:text-gray-400">{{ $vendor->phone }}</p>
                </div>
                <div class="flex flex-col col-span-2">
                  <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Address </h4>
                  <p class="text-gray-600 dark:text-gray-400">{{ $vendor->address }}</p>
                </div>
                <div class="flex flex-col col-span-3">
                  <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Description </h4>
                  <p class="text-gray-600 dark:text-gray-400">{{ $vendor->description }}</p>
                </div>
                <div class="flex flex-col">
                  <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Account status </h4>
                  <p class="text-gray-600 dark:text-gray-400">{{ \App\Helpers\Constant::getRowStatus()[$vendor->status] }}</p>
                </div>
              </div>
          </div>

        </div>
    </div>
</x-admin-layout>