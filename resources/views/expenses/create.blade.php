<x-admin-layout>
    <x-slot:page_title>
            {{ __('Office Transaction') }}
    </x-slot>
    <x-slot:pages_links>
      @include('expenses.links')
    </x-slot>

    <div class="py-6 animate-bottom">
        <div class="mx-auto">
          <form method="POST" action="{{ route('expenses.store') }}" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            @csrf
              <div class="grid grid-cols-12 gap-3 md:gap-5 xl:gap-6 lg:gap-6 mb-6">
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
                  <x-input-label for="expenses_id" :value="__('Categorie')" />
                  <x-select-input name="expenses_id" required>
                    <option>Select categorie</option>
                    @foreach($expenses_cateogrys as $expenses_cateogry)
                    <option value="{{ $expenses_cateogry->id }}" {{ old('expenses_id') != $expenses_cateogry->id ?: 'selected' }}>{{ $expenses_cateogry->name }}</option>
                    @endforeach
                  </x-select-input>
                  <x-input-error :messages="$errors->get('expenses_id')" class="mt-2" />
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="amount" :value="__('Amount')" />
                    <x-text-input id="amount" class="block mt-1 w-full" type="text" name="amount" placeholder="100" :value="old('amount')" required autofocus />
                    <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="trans_date" :value="__('Trans Date')" />
                    <x-text-input id="trans_date" class="happydate block mt-1 w-full" type="text" name="trans_date" placeholder="dd/mm/yyyy" :value="old('trans_date', \Carbon\Carbon::now()->format('d/m/Y') )" required autofocus />
                    <x-input-error :messages="$errors->get('trans_date')" class="mt-2" />
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

                <input type="hidden" name="transaction_type" value="{{ \App\Helpers\Constant::TRANSACTIONS['office_expenses'] }}">
              </div>
              <x-happy-button type="submit" class="">
                {{ __('Save now') }}
              </x-happy-button>
          </form>
        </div>
    </div>
</x-admin-layout>