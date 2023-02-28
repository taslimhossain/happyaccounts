<x-admin-layout>
    <x-slot:page_title>
            {{ __('Add New Staff') }}
    </x-slot>
    <x-slot:pages_links>
      @include('staff.links')
    </x-slot>

    <div class="py-6 animate-bottom">
        <div class="mx-auto">
          <form method="POST" action="{{ route('staff.store') }}" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            @csrf
              <div class="grid grid-cols-12 gap-3 md:gap-5 xl:gap-6 lg:gap-6 mb-6">
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="themehappy" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="start_date" :value="__('Joining Date')" />
                    <x-text-input id="start_date" class="block mt-1 w-full" type="text" name="start_date" placeholder="dd/mm/yyyy" :value="old('start_date')" required autofocus />
                    <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="end_date" :value="__('End date')" />
                    <x-text-input id="end_date" class="block mt-1 w-full" type="text" name="end_date" placeholder="dd/mm/yyyy" :value="old('end_date')" autofocus />
                    <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                </div>
              </div>

              <div class="grid grid-cols-12 gap-3 md:gap-5 xl:gap-6 lg:gap-6 mb-6">
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="phone" :value="__('Phone')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" placeholder="01670000000" :value="old('phone')" required autofocus />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" placeholder="info@themehappy.com" :value="old('email')" autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="sallery_amount" :value="__('Sallery amount')" />
                    <x-text-input id="sallery_amount" class="block mt-1 w-full" type="text" name="sallery_amount" placeholder="50000" :value="old('sallery_amount')" required autofocus />
                    <x-input-error :messages="$errors->get('sallery_amount')" class="mt-2" />
                </div>
              </div>
              <div class="grid grid-cols-12 gap-3 md:gap-5 xl:gap-6 lg:gap-6 mb-6">
                <div class="col-span-12 sm:col-span-8">
                    <x-input-label for="address" :value="__('Address')" />
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" placeholder="Themehappy office, Chittagong" :value="old('address')" required autofocus />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="status" :value="__('Status')" />
                    <x-select-input name="status">
                      @foreach(\App\Helpers\Constant::getRowStatus() as $value => $label)
                      <option value="{{ $value }}" {{ old('status') != $value ?: 'selected' }}>{{ $label }}</option>
                      @endforeach
                    </x-select-input>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>
              </div>
              <div class="grid grid-cols-12 gap-3 md:gap-5 xl:gap-6 lg:gap-6 mb-6">
                <div class="col-span-12 sm:col-span-12">
                  <x-input-label for="description" :value="__('Note')" />
                  <x-textarea-input name="description" rows="3" placeholder="Enter some long form content.">
                  {{ old('description') }}
                  </x-textarea-input>
                </div>
              </div>

              <x-happy-button type="submit" class="">
                {{ __('Save now') }}
              </x-happy-button>              
            
          </form>
        </div>
    </div>
</x-admin-layout>