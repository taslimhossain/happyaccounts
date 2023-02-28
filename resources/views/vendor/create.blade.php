<x-admin-layout>
    <x-slot:page_title>
            {{ __('Add New Vendor') }}
    </x-slot>
    <x-slot:pages_links>
      @include('vendor.links')
    </x-slot>

    <div class="py-6 animate-bottom">
        <div class="mx-auto">
          <form method="POST" action="{{ route('vendor.store') }}" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            @csrf
              <h4 class="font-semibold text-gray-700 text-xl underline mb-4 dark:text-white">Basic information:</h4>
              <div class="grid grid-cols-12 gap-3 md:gap-5 xl:gap-6 lg:gap-6 mb-6">
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="name" :value="__('Vendor name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="themehappy" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="phone" :value="__('Phone')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" placeholder="01670504029" :value="old('phone')" required autofocus />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
                <div class="col-span-12 sm:col-span-4">
                  <x-input-label for="phone_2" :value="__('Phone 2')" />
                  <x-text-input id="phone_2" class="block mt-1 w-full" type="text" name="phone_2" placeholder="01676966260" :value="old('phone_2')" autofocus />
                  <x-input-error :messages="$errors->get('phone_2')" class="mt-2" />
              </div>
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" placeholder="contact@themehappy.com" :value="old('email')" autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="col-span-12 sm:col-span-8">
                  <x-input-label for="address" :value="__('Address')" />
                  <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" placeholder="Theme happy, chittagong" :value="old('address')" required autofocus />
                  <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

              </div>

              <h4 class="font-semibold text-gray-700 text-xl underline mb-4 dark:text-white">Billing information:</h4>
              <div class="grid grid-cols-12 gap-3 md:gap-5 xl:gap-6 lg:gap-6 mb-6">
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="billing_name" :value="__('Billing name')" />
                    <x-text-input id="client" class="block mt-1 w-full" type="text" name="billing_name" placeholder="Theme Happy" :value="old('billing_name')" required autofocus />
                    <x-input-error :messages="$errors->get('billing_name')" class="mt-2" />
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="billing_phone" :value="__('Billing phone')" />
                    <x-text-input id="billing_phone" class="block mt-1 w-full" type="text" name="billing_phone" placeholder="01676966260" :value="old('billing_phone')" required autofocus />
                    <x-input-error :messages="$errors->get('billing_phone')" class="mt-2" />
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="billing_address" :value="__('Billing address')" />
                    <x-text-input id="billing_address" class="block mt-1 w-full" type="text" name="billing_address" placeholder="Theme happy, chittagong" :value="old('billing_address')" required autofocus />
                    <x-input-error :messages="$errors->get('billing_address')" class="mt-2" />
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
                  <x-input-label for="status" :value="__('Description')" />
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