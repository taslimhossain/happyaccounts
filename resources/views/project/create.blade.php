<x-admin-layout>
    <x-slot:page_title>
            {{ __('Add New Project') }}
    </x-slot>
    <x-slot:pages_links>
      @include('project.links')
    </x-slot>

    <div class="py-6 animate-bottom">
        <div class="mx-auto">
          <form method="POST" action="{{ route('banking.store') }}" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            @csrf
              <div class="grid grid-cols-12 gap-3 md:gap-5 xl:gap-6 lg:gap-6 mb-6">
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="project_title" :value="__('Project title')" />
                    <x-text-input id="project_title" class="block mt-1 w-full" type="text" name="project_title" placeholder="themehappy project" :value="old('project_title')" required autofocus />
                    <x-input-error :messages="$errors->get('project_title')" class="mt-2" />
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="start_date" :value="__('Start date')" />
                    <x-text-input id="start_date" class="block mt-1 w-full" type="text" name="start_date" placeholder="dd/mm/yyyy" :value="old('start_date')" required autofocus />
                    <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="end_date" :value="__('End date')" />
                    <x-text-input id="end_date" class="block mt-1 w-full" type="text" name="end_date" placeholder="dd/mm/yyyy" :value="old('end_date')" required autofocus />
                    <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                </div>
              </div>

              <div class="grid grid-cols-12 gap-3 md:gap-5 xl:gap-6 lg:gap-6 mb-6">
  
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="account_number" :value="__('Account No')" />
                    <x-text-input id="account_number" class="block mt-1 w-full" type="text" name="account_number" placeholder="001122334455667788" :value="old('account_number')" required autofocus />
                    <x-input-error :messages="$errors->get('account_number')" class="mt-2" />
                </div>

                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="project_price" :value="__('Project price')" />
                    <x-text-input id="project_price" class="block mt-1 w-full" type="text" name="project_price" placeholder="100" :value="old('project_price')" required autofocus />
                    <x-input-error :messages="$errors->get('project_price')" class="mt-2" />
                </div>

                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="status" :value="__('Status')" />
                    <select name="status" class="rounded-md shadow-sm block mt-1 w-full text-sm dark:text-gray-300 border-gray-300 dark:border-gray-300 dark:bg-gray-700 form-select focus:border-indigo-400 focus:outline-none focus:shadow-outline-indigo dark:focus:shadow-outline-gray">
                      <option value="canceled">Canceled</option>
                      <option value="finished">Finished</option>
                      <option value="in_progress">In Progress</option>
                      <option value="not_started">Not Started</option>
                    </select>

                </div>
              </div>

              <x-happy-button type="submit" class="">
                {{ __('Save now') }}
              </x-happy-button>              
            
          </form>
        </div>
    </div>
</x-admin-layout>