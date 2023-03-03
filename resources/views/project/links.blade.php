<div class="mt-8">
  
  @if( ! request()->routeIs('project.create') )
  <x-happy-button href="{{ route( 'project.create' ) }}"  class="mr-5 bg-lime-600" bgColor="lime" iconPosition="right" >
    {{ __('Create project') }}
    <x-slot name="icon">
      <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-2 -mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>            
    </x-slot>
  </x-happy-button>
  @endif

  @if( ! request()->routeIs('project.index') )
  <x-happy-button href="{{ route( 'project.index' ) }}"  class="mr-5 bg-lime-600" bgColor="lime" iconPosition="right" >
    {{ __('Project List') }}
    <x-slot name="icon">
      <svg class="w-4 h-4 ml-2 -mr-1" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
      </svg>                    
    </x-slot>
  </x-happy-button>
  @endif


  @if( request()->routeIs('project.show') )

  <x-happy-button href="{{ route('project.transaction.index', $project) }}"  class="mr-5 bg-teal-600" bgColor="teal" iconPosition="right" >
    {{ __('Transaction List') }}
    <x-slot name="icon">
      <svg class="w-4 h-4 ml-2 -mr-1" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
      </svg>                    
    </x-slot>
  </x-happy-button>
  @endif

  @if( request()->routeIs('project.show') )
  <x-happy-button href="{{ route('project.transaction.create', $project) }}"  class="mr-5 bg-teal-600" bgColor="teal" iconPosition="right" >
    {{ __('Create vendor transaction') }}
    <x-slot name="icon">
      <svg class="w-4 h-4 ml-2 -mr-1" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
      </svg>                    
    </x-slot>
  </x-happy-button>
  <x-happy-button href="{{ route('project.uuid.client-transaction', $project) }}"  class="mr-5 bg-teal-600" bgColor="teal" iconPosition="right" >
    {{ __('Create client transaction') }}
    <x-slot name="icon">
      <svg class="w-4 h-4 ml-2 -mr-1" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
      </svg>                    
    </x-slot>
  </x-happy-button>

  <x-happy-button href="{{ route('project.uuid.client-transaction', $project) }}"  class="mr-5 bg-teal-600" bgColor="teal" iconPosition="right" >
    {{ __('Expenses transaction') }}
    <x-slot name="icon">
      <svg class="w-4 h-4 ml-2 -mr-1" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
      </svg>                    
    </x-slot>
  </x-happy-button>

  @endif

  <x-happy-button href="{{ route( 'admin' ) }}"  class="mr-5 bg-green-600" bgColor="green" iconPosition="right" >
    {{ __('Create Transfer') }}
    <x-slot name="icon">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-2 -mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>                    
    </x-slot>
  </x-happy-button>
  </div>