@php
   use App\Helpers\Constant;
@endphp
<x-admin-layout>
    <x-slot:page_title>
            {{ __('Project List') }}
    </x-slot>
    <x-slot:pages_links>
      @include('project.links')
    </x-slot>

    <div class="py-6 animate-bottom">
        <div class="mx-auto">
            <div class="w-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-800 uppercase border-b dark:border-gray-700 bg-gray-200 dark:text-gray-400 dark:bg-gray-700">
                      <th class="px-4 py-3">Project Name</th>
                      <th class="px-4 py-3">Client</th>
                      <th class="px-4 py-3">Start date</th>
                      <th class="px-4 py-3">End date</th>
                      <th class="px-4 py-3">Status</th>
                      <th class="px-4 py-3">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @forelse($projects as $project)
                      <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-2 text-sm"><p class="font-bold">{{ $project->project_title }}</p> </td>
                        <td class="px-4 py-2 text-sm"> {{ $project?->client_details?->client_name ? $project->client_details->client_name : '- - - -' }} </td>
                        <td class="px-4 py-2 text-sm"> {{ $project->start_date }} </td>
                        <td class="px-4 py-2 text-sm"> {{ $project->end_date }} </td>
                        <td class="px-4 py-2 text-xs">
                          @if($project->status == Constant::PROJECT_STATUS['canceled'])
                          <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">{{ Constant::getProjectStatus()[$project->status] }}</span>
                          @else
                          <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"> {{ Constant::getProjectStatus()[$project->status] }} </span>
                          @endif

                        </td>
                        <td class="px-4 py-2">
                          <div class="flex items-center space-x-4 text-sm">
                            
                            <x-happy-button href="{{ route('project.show', $project) }}"  class="py-2 px-2 bg-green-600" bgColor="green" iconPosition="right" >
                              <x-slot name="icon">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>                                    
                              </x-slot>
                            </x-happy-button>

                            <x-happy-button href="{{ route('project.edit', $project) }}"  class="py-2 px-2 bg-yellow-600" bgColor="yellow" iconPosition="right" >
                              <x-slot name="icon">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                  <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                </svg>        
                              </x-slot>
                            </x-happy-button>
                    

                            <form action="{{ route('project.destroy', $project) }}" id="delete-form-{{$project->id}}" method="POST" onsubmit="return confirm('Are you sure?')" style="display: inline-block;">
                              @csrf
                              @method('DELETE')
                              <x-happy-button type="button" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" onclick="return deletePopup({{$project->id}})" data-confirm-yes="document.getElementById('delete-form-{{$project->id}}').submit();" class="py-2 px-2 bg-red-600" bgColor="red" iconPosition="right" >
                                <x-slot name="icon">
                                  <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" ></path>
                                  </svg>       
                                </x-slot>
                              </x-happy-button>
                            </form>                         


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

              @if($projects->hasPages())
                <div class="border-t bg-gray-50 px-4 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 sm:grid-cols-9">
                    {{ $projects->withQueryString()->links() }}
                </div>
              @endif
            </div>
        </div>
    </div>
    <x-deletemodal />
</x-admin-layout>