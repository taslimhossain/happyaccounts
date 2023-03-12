<x-admin-layout>
    <x-slot:page_title>
            {{ __('Add New Category') }}
    </x-slot>
    <x-slot:pages_links>
      @include('expenses.links')
    </x-slot>
    
    <div class="py-6">
        <div class="mx-auto">
          <form method="POST" action="{{ route('expenses_categorie.store') }}" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            @csrf
              <div class="grid grid-cols-12 gap-3 md:gap-5 xl:gap-6 lg:gap-6 mb-6">
                <div class="col-span-12 sm:col-span-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="Stationary" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="col-span-12 sm:col-span-4">
                  <x-input-label for="status" :value="__('Status')" />
                  <x-select-input name="status">
                    @foreach(\App\Helpers\Constant::getRowStatus() as $value => $label)
                    <option value="{{ $value }}" {{ old('status') != $value ?: 'selected' }}>{{ $label }}</option>
                    @endforeach
                  </x-select-input>
                  <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>
                <div class="col-span-12 sm:col-span-4">
                  <input type="hidden" name="expenses_for" value="office">
                </div>
              </div>
              <x-happy-button type="submit" class="">
                {{ __('Save now') }}
              </x-happy-button>              
          </form>
        </div>
    </div>
</x-admin-layout>