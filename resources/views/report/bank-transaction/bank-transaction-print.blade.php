<x-print-layout>
  <p class="mt-1 text-center">Power Qoeng Ltd</p>
  <div class="transaction-info text-xs pb-2">
    @foreach($bankings as $account)
      @if(!empty(request('banking_id')) &&  $account->id == intval(request('banking_id')))
      <p class="font-semibold">Account: <span class="font-normal">{{ $account->bank_name }}</span> </p>
      @endif
    @endforeach

    @if( request()->has('start_date') && request()->has('end_date') && !empty(request('start_date')) && !empty( request('end_date')) )
        <p class="font-semibold">Transaction from: <span class="font-normal">{{ request('start_date') }} to {{ request('end_date') }}</span></p>
    @endif

    <p class="font-semibold">Print Date: <span class="font-normal">{{ \Carbon\Carbon::now()->format('d/m/Y h:m:s') }}</span> By: <span class="font-normal">{{ Auth::user()->name }}</span></p>
  </div>

  
  <table class="w-full whitespace-no-wrap">
    <thead>
      <tr class="text-xs font-semibold tracking-wide text-left text-gray-800 uppercase border-b dark:border-gray-700 bg-gray-200 dark:text-gray-400 dark:bg-gray-700">
        <th class="px-1 py-1">Date</th>
        <th class="px-1 py-1">Particulars</th>
        <th class="px-1 py-1">Debit</th>
        <th class="px-1 py-1">Credit</th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
      @forelse($transactions as $transaction)
        <tr class="text-gray-700 dark:text-gray-400">
          <td class="px-2 py-1 text-xs">
              @if(\Carbon\Carbon::createFromFormat('d/m/Y', $transaction->trans_date)->eq(\Carbon\Carbon::createFromFormat('d/m/Y', $transaction->create_date)))
              <p class="font-bold">{{ $transaction->trans_date }}</p>
              @else
              <p class="font-bold">{{ $transaction->trans_date }}</p>
              <p>{{ $transaction->create_date }}</p>
              @endif
          </td>
          <td class="px-2 py-1 text-xs"> <span class="font-semibold uppercase">{{ $transaction->particulars }}</span> {{ $transaction->reference ? 'Reference: '.$transaction->reference : null  }} Trace ID: {{ $transaction->globalTransaction->uuid }} </td>
          <td class="px-2 py-1 text-xs"> {{ $transaction->debit_amount }} </td>
          <td class="px-2 py-1 text-xs"> {{ $transaction->credit_amount }} </td>
        </tr>

        @if ($loop->last)
          <tr>
            <td class="px-2 py-1 text-xs"><p class="font-bold">Total:</p></td>
            <td class="px-2 py-1 text-xs"></td>
            <td class="px-2 py-1 text-xs">{{ $transaction->total_debit }}</td>
            <td class="px-2 py-1 text-xs">{{ $transaction->total_credit }}</td>
          </tr>
        @endif

      @empty
        <tr>
          <td class="px-1 py-1" colspan="4">No Transactions found.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</x-print-layout>