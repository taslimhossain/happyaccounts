<form method="GET" action="{{ route('report.bank-transaction') }}" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800" id="filterForm">
      <div class="grid grid-cols-12 gap-3 md:gap-5 xl:gap-6 lg:gap-6 mb-6">
        <div class="col-span-12 sm:col-span-3">
          <x-input-label for="banking_id" :value="__('Account')" />
          <x-select-input name="banking_id" required>
            <option value="all">All account</option>
            @foreach($bankings as $account)
            <option value="{{ $account->id }}" {{ request('banking_id', isset($bank) ? $bank->id : null ) != $account->id ?: 'selected' }}>{{ $account->bank_name }}</option>
            @endforeach
          </x-select-input>
        </div>

        <div class="col-span-12 sm:col-span-3">
          <x-input-label for="start_date" :value="__('Start date')" />
          <x-text-input id="start_date" class="happydate block mt-1 w-full" type="text" name="start_date" placeholder="dd/mm/yyyy" :value="request('start_date')" required autofocus />
        </div>

        <div class="col-span-12 sm:col-span-3">
          <x-input-label for="end_date" :value="__('End date')" />
          <x-text-input id="end_date" class="happydate block mt-1 w-full" type="text" name="end_date" placeholder="dd/mm/yyyy" :value="request('end_date')" required autofocus />
        </div>

        <div class="col-span-12 sm:col-span-3">
          <x-input-label for="trans_type" :value="__('Transaction type')" />
          <x-select-input name="trans_type">
            <option value="all">All</option>
            <option value="debit" {{ request('trans_type') === 'debit' ? 'selected' : '' }}>Debit</option>
            <option value="credit" {{ request('trans_type') === 'credit' ? 'selected' : '' }}>Credit</option>
          </x-select-input>
        </div>

      </div>
      <input type="hidden" name="is_filter" value="yes">
      <x-happy-button type="submit" class=""> {{ __('Submit') }} </x-happy-button>       
      @if(request('is_filter') === 'yes')
      <x-happy-button type="submit" id="printButton" name="is_print" value="yes" class=""> {{ __('Print') }} </x-happy-button>
      @endif
      {{-- <x-happy-button href="{{ url()->current() }}"  name="is_print" value="yes" class=""> {{ __('Print') }} </x-happy-button> --}}
</form>