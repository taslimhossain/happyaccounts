<x-admin-layout>
    <x-slot:page_title>
            {{ __('Add New Transaction') }}
    </x-slot>
    <x-slot:pages_links>
      @include('project.links')
    </x-slot>

    <div class="py-6 animate-bottom">
        <div class="mx-auto">
          <form method="POST" action="{{ route('project.client-transaction.store') }}" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            @csrf
              <div class="grid grid-cols-12 gap-3 md:gap-5 xl:gap-6 lg:gap-6 mb-6">

                <div class="col-span-12 sm:col-span-4">
                  <x-input-label for="transaction_type" :value="__('Transaction type')" />
                  <x-select-input name="transaction_type" required>
                    @foreach(\App\Helpers\Constant::getProjectTransactions() as $value => $label)
                    @if(in_array($value, array(1,2)))
                        @continue
                    @endif;
                    <option value="{{ $value }}" {{ old('transaction_type') != $value ?: 'selected' }}>{{ $label }}</option>
                    @endforeach
                  </x-select-input>
                  <x-input-error :messages="$errors->get('transaction_type')" class="mt-2" />
                </div>

                <div class="col-span-12 sm:col-span-4">
                  <x-input-label for="account" :value="__('Account')" />
                  <x-select-input name="account" required>
                    <option>Select account</option>
                    @foreach($bankings as $account)
                    <option value="{{ $account->id }}" {{ old('account') != $account->id ?: 'selected' }}>{{ $account->bank_name }}</option>
                    @endforeach
                  </x-select-input>
                  <x-input-error :messages="$errors->get('account')" class="mt-2" />
                </div>

                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="amount" :value="__('Amount')" />
                    <x-text-input id="amount" class="block mt-1 w-full" type="text" name="amount" placeholder="100" :value="old('amount')" required autofocus />
                    <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                  </div>

                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="start_date" :value="__('Start date')" />
                    <x-text-input id="start_date" class="block mt-1 w-full" type="text" name="start_date" placeholder="dd/mm/yyyy" :value="old('start_date', \Carbon\Carbon::now()->format('d/m/Y') )" required autofocus />
                    <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="reference" :value="__('Reference')" />
                    <x-text-input id="reference" class="block mt-1 w-full" type="text" name="reference" placeholder="123456" :value="old('reference')"/>
                    <x-input-error :messages="$errors->get('reference')" class="mt-2" />
                </div>
              </div>

              <div class="grid grid-cols-12 gap-3 md:gap-5 xl:gap-6 lg:gap-6 mb-6">
                <div class="col-span-12 sm:col-span-12">
                  <x-input-label for="note" :value="__('Note')" />
                  <x-textarea-input name="note" rows="3" placeholder="Write your note here!">
                  {{ old('note') }}
                  </x-textarea-input>
                </div>
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <input type="hidden" name="client_id" value="{{ $project->client }}">
              </div>

              <x-happy-button type="submit" class="">
                {{ __('Save now') }}
              </x-happy-button>              
            
          </form>
        </div>
    </div>
</x-admin-layout>