<x-admin-layout>
    <x-slot:page_title>
      <span class="text-gray-500"> Project Details: </span> {{ __( $project->project_title) }} 
    </x-slot>
    <x-slot:pages_links>
      @include('project.links')
    </x-slot>

    <div class="py-6 animate-bottom">
        <div class="mx-auto">

          <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
              </div>
              <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Client</p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                  {{ $project?->client_details?->client_name ? $project->client_details->client_name : '- - - -' }}
                </p>
              </div>
            </div>
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5l.415-.207a.75.75 0 011.085.67V10.5m0 0h6m-6 0h-1.5m1.5 0v5.438c0 .354.161.697.473.865a3.751 3.751 0 005.452-2.553c.083-.409-.263-.75-.68-.75h-.745M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>                
              </div>
              <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                  Budget
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                  {{ formatTaka($project->project_price) }}
                </p>
              </div>
            </div>
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5l.415-.207a.75.75 0 011.085.67V10.5m0 0h6m-6 0h-1.5m1.5 0v5.438c0 .354.161.697.473.865a3.751 3.751 0 005.452-2.553c.083-.409-.263-.75-.68-.75h-.745M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg> 
              </div>
              <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                  Expense
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                  {{ formatTaka(56822545) }}
                </p>
              </div>
            </div>
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                </svg>
                
              </div>
              <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                  Days Left
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                  {{ get_days_left($project->end_date) }}
                </p>
              </div>
            </div>
          </div>


          
          <div class="text-sm grid grid-cols-3 gap-3 md:gap-5 xl:gap-6 lg:gap-6 px-4 py-3 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <div class="flex flex-col">
                <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Project Name </h4>
                <p class="text-gray-600 dark:text-gray-400">{{ $project->project_title }}</p>
              </div>
              <div class="flex flex-col">
                <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Start Date </h4>
                <p class="text-gray-600 dark:text-gray-400">{{ $project->start_date }}</p>
              </div>
              <div class="flex flex-col">
                <h4 class="font-semibold text-gray-600 dark:text-gray-300"> End Date</h4>
                <p class="text-gray-600 dark:text-gray-400">{{ $project->end_date }}</p>
              </div>
              <div class="flex flex-col">
                <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Project Status </h4>
                <p class="text-gray-600 dark:text-gray-400">{{ \App\Helpers\Constant::getProjectStatus()[$project->status] }}</p>
              </div>
          </div>
          <div class="text-sm px-4 py-3 bg-white rounded-lg shadow-md dark:bg-gray-800 mt-4">
              <div class="flex flex-col">
                <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Project Description </h4>
                <p class="text-gray-600 dark:text-gray-400">{{ $project->description }}</p>
              </div>
          </div>

        </div>
    </div>
</x-admin-layout>