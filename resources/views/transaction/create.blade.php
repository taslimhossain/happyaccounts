<x-admin-layout>
    <x-slot:page_title>
            {{ __('Add New Transaction') }}
    </x-slot>
    <x-slot:pages_links>
      @include('project.links')
    </x-slot>

    <div class="py-6 animate-bottom">
        <div class="mx-auto">
          <form method="POST" action="{{ route('project.store') }}" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            @csrf
              <div class="grid grid-cols-12 gap-3 md:gap-5 xl:gap-6 lg:gap-6 mb-6">

                <div class="col-span-12 sm:col-span-4">
                  <x-input-label for="transaction_type" :value="__('Transaction type')" />
                  <x-select-input name="transaction_type">
                    @foreach(\App\Helpers\Constant::getProjectTransactions() as $value => $label)
                    <option value="{{ $value }}" {{ old('transaction_type') != $value ?: 'selected' }}>{{ $label }}</option>
                    @endforeach
                  </x-select-input>
                  <x-input-error :messages="$errors->get('transaction_type')" class="mt-2" />
                </div>

                <div class="col-span-12 sm:col-span-4">
                  <x-input-label for="vendor" :value="__('Vendor')" />
                  <x-select-input name="vendor" required>
                    <option>Select vendor</option>
                    @foreach($vendors as $vendor)
                    <option value="{{ $vendor->id }}" {{ old('vendor') != $vendor->id ?: 'selected' }}>{{ $vendor->name }}</option>
                    @endforeach
                  </x-select-input>
                  <x-input-error :messages="$errors->get('vendor')" class="mt-2" />

                  <x-input-label for="client" :value="__('Client')" />
                  <x-select-input name="client" required>
                    <option>Select client</option>
                    @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client') != $client->id ?: 'selected' }}>{{ $client->client_name }}</option>
                    @endforeach
                  </x-select-input>
                  <x-input-error :messages="$errors->get('client')" class="mt-2" />

                </div>


                <div class="col-span-12 sm:col-span-4">
                  <x-input-label for="account" :value="__('Account')" />
                  <x-select-input name="account" required>
                    <option>Select account</option>
                    @foreach($bankings as $account)
                    <option value="{{ $account->id }}" {{ old('client') != $account->id ?: 'selected' }}>{{ $account->bank_name }}</option>
                    @endforeach
                  </x-select-input>
                  <x-input-error :messages="$errors->get('account')" class="mt-2" />
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
                    <x-input-label for="client" :value="__('Client')" />
                    <x-select-input name="client" required>
                      <option>Select client</option>
                      @foreach($clients as $client)
                      <option value="{{ $client->id }}" {{ old('client') != $client->id ?: 'selected' }}>{{ $client->client_name }}</option>
                      @endforeach
                    </x-select-input>
                    <x-input-error :messages="$errors->get('client')" class="mt-2" />
                </div>

                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="project_price" :value="__('Project price')" />
                    <x-text-input id="project_price" class="block mt-1 w-full" type="text" name="project_price" placeholder="100" :value="old('project_price')" required autofocus />
                    <x-input-error :messages="$errors->get('project_price')" class="mt-2" />
                </div>

                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="status" :value="__('Status')" />
                    <x-select-input name="status">
                      @foreach(\App\Helpers\Constant::getProjectStatus() as $value => $label)
                      <option value="{{ $value }}" {{ old('status') != $value ?: 'selected' }}>{{ $label }}</option>
                      @endforeach
                    </x-select-input>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>
              </div>
              <div class="grid grid-cols-12 gap-3 md:gap-5 xl:gap-6 lg:gap-6 mb-6">
                <div class="col-span-12 sm:col-span-12">
                  <x-input-label for="description" :value="__('Description')" />
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