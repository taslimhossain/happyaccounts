<x-admin-layout>
    <x-slot:page_title>
            {{ __('Office Transactions') }}
    </x-slot>
    <div class="py-6">
      <div class="mx-auto">
        @include('report.office-transaction.transaction-filter')
      </div>
    </div>

    <div class="py-6 animate-bottom">
        <div class="mx-auto">
            <div class="w-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              @if($transactions->hasPages())
              <div class="border-t bg-gray-50 px-4 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 sm:grid-cols-9">
                  {{ $transactions->withQueryString()->links() }}
              </div>
            @endif
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-800 uppercase border-b dark:border-gray-700 bg-gray-200 dark:text-gray-400 dark:bg-gray-700">
                      <th class="px-4 py-3">Trans Date</th>
                      <th class="px-4 py-3">Post Date</th>
                      <th class="px-4 py-3">Particulars</th>
                      <th class="px-4 py-3">Trans ID</th>
                      <th class="px-4 py-3 w-36">Account</th>
                      <th class="px-4 py-3">Debit Amount</th>
                      <th class="px-4 py-3">Credit Amount</th>
                      <th class="px-4 py-3">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @forelse($transactions as $banking)
                      <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-2 text-sm"><p class="font-bold">{{ $banking->trans_date }}</p> </td>
                        <td class="px-4 py-2 text-sm"> {{ $banking->create_date }} </td>
                        <td class="px-4 py-2 text-sm"> <span class="font-semibold uppercase">{{ $banking->particulars }}</span> {{ $banking->getStaff ? 'to '.$banking->getStaff->name : '' }} {{ $banking->getCategory ? $banking->getCategory->name : '' }} {{ $banking->reference ? 'Reference: '.$banking->reference : null  }} </td>
                        <td class="px-4 py-2 text-sm"> {{$banking->globalTransaction->uuid }} </td>
                        <td class="px-3 py-2 text-sm"> {{ $banking->bankName->account_name }} </td>
                        <td class="px-4 py-2 text-sm"> {{ $banking->debit_amount }} </td>
                        <td class="px-4 py-2 text-sm"> {{ $banking->credit_amount }} </td>
                        <td class="px-4 py-2">
                          <div class="flex items-center space-x-4 text-sm">
                            <x-happy-button href="{{ route('transaction-details', ['uuid' => $banking->globalTransaction->uuid]) }}"  class="py-2 px-2 bg-green-600" bgColor="green" iconPosition="right" >
                              <x-slot name="icon">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>                                    
                              </x-slot>
                            </x-happy-button>
                          </div>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td class="px-4 py-3" colspan="4">No data found.</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>

              @if($transactions->hasPages())
                <div class="border-t bg-gray-50 px-4 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 sm:grid-cols-9">
                    {{ $transactions->withQueryString()->links() }}
                </div>
              @endif
            </div>
        </div>
    </div>
</x-admin-layout>