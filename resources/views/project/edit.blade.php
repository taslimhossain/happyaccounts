<x-admin-layout>
  <x-slot:page_title>
          {{ __('Update Project') }}
  </x-slot>
  <x-slot:pages_links>
    @include('project.links')
  </x-slot>
  <div class="py-6 animate-bottom">
      <div class="mx-auto">
        <form method="POST" action="{{ route('project.update', $project) }}" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
          @csrf
          @method('PATCH')
            <div class="grid grid-cols-12 gap-3 md:gap-5 xl:gap-6 lg:gap-6 mb-6">
              <div class="col-span-12 sm:col-span-4">
                  <x-input-label for="project_title" :value="__('Project title')" />
                  <x-text-input id="project_title" class="block mt-1 w-full" type="text" name="project_title" placeholder="themehappy project" :value="old('project_title', $project->project_title)" required autofocus />
                  <x-input-error :messages="$errors->get('project_title')" class="mt-2" />
              </div>
              <div class="col-span-12 sm:col-span-4">
                  <x-input-label for="start_date" :value="__('Start date')" />
                  <x-text-input id="start_date" class="happydate block mt-1 w-full" type="text" name="start_date" placeholder="dd/mm/yyyy" :value="old('start_date', $project->start_date)" required autofocus />
                  <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
              </div>
              <div class="col-span-12 sm:col-span-4">
                  <x-input-label for="end_date" :value="__('End date')" />
                  <x-text-input id="end_date" class="happydate block mt-1 w-full" type="text" name="end_date" placeholder="dd/mm/yyyy" :value="old('end_date', $project->end_date)" required autofocus />
                  <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
              </div>
            </div>

            <div class="grid grid-cols-12 gap-3 md:gap-5 xl:gap-6 lg:gap-6 mb-6">

              <div class="col-span-12 sm:col-span-4">
                  <x-input-label for="client" :value="__('Client')" />

                  <x-select-input name="client" class="happyselect" required>
                    <option>Select client</option>
                    @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client', $project->client) != $client->id ?: 'selected' }}>{{ $client->client_name }}</option>
                    @endforeach
                  </x-select-input>
                  <x-input-error :messages="$errors->get('client')" class="mt-2" />
              </div>

              <div class="col-span-12 sm:col-span-4">
                  <x-input-label for="project_price" :value="__('Project price')" />
                  <x-text-input id="project_price" class="block mt-1 w-full" type="text" name="project_price" placeholder="100" :value="old('project_price', $project->project_price)" required autofocus />
                  <x-input-error :messages="$errors->get('project_price')" class="mt-2" />
              </div>

              <div class="col-span-12 sm:col-span-4">
                  <x-input-label for="status" :value="__('Status')" />
                  <x-select-input name="status">
                    @foreach(\App\Helpers\Constant::getProjectStatus() as $value => $label)
                    <option value="{{ $value }}" {{ old('status', $project->status) != $value ?: 'selected' }}>{{ $label }}</option>
                    @endforeach
                  </x-select-input>
                  <x-input-error :messages="$errors->get('status')" class="mt-2" />
              </div>
            </div>
            <div class="grid grid-cols-12 gap-3 md:gap-5 xl:gap-6 lg:gap-6 mb-6">
              <div class="col-span-12 sm:col-span-12">
                <x-input-label for="status" :value="__('Description')" />
                <x-textarea-input name="description" rows="3" placeholder="Enter some long form content.">
                {{ old('description', $project->description) }}
                </x-textarea-input>
              </div>
            </div>

            <x-happy-button type="submit" class="">
              {{ __('Update now') }}
            </x-happy-button>              
          
        </form>
      </div>
  </div>
</x-admin-layout>