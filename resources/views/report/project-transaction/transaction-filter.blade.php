<form method="GET" action="{{ route('report.project-transaction') }}" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800" id="filterForm">
      <div class="grid grid-cols-12 gap-3 md:gap-5 xl:gap-6 lg:gap-6 mb-6">
        
        <div class="col-span-12 sm:col-span-3">
          <x-input-label for="projects_id" :value="__('Project')" />
          <x-select-input name="projects_id" class="happyselect">
            <option value="all">All project</option>
            @foreach($projects as $project)
            <option value="{{ $project->id }}" {{ request('projects_id') != $project->id ?: 'selected' }}>{{ $project->project_title }}</option>
            @endforeach
          </x-select-input>
        </div>

        <div class="col-span-12 sm:col-span-3">
          <x-input-label for="expenses_categorie" :value="__('Expenses categorie')" />
          <x-select-input name="expenses_categorie" class="happyselect">
            <option value="all">All expenses categorie</option>
            @foreach($expenses_categories as $expenses_categorie)
            <option value="{{ $expenses_categorie->id }}" {{ request('expenses_categorie') != $expenses_categorie->id ?: 'selected' }}>{{ $expenses_categorie->name }}</option>
            @endforeach
          </x-select-input>
        </div>

        <div class="col-span-12 sm:col-span-3">
          <x-input-label for="start_date" :value="__('Start date')" />
          <x-text-input id="start_date" class="happydate block mt-1 w-full" type="text" name="start_date" placeholder="dd/mm/yyyy" :value="request('start_date')" required autofocus />
        </div>

        <div class="col-span-12 sm:col-span-3">
          <x-input-label for="end_date" :value="__('End date')" />
          <x-text-input id="end_date" class="happydate block mt-1 w-full" type="text" name="end_date" placeholder="dd/mm/yyyy" :value="request('end_date')" required autofocus />
        </div>

        <div class="col-span-12 sm:col-span-3">
          <x-input-label for="trans_type" :value="__('Transaction Type')" />
          <x-select-input name="trans_type">
            <option value="all">All</option>
            <option value="debit" {{ request('trans_type') === 'debit' ? 'selected' : '' }}>Debit</option>
            <option value="credit" {{ request('trans_type') === 'credit' ? 'selected' : '' }}>Credit</option>
          </x-select-input>
        </div>

        <div class="col-span-12 sm:col-span-3">
          <x-input-label for="pay_to" :value="__('Pay to')" />
          <x-select-input name="pay_to">
            <option value="all">All</option>
            <option value="vendor" {{ request('pay_to') === 'vendor' ? 'selected' : '' }}>Vendor</option>
            <option value="other" {{ request('pay_to') === 'other' ? 'selected' : '' }}>Other</option>
          </x-select-input>
        </div>

      </div>
      <input type="hidden" name="is_filter" value="yes">
      <x-happy-button type="submit" class=""> {{ __('Submit') }} </x-happy-button>       
      @if(request('is_filter') === 'yes')
      <x-happy-button type="submit" id="printButton" name="is_print" value="yes" class=""> {{ __('Print') }} </x-happy-button>
      @endif
</form>