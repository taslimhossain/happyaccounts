@props(['show' => false, 'status' => true])

@if ($show)
<div id="toast" class="fixed right-5 bottom-5 w-80">
    <div class="animate-bottom bg-white dark:bg-gray-800 mb-8 px-4 py-3 rounded-lg shadow-md w-80 border border-gray-200 dark:border-gray-800">
            <div class="flex items-center bg-white rounded-lg shadow-xs dark:bg-gray-800">
                @if($status)
                <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 animate-ping">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg> 
                </div>
                <div>
                    <p class="text-md font-semibold text-gray-700 dark:text-gray-200"> Success</p>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        {{$slot}}
                    </p>
                </div>
                @else
                <div class="p-3 mr-4 text-red-500 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 animate-ping"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>                      
                </div>
                <div>
                    <p class="text-md font-semibold text-gray-700 dark:text-gray-200"> Error !</p>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        {{$slot}}
                    </p>
                </div>                
                @endif
        </div>
        <span id="close-toast" class="cursor-pointer absolute right-2 top-2"><svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg></span>
    </div>
</div>
<script>
    const toast = document.getElementById('toast');
    const closeToast = document.getElementById('close-toast');
    @if($status)
    const closeTimeout = setTimeout(() => {
        toast.classList.add('hidden');
    }, 6000);

    closeToast.addEventListener('click', () => {
        clearTimeout(closeTimeout);
        toast.classList.add('hidden');
    });
    @else
    closeToast.addEventListener('click', () => {
        toast.classList.add('hidden');
    });
    @endif
</script>
@endif