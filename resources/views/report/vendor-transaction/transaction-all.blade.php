<x-admin-layout>
    <x-slot:page_title>
            {{ __('Vendor Transactions') }}
    </x-slot>

    <div class="py-6">
      <div class="mx-auto">
        @include('report.vendor-transaction.transaction-filter')
      </div>
    </div>
    <div class="py-6 animate-bottom">
        <div class="mx-auto">
            <div class="w-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
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
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @forelse($transactions as $transaction)
                      <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-2 text-sm"><p class="font-bold">{{ $transaction->trans_date }}</p> </td>
                        <td class="px-4 py-2 text-sm"> {{ $transaction->create_date }} </td>
                        <td class="px-4 py-2 text-sm"> <span class="font-semibold uppercase">{{ $transaction->particulars }}</span> {{ $transaction->vendorName->name }}, {{ $transaction->projectTransaction->expensesName ? $transaction->projectTransaction->expensesName->name : '' }}, {{ $transaction->reference ? 'Reference: '.$transaction->reference : null  }} , Project: {{ $transaction->projectName->project_title }} </td>
                        <td class="px-4 py-2 text-sm"> {{ $transaction->globalTransaction->uuid }} </td>
                        <td class="px-3 py-2 text-sm"> {{ $transaction->bankName->account_name }} </td>
                        <td class="px-4 py-2 text-sm"> {{ $transaction->debit_amount }} </td>
                        <td class="px-4 py-2 text-sm"> {{ $transaction->credit_amount }} </td>
                      </tr>
                      @if ($loop->last)
                        <tr>
                          <td class="px-4 py-2 text-sm"><p class="font-bold">Total:</p></td>
                          <td class="px-4 py-2 text-sm"></td>
                          <td class="px-4 py-2 text-sm"></td>
                          <td class="px-4 py-2 text-sm"></td>
                          <td class="px-4 py-2 text-sm"></td>
                          <td class="px-4 py-2 text-sm">{{ $transactions[0]->total_debit }}</td>
                          <td class="px-4 py-2 text-sm">{{ $transactions[0]->total_credit }}</td>
                        </tr>
                      @endif
                    @empty
                      <tr>
                        <td class="px-4 py-3" colspan="4">No Transactions found.</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
</x-admin-layout>