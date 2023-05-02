<div class="mt-8">
  
  @if( ! request()->routeIs('expenses_categorie.create') )
  <x-happy-button href="{{ route( 'expenses_categorie.create' ) }}"  class="mr-5 bg-lime-600" bgColor="lime" iconPosition="right" >
    {{ __('Add new category') }}
    <x-slot name="icon">
      <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-2 -mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>            
    </x-slot>
  </x-happy-button>
  @endif


  @if( ! request()->routeIs('project.expenses_categorie') )
  <x-happy-button href="{{ route( 'project.expenses_categorie' ) }}"  class="mr-5 bg-lime-600" bgColor="lime" iconPosition="right" >
    {{ __('Expenses Categorie List') }}
    <x-slot name="icon">
      <svg class="w-4 h-4 ml-2 -mr-1" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
      </svg>                    
    </x-slot>
  </x-happy-button>
  @endif

  </div>