<x-admin-layout>
    <x-slot:page_title>
      <span class="text-gray-500"> Staff: </span> {{ __( $staff->name) }} 
    </x-slot>
    <x-slot:pages_links>
      @include('staff.links')
    </x-slot>

    <div class="py-6 animate-bottom">
        <div class="mx-auto">
          <div class="text-sm grid grid-cols-3 gap-3 md:gap-5 xl:gap-6 lg:gap-6 px-4 py-3 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <div class="flex flex-col">
                <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Name </h4>
                <p class="text-gray-600 dark:text-gray-400">{{ $staff->name }}</p>
              </div>
              <div class="flex flex-col">
                <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Start Date </h4>
                <p class="text-gray-600 dark:text-gray-400">{{ $staff->start_date }}</p>
              </div>
              <div class="flex flex-col">
                <h4 class="font-semibold text-gray-600 dark:text-gray-300"> End Date</h4>
                <p class="text-gray-600 dark:text-gray-400">{{ $staff->end_date }}</p>
              </div>
              <div class="flex flex-col">
                <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Phone</h4>
                <p class="text-gray-600 dark:text-gray-400">{{ $staff->phone }}</p>
              </div>
              <div class="flex flex-col">
                <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Email </h4>
                <p class="text-gray-600 dark:text-gray-400">{{ $staff->email }}</p>
              </div>
              <div class="flex flex-col">
                <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Status </h4>
                <p class="text-gray-600 dark:text-gray-400">{{ \App\Helpers\Constant::getProjectStatus()[$staff->status] }}</p>
              </div>
          </div>
          <div class="text-sm px-4 py-3 bg-white rounded-lg shadow-md dark:bg-gray-800 mt-4">
              <div class="flex flex-col">
                <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Staff Note </h4>
                <p class="text-gray-600 dark:text-gray-400">{{ $staff->description }}</p>
              </div>
          </div>
        </div>
    </div>
</x-admin-layout>