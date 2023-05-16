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
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> Date Enter User Name:  </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> Project Name :  </dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Amount : {{ formatTaka($global_transaction->amount) }}/-</dt>
          </div>
          <div class="px-2 py-2 sm:grid sm:grid-cols-0 sm:gap-0 sm:px-0">
            <dt class="font-bold leading-6 text-base text-gray-900">Particulars:  </dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> All inifomation dynamic </dd>
          </div>
          <!---Account to Account Money Transfer -->
          <div class="px-2 py-2 sm:grid sm:grid-cols-0 sm:gap-0 sm:px-0">
            <dt class="font-bold leading-6 text-base text-gray-900">Account to Account Money Transfer</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Account From:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Account To:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Amount:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Date:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Reference:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Note:</span> </dd>
          </div>
            <!--- / Account to Account Money Transfer -->
          <!--- Deposit & withdraw Transfer -->
          <div class="px-2 py-2 sm:grid sm:grid-cols-0 sm:gap-0 sm:px-0">
            <dt class="font-bold leading-6 text-base text-gray-900"> Deposit & withdraw Transfer</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Account From:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Type : </span> Deposit Or Withdraw </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Amount:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Date:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Reference:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Note:</span> </dd>
          </div>
            <!--- / Deposit & withdraw Transfer -->
          <!--- Vendor Transaction -->
          <div class="px-2 py-2 sm:grid sm:grid-cols-0 sm:gap-0 sm:px-0">
            <dt class="font-bold leading-6 text-base text-gray-900">Vendor Transaction</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Account Name:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Vendor Name :</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Expenses cateogry:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Amount:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Trans Date:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Reference:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Note:</span> </dd>
          </div>
            <!--- / Vendor Transaction -->
          <!--- Client Transaction -->
          <div class="px-2 py-2 sm:grid sm:grid-cols-0 sm:gap-0 sm:px-0">
            <dt class="font-bold leading-6 text-base text-gray-900">Client Transaction</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Transaction type:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Account Name:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Client Name :</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Amount:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Trans Date:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Reference:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Note:</span> </dd>
          </div>
            <!--- / Client Transaction -->
          <!--- Project Other Transaction -->
          <div class="px-2 py-2 sm:grid sm:grid-cols-0 sm:gap-0 sm:px-0">
            <dt class="font-bold leading-6 text-base text-gray-900">Project Other Transaction</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Account Name:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Expenses cateogry:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Amount:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Trans Date:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Reference:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Note:</span> </dd>
          </div>
            <!--- / Project Other Transaction -->
          <!--- Office Transaction -->
          <div class="px-2 py-2 sm:grid sm:grid-cols-0 sm:gap-0 sm:px-0">
            <dt class="font-bold leading-6 text-base text-gray-900">Office Transaction</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Account Name:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Expenses cateogry:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Amount:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Trans Date:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Reference:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Note:</span> </dd>
          </div>
            <!--- / Office Transaction -->
          <!--- Staff Salary Transaction -->
          <div class="px-2 py-2 sm:grid sm:grid-cols-0 sm:gap-0 sm:px-0">
            <dt class="font-bold leading-6 text-base text-gray-900">Staff Salary Transaction</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Account Name:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Staff Name :</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Amount:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Trans Date:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Reference:</span> </dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Note:</span> </dd>
          </div>
            <!--- / Staff Salary Transaction -->
        
          <div class="px-2 py-2 sm:grid sm:grid-cols-0 sm:gap-0 sm:px-0">
            <dt class="font-bold leading-6 text-base text-gray-900">Bank</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Bank name:</span> {{ $bank_transaction->bankName->bank_name }}</dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Branch:</span> {{ $bank_transaction->bankName->branch }}</dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Account name:</span> {{ $bank_transaction->bankName->account_name }}</dd>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> <span class="font-semibold">Account number:</span> {{ $bank_transaction->bankName->account_number }}</dd>
          </div>
          {{-- <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Email address</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">margotfoster@example.com</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">Salary expectation</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">$120,000</dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
            <dt class="text-sm font-medium leading-6 text-gray-900">About</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">Fugiat ipsum ipsum deserunt culpa aute sint do nostrud anim incididunt cillum culpa consequat. Excepteur qui ipsum aliquip consequat sint. Sit id mollit nulla mollit nostrud in ea officia proident. Irure nostrud pariatur mollit ad adipisicing reprehenderit deserunt qui eu.</dd>
          </div> --}}
        </dl>
      </div>
    </div>
    






</x-admin-layout>
