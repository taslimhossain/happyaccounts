@php
   use App\Helpers\Constant;
@endphp
<x-admin-layout>
    <x-slot:page_title>
            {{ __('Transaction details') }}
    </x-slot>


    <div class="bg-white p-5 mt-2">
      <div class="px-4 sm:px-0 mt-4">
        <h3 class="text-base font-semibold leading-7 text-gray-900">ID : #{{ $global_transaction->uuid }}</h3>
        <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Date: {{ $global_transaction->trans_date }}</p>
      </div>
      <div class="mt-6 border-t border-gray-100">
        <dl class="divide-y divide-gray-100">
          <div class="px-2 py-2 sm:grid sm:grid-cols-0 sm:gap-0 sm:px-0">
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Transaction by: </span>  {{ $global_transaction->userInfo->name }}</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Amount : {{ formatTaka($global_transaction->amount) }}</dt>
          </div>

          @if($bank_transaction && $bank_transaction->count() === 1)
          <div class="px-2 py-2 sm:grid sm:grid-cols-0 sm:gap-0 sm:px-0">
            <dt class="font-bold leading-6 text-base text-gray-900">Bank</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Bank name:</span> {{ $bank_transaction[0]->bankName->bank_name }}</dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Branch:</span> {{ $bank_transaction[0]->bankName->branch }}</dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Account name:</span> {{ $bank_transaction[0]->bankName->account_name }}</dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Account number:</span> {{ $bank_transaction[0]->bankName->account_number }}</dd>
          </div> 
          @endif


          <!---Account to Account Money Transfer -->
          @if($bank_transaction && Constant::TRANSACTIONS['found_transfer'] === $bank_transaction[0]->title)
          <div class="px-2 py-2 sm:grid sm:grid-cols-0 sm:gap-0 sm:px-0">
            <dt class="font-bold leading-6 text-base text-gray-900">Account to Account Money Transfer</dt>
            
            @if($bank_transaction[0]->trans_type === 'debit')
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Account From:</span> {{ $bank_transaction[0]->bankName->bank_name }}</dd>
            @endif

            @if($bank_transaction[1]->trans_type === 'debit')
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Account From:</span> {{ $bank_transaction[1]->bankName->bank_name }}</dd>
            @endif
            
            @if($bank_transaction[0]->trans_type === 'credit')
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Account To:</span> {{ $bank_transaction[0]->bankName->bank_name }}</dd>
            @endif

            @if($bank_transaction[1]->trans_type === 'credit')
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Account To:</span> {{ $bank_transaction[1]->bankName->bank_name }}</dd>
            @endif
            {{-- <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Amount:</span> {{ formatTaka($global_transaction->amount) }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Date:</span> {{ $bank_transaction[0]->trans_date }}</dd> --}}
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Reference:</span> {{ $bank_transaction[0]->reference }}</dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Note:</span> {{ $bank_transaction[0]->note }}</dd>
          </div>
          @endif
            <!--- / Account to Account Money Transfer -->

          <!--- Deposit & withdraw Transfer -->
          @if($bank_transaction && Constant::TRANSACTIONS['bank_deposit'] === $bank_transaction[0]->title)
          <div class="px-2 py-2 sm:grid sm:grid-cols-0 sm:gap-0 sm:px-0">
            <dt class="font-bold leading-6 text-base text-gray-900">Deposit</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Account To:</span> {{ $bank_transaction[0]->bankName->bank_name }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Type : </span> {{ $bank_transaction[0]->particulars }} </dd>
            {{-- <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Amount:</span> {{ formatTaka($global_transaction->amount) }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Date:</span> {{ $bank_transaction[0]->trans_date }}</dd> --}}
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Reference:</span> {{ $bank_transaction[0]->reference }}</dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Note:</span> {{ $bank_transaction[0]->note }}</dd>
          </div>
          @endif
            <!--- / Deposit & withdraw Transfer -->

          <!--- Deposit & withdraw Transfer -->
          @if($bank_transaction && Constant::TRANSACTIONS['cash_withdrawal'] === $bank_transaction[0]->title)
          <div class="px-2 py-2 sm:grid sm:grid-cols-0 sm:gap-0 sm:px-0">
            <dt class="font-bold leading-6 text-base text-gray-900">Withdraw</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Account To:</span> {{ $bank_transaction[0]->bankName->bank_name }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Type : </span> {{ $bank_transaction[0]->particulars }} </dd>
            {{-- <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Amount:</span> {{ formatTaka($global_transaction->amount) }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Date:</span> {{ $bank_transaction[0]->trans_date }}</dd> --}}
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Reference:</span> {{ $bank_transaction[0]->reference }}</dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Note:</span> {{ $bank_transaction[0]->note }}</dd>
          </div>
          @endif
            <!--- / Deposit & withdraw Transfer -->

          <!--- Vendor Transaction -->
          @if($vendor_transaction)
          <div class="px-2 py-2 sm:grid sm:grid-cols-0 sm:gap-0 sm:px-0">
            <dt class="font-bold leading-6 text-base text-gray-900">Vendor</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Name:</span> {{ $vendor_transaction->vendorName->name }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Phone:</span> {{ $vendor_transaction->vendorName->phone }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Phone 2:</span> {{ $vendor_transaction->vendorName->phone_2 }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Email:</span> {{ $vendor_transaction->vendorName->email }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Address:</span> {{ $vendor_transaction->vendorName->address }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Name:</span> {{ $vendor_transaction->vendorName->billing_name }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Phone:</span> {{ $vendor_transaction->vendorName->billing_phone }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Address:</span> {{ $vendor_transaction->vendorName->billing_address }} </dd>
            {{-- <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Amount:</span> {{ formatTaka($global_transaction->amount) }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Date:</span> {{ $bank_transaction[0]->trans_date }}</dd> --}}
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Reference:</span> {{ $vendor_transaction->reference }}</dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Note:</span> {{ $vendor_transaction->note }}</dd>
          </div>
          @endif
            <!--- / Vendor Transaction -->

          <!--- Client Transaction -->
          @if($client_transaction)
          <div class="px-2 py-2 sm:grid sm:grid-cols-0 sm:gap-0 sm:px-0">
            <dt class="font-bold leading-6 text-base text-gray-900">Client</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Transaction type:</span> {{ $client_transaction->particulars }}</dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold"> Name :</span> {{ $client_transaction->clientName->client_name }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold"> Phone :</span> {{ $client_transaction->clientName->phone }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold"> Phone 2 :</span> {{ $client_transaction->clientName->phone_2 }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold"> Email :</span> {{ $client_transaction->clientName->email }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold"> Address :</span> {{ $client_transaction->clientName->address }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold"> Billing name :</span> {{ $client_transaction->clientName->billing_name }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold"> Billing phone :</span> {{ $client_transaction->clientName->billing_phone }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Billing address :</span> {{ $client_transaction->clientName->billing_address }} </dd>
            {{-- <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Amount:</span> {{ formatTaka($global_transaction->amount) }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Date:</span> {{ $bank_transaction[0]->trans_date }}</dd> --}}
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Reference:</span> {{ $client_transaction->reference }}</dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Note:</span> {{ $client_transaction->note }}</dd>
          </div>
          @endif
            <!--- / Client Transaction -->
          <!--- Project Other Transaction -->
          @if($project_transaction)
          <div class="px-2 py-2 sm:grid sm:grid-cols-0 sm:gap-0 sm:px-0">
            <dt class="font-bold leading-6 text-base text-gray-900">Project</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Particulars:</span> {{ $project_transaction->particulars }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Project Name:</span> {{ $project_transaction->projectName->project_title }} </dd>
            @if($project_transaction->expensesName)
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Expenses cateogry:</span> {{ $project_transaction->expensesName->name }}</dd>
            @endif
            {{-- <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Amount:</span> {{ formatTaka($global_transaction->amount) }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Date:</span> {{ $bank_transaction[0]->trans_date }}</dd> --}}
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Reference:</span> {{ $project_transaction->reference }}</dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Note:</span> {{ $project_transaction->note }}</dd>
          </div>
          @endif
            <!--- / Project Other Transaction -->
          <!--- Office Transaction -->
          @if($office_transaction && $office_transaction->is_salary != 'yes' )
          <div class="px-2 py-2 sm:grid sm:grid-cols-0 sm:gap-0 sm:px-0">
            <dt class="font-bold leading-6 text-base text-gray-900">Office</dt>
            @if($office_transaction->expensesName)
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Expenses cateogry:</span> {{ $office_transaction->expensesName->name }} </dd>
            @endif
            {{-- <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Amount:</span> {{ formatTaka($global_transaction->amount) }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Date:</span> {{ $bank_transaction[0]->trans_date }}</dd> --}}
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Reference:</span> {{ $office_transaction->reference }}</dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Note:</span> {{ $office_transaction->note }}</dd>
          </div>
          @endif
            <!--- / Office Transaction -->
          <!--- Staff Salary Transaction -->
          @if($office_transaction && $office_transaction->is_salary === 'yes' )
          <div class="px-2 py-2 sm:grid sm:grid-cols-0 sm:gap-0 sm:px-0">
            <dt class="font-bold leading-6 text-base text-gray-900">Staff Salary</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Particulars:</span> {{ $office_transaction->particulars }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Name :</span> {{ $office_transaction->getStaff->name }}</dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Phone :</span> {{ $office_transaction->getStaff->phone }}</dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Email :</span> {{ $office_transaction->getStaff->email }}</dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Address :</span> {{ $office_transaction->getStaff->address }}</dd>
            {{-- <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Amount:</span> {{ formatTaka($global_transaction->amount) }} </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Date:</span> {{ $bank_transaction[0]->trans_date }}</dd> --}}
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Reference:</span> {{ $office_transaction->reference }}</dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Note:</span> {{ $office_transaction->note }}</dd>
          </div>
          @endif
            <!--- / Staff Salary Transaction -->
        </dl>
      </div>
    </div>
    






</x-admin-layout>
