<x-admin-layout>
    <x-slot:page_title>
            {{ __('Bank List') }}
    </x-slot>
    <x-slot:pages_links>
      @include('banking.links')
    </x-slot>

    <div class="py-6">
        <div class="mx-auto">
            <div class="w-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-800 uppercase border-b dark:border-gray-700 bg-gray-200 dark:text-gray-400 dark:bg-gray-700">
                      <th class="px-4 py-3">Account Name</th>
                      <th class="px-4 py-3">Account No</th>
                      <th class="px-4 py-3">Bank Name</th>
                      <th class="px-4 py-3">Branch</th>
                      <th class="px-4 py-3">Balance</th>
                      <th class="px-4 py-3">Status</th>
                      <th class="px-4 py-3">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @forelse($bankings as $banking)
                      <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-2 text-sm"><p class="font-bold">{{ $banking->account_name }}</p> </td>
                        <td class="px-4 py-2 text-sm"> {{ $banking->account_number }} </td>
                        <td class="px-4 py-2 text-sm"> {{ $banking->bank_name }} </td>
                        <td class="px-4 py-2 text-sm"> {{ $banking->branch }} </td>
                        <td class="px-4 py-2 text-sm">{{ $banking->initial_balance }}</td>
                        <td class="px-4 py-2 text-xs">
                          @if($banking->status)
                          <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"> Active </span>
                          @else
                          <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">Inactive</span>
                          @endif

                        </td>
                        <td class="px-4 py-2">
                          <div class="flex items-center space-x-4 text-sm">
                            
                            <x-happy-button href="{{ route('banking.edit', $banking) }}"  class="py-2 px-2 bg-green-600" bgColor="green" iconPosition="right" >
                              <x-slot name="icon">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                  <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                </svg>        
                              </x-slot>
                            </x-happy-button>
                    
                            <x-happy-button href="{{ route( 'banking.create' ) }}"  class="py-2 px-2 bg-red-600" bgColor="red" iconPosition="right" >
                              <x-slot name="icon">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                  <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" ></path>
                                </svg>       
                              </x-slot>
                            </x-happy-button>
                          </div>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td class="px-4 py-3" colspan="4">No categories found.</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>

              @if($bankings->hasPages())
                <div class="border-t bg-gray-50 px-4 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 sm:grid-cols-9">
                    {{ $bankings->withQueryString()->links() }}
                </div>
              @endif
            </div>
        </div>
    </div>
</x-admin-layout>