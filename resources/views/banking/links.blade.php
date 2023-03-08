<div class="mt-8">
  
  @if( ! request()->routeIs('banking.create') )
  <x-happy-button href="{{ route( 'banking.create' ) }}"  class="mr-5 bg-lime-600" bgColor="lime" iconPosition="right" >
    {{ __('Add Bank Account') }}
    <x-slot name="icon">
      <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-2 -mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>            
    </x-slot>
  </x-happy-button>
  @endif

  @if( ! request()->routeIs('banking.index') )
  <x-happy-button href="{{ route( 'banking.index' ) }}"  class="mr-5 bg-lime-600" bgColor="lime" iconPosition="right" >
    {{ __('Bank List') }}
    <x-slot name="icon">
      <svg class="w-4 h-4 ml-2 -mr-1" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
      </svg>                    
    </x-slot>
  </x-happy-button>
  @endif

  @if( request()->routeIs('banking.show') )
  <x-happy-button href="{{ route('banking.uuid.deposit-transaction.create', $banking) }}"  class="mr-5 bg-teal-600" bgColor="teal" iconPosition="right" >
    {{ __('Deposit') }}
    <x-slot name="icon">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
      </svg>          
    </x-slot>
  </x-happy-button>
  <x-happy-button href="{{ route('banking.uuid.withdraw-transaction.create', $banking) }}"  class="mr-5 bg-teal-600" bgColor="teal" iconPosition="right" >
    {{ __('Cash withdrawal') }}
    <x-slot name="icon">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
      </svg>              
    </x-slot>
  </x-happy-button>
  <x-happy-button href="{{ route('banking.uuid.deposit-transaction-list', $banking) }}"  class="mr-5 bg-teal-600" bgColor="teal" iconPosition="right" >
    {{ __('Transaction list') }}
    <x-slot name="icon">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
      </svg>               
    </x-slot>
  </x-happy-button>
  @endif


  
  <x-happy-button href="{{ route( 'banking.transfer-transaction.create' ) }}"  class="mr-5 bg-green-600" bgColor="green" iconPosition="right" >
    {{ __('Create Transfer') }}
    <x-slot name="icon">
      <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-2 -mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>                    
    </x-slot>
  </x-happy-button>
  <x-happy-button href="{{ route( 'admin' ) }}"  class="mr-5 bg-teal-600" bgColor="teal" iconPosition="right" >
    {{ __('Transfer List') }}
    <x-slot name="icon">
      <svg class="w-4 h-4 ml-2 -mr-1" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
      </svg>                    
    </x-slot>
  </x-happy-button>
  </div>