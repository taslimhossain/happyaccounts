@php
  $menuItems = [
  'dashboard' => array(
    'name'   => 'Dashboard',
    'slug'   => 'dashboard',
    'access' => 'admin',
    'icon'   => '<svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" > <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" ></path> </svg>',
  ),
  'report' => array(
      'name'   => 'Report',
      'slug'   => 'expenses.index',
      'access' => 'admin',
      'icon'   => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" /></svg>',
      'sub_mennu' => array(
          'bank_transaction' => array( 'name'   => 'Bank transaction', 'slug'   => 'report.bank-transaction', 'access' => 'admin'),
          'office_transaction' => array( 'name'   => 'Office transaction', 'slug'   => 'report.office-transaction', 'access' => 'admin'),
          'project_transaction' => array( 'name'   => 'Project transaction', 'slug'   => 'report.project-transaction', 'access' => 'admin'),
          'vendor_transaction' => array( 'name'   => 'Vendor transaction', 'slug'   => 'report.vendor-transaction', 'access' => 'admin'),
          'client_transaction' => array( 'name'   => 'Client transaction', 'slug'   => 'report.client-transaction', 'access' => 'admin'),
          'staff_transaction' => array( 'name'   => 'Staff transaction', 'slug'   => 'report.staff-transaction', 'access' => 'admin'),
      )
    ),
    'banking' => array(
      'name'   => 'Banking',
      'slug'   => 'banking.index',
      'access' => 'admin',
      'icon'   => '<svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" ><path strokeLinecap="round" strokeLinejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>',
      'sub_mennu' => array(
          'index'  => array( 'name'   => 'Bank list', 'slug'   => 'banking.index', 'access' => 'admin'),
          'create' => array( 'name'   => 'Add bank account', 'slug'   => 'banking.create', 'access' => 'admin'),
          'new_deposit' => array( 'name'   => 'New deposit', 'slug'   => 'banking.deposit-transaction.create', 'access' => 'admin'),
          'new_withdraw' => array( 'name'   => 'New withdraw', 'slug'   => 'banking.withdraw-transaction.create', 'access' => 'admin'),
          'create_transfer' => array( 'name'   => 'Create transfer', 'slug'   => 'banking.transfer-transaction.create', 'access' => 'admin'),
          'transaction_list' => array( 'name'   => 'Transaction list', 'slug'   => 'banking.deposit-transaction-list', 'access' => 'admin'),
      )
    ),
    'project' => array(
      'name'   => 'Projects',
      'slug'   => 'project.index',
      'access' => 'admin',
      'icon'   => '<svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" ><path strokeLinecap="round" strokeLinejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>',
      'sub_mennu' => array(
          'index'              => array( 'name'   => 'Project list', 'slug'   => 'project.index', 'access' => 'admin'),
          'create'             => array( 'name'   => 'Add new project', 'slug'   => 'project.create', 'access' => 'admin'),
          'transaction'        => array( 'name'   => 'Transaction', 'slug'   => 'project.transaction', 'access' => 'admin'),
          'expenses_categorie' => array( 'name'   => 'Expenses Categories', 'slug'   => 'project.expenses_categorie', 'access' => 'admin'),
      )
    ),
    'client' => array(
      'name'   => 'Client',
      'slug'   => 'client.index',
      'access' => 'admin',
      'icon'   => '<svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" ><path strokeLinecap="round" strokeLinejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>',
      // 'sub_mennu' => array(
      //     'index'  => array( 'name'   => 'Client list', 'slug'   => 'client.index', 'access' => 'admin'),
      //     'create' => array( 'name'   => 'Add new client', 'slug'   => 'client.create', 'access' => 'admin')
      // )
    ),
    'staff' => array(
      'name'   => 'Staff',
      'slug'   => 'staff.index',
      'access' => 'admin',
      'icon'   => '<svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" ><path strokeLinecap="round" strokeLinejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>',
      // 'sub_mennu' => array(
      //     'index'  => array( 'name'   => 'Client list', 'slug'   => 'client.index', 'access' => 'admin'),
      //     'create' => array( 'name'   => 'Add new client', 'slug'   => 'client.create', 'access' => 'admin')
      // )
    ),
    'vendor' => array(
      'name'   => 'Vendor',
      'slug'   => 'vendor.index',
      'access' => 'admin',
      'icon'   => '<svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" ><path strokeLinecap="round" strokeLinejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>',
      // 'sub_mennu' => array(
      //     'index'  => array( 'name'   => 'Client list', 'slug'   => 'client.index', 'access' => 'admin'),
      //     'create' => array( 'name'   => 'Add new client', 'slug'   => 'client.create', 'access' => 'admin')
      // )
    ),
    'expenses' => array(
      'name'   => 'Expenses',
      'slug'   => 'expenses.index',
      'access' => 'admin',
      'icon'   => '<svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0112 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5" /></svg>',
      'sub_mennu' => array(
          'office' => array( 'name'   => 'Office transaction', 'slug'   => 'expenses.index', 'access' => 'admin'),
          'salary' => array( 'name'   => 'Salary transaction', 'slug'   => 'expenses.salary.index', 'access' => 'admin'),
          'expenses_categories' => array( 'name'   => 'Expenses Categories', 'slug'   => 'expenses.office-categorie.list', 'access' => 'admin')
      )
    ),

  ];
