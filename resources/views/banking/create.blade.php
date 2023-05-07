<x-admin-layout>
    <x-slot:page_title>
            {{ __('Add New Bank') }}
    </x-slot>
    <x-slot:pages_links>
      @include('banking.links')
    </x-slot>
    
    <div class="py-6">
        <div class="mx-auto">
          <form method="POST" action="{{ route('banking.store') }}" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            @csrf
              <div class="grid grid-cols-12 gap-3 md:gap-5 xl:gap-6 lg:gap-6 mb-6">
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="bank_name" :value="__('Bank Name *')" />
                    <x-text-input id="bank_name" class="block mt-1 w-full" type="text" name="bank_name" placeholder="Bank Name" :value="old('bank_name')" required autofocus />
                    <x-input-error :messages="$errors->get('bank_name')" class="mt-2" />
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="branch" :value="__('Branch Address *')" />
                    <x-text-input id="branch" class="block mt-1 w-full" type="text" name="branch" placeholder="Aggrabad Chittagong" :value="old('branch')" required autofocus />
                    <x-input-error :messages="$errors->get('branch')" class="mt-2" />
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="account_name" :value="__('Account Name *')" />
                    <x-text-input id="account_name" class="block mt-1 w-full" type="text" name="account_name" placeholder="Theme Happy" :value="old('account_name')" required autofocus />
                    <x-input-error :messages="$errors->get('account_name')" class="mt-2" />
                </div>
              </div>

              <div class="grid grid-cols-12 gap-3 md:gap-5 xl:gap-6 lg:gap-6 mb-6">
  
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="account_number" :value="__('Account No *')" />
                    <x-text-input id="account_number" class="block mt-1 w-full" type="text" name="account_number" placeholder="001122334455667788" :value="old('account_number')" required autofocus />
                    <x-input-error :messages="$errors->get('account_number')" class="mt-2" />
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="initial_balance" :value="__('Initial Balance *')" />
                    <x-text-input id="initial_balance" class="block mt-1 w-full" type="text" name="initial_balance" placeholder="100" :value="old('initial_balance')" required autofocus />
                    <x-input-error :messages="$errors->get('initial_balance')" class="mt-2" />
                </div>
              </div>

              <x-happy-button type="submit" class="">
                {{ __('Save now') }}
              </x-happy-button>              
            
          </form>
        </div>
    </div>
</x-admin-layout>