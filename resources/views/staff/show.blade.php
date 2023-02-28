<x-admin-layout>
    <x-slot:page_title>
      <span class="text-gray-500"> Project Details: </span> {{ __( $project->project_title) }} 
    </x-slot>
    <x-slot:pages_links>
      @include('project.links')
    </x-slot>

    <div class="py-6 animate-bottom">
        <div class="mx-auto">
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
                <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Client</h4>
                <p class="text-gray-600 dark:text-gray-400">{{ $project->client }}</p>
              </div>
              <div class="flex flex-col">
                <h4 class="font-semibold text-gray-600 dark:text-gray-300"> Project Price </h4>
                <p class="text-gray-600 dark:text-gray-400">{{ $project->project_price }}</p>
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