@endphp
      
      
      <!-- Desktop sidebar -->
      <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0" >
        <div class="py-4 text-gray-500 dark:text-gray-400">
          <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="{{ route('admin') }}">{{ config('app.name', 'Happy Accountss') }}</a>
          <ul class="mt-6">
              @foreach ($menuItems as $key => $value)
                 @php
                 $keyw = 'expenses';
                 $page_slug = $value['slug'] ? $value['slug'] : 'dashboard' ;
                 $toggle = isset($value['slug']) ? 'toggle_'.str_replace(".", "_", $value['slug']) : '';
                 $is_toggle = isset($value['slug']) ? 'is_'.str_replace(".", "_", $value['slug']) : '';
                 @endphp
                 @if(isset($value['sub_mennu']) && is_array($value['sub_mennu']) && count($value['sub_mennu']) != 0)
                    <li class="relative px-6 py-3" x-data="{ {{$is_toggle}}: {{ (request()->routeIs($page_slug) ?? 1 ) || preg_match('/^'.$key.'\..*$/', Route::currentRouteName()) ? "true" : "false" }} }">
                      <x-sidebar-link :id="$is_toggle" :active="( request()->routeIs($page_slug) || preg_match('/^'.$key.'\..*$/', Route::currentRouteName()) )">
                        <x-slot name="icon">
                            {!! $value['icon'] !!}
                        </x-slot>
                        {{ $value['name'] }} <br>
                      </x-sidebar-link>
                      <template x-if="{{$is_toggle}}">
                        <ul x-transition:enter="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl" x-transition:leave="transition-all ease-in-out duration-300" x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0" class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900" aria-label="submenu">
                          @foreach($value['sub_mennu'] as $sub_key => $sub_value)
                          <x-sidebar-link href="{{ route( $sub_value['slug'] ) }}" :active="request()->routeIs($sub_value['slug'])">
                            {{ $sub_value['name'] }}
                          </x-sidebar-link>
                          @endforeach
                        </ul>
                      </template>
                    </li>
                  @else
                    <li class="relative px-6 py-3">
                      <x-sidebar-link href="{{ route( $page_slug ) }}" :active="( request()->routeIs($page_slug) || preg_match('/^'.$key.'\..*$/', Route::currentRouteName()) )">
                        <x-slot name="icon">
                            {!! $value['icon'] !!}
                        </x-slot>
                        {{ $value['name'] }}
                      </x-sidebar-link>
                    </li> 
                  @endif
              @endforeach
          </ul>
          {{-- <ul>
            <li class="relative px-6 py-3">
              <button
                class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" @click="togglePagesMenu" aria-haspopup="true">
                <span class="inline-flex items-center">
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
                    ></path>
                  </svg>
                  <span class="ml-4">Pages</span>
                </span>
                <svg
                  class="w-4 h-4"
                  aria-hidden="true"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </button>
              <template x-if="isPagesMenuOpen">
                <ul
                  x-transition:enter="transition-all ease-in-out duration-300"
                  x-transition:enter-start="opacity-25 max-h-0"
                  x-transition:enter-end="opacity-100 max-h-xl"
                  x-transition:leave="transition-all ease-in-out duration-300"
                  x-transition:leave-start="opacity-100 max-h-xl"
                  x-transition:leave-end="opacity-0 max-h-0"
                  class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                  aria-label="submenu"
                >
                  <li
                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  >
                    <a class="w-full" href="pages/login.html">Login</a>
                  </li>
                  <li
                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  >
                    <a class="w-full" href="pages/create-account.html">
                      Create account
                    </a>
                  </li>
                  <li
                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  >
                    <a class="w-full" href="pages/forgot-password.html">
                      Forgot password
                    </a>
                  </li>
                  <li
                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  >
                    <a class="w-full" href="pages/404.html">404</a>
                  </li>
                  <li
                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  >
                    <a class="w-full" href="pages/blank.html">Blank</a>
                  </li>
                </ul>
              </template>
            </li>
          </ul>
          <div class="px-6 my-6">
            <button
              class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-indigo-600 border border-transparent rounded-lg active:bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:shadow-outline-purple"
            >
              Create account
              <span class="ml-2" aria-hidden="true">+</span>
            </button>
          </div> --}}
        </div>
      </aside>