@extends('layouts.header')

@section('title', 'Sidebar')

@section('content')
<nav class="fixed top-0 md:z-40 z-30 w-full bg-gray-200 dark:bg-primary border-b-2 border-purple dark:border-secondary">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-purple">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
         <div href="#" class="flex ml-2 md:mr-24">
          <span class="self-center text-xl md:ml-12 font-semibold sm:text-2xl whitespace-nowrap text-primary dark:text-purple">Sistem Pendukung Keputusan - WASPAS</span>
         </div>
      </div>
      <div class="flex items-center">
        <div class="flex items-center ml-3">
          <div class="my-5">
            
          </div>
          
        </div>
      </div>
    </div>
  </div>
</nav>

  <aside id="logo-sidebar" class="fixed top-0 left-0 md:z-30 z-40 w-64 h-screen pt-16 transition-transform -translate-x-full bg-gray-100 dark:bg-primary border-r-2 border-purple dark:border-secondary sm:translate-x-0" aria-label="Sidebar">
     <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-100 dark:bg-primary">
        <ul class="space-y-2 font-normal mt-4 md:font-medium text-sm md:text-lg">
           @yield('list-menu')
        </ul>
     </div>
  </aside>

  <div class="p-4 sm:ml-64">
    @yield('main')
 </div>
</div>

@endsection