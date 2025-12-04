<x-app-layout>

  <x-slot name="header">

    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        
      {{ __('Dashboard') }}

    </h2>

  </x-slot>

  <div class="py-12">

    <!-- margin-wrapper -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        
        <div class="p-6 text-gray-900 dark:text-gray-100">
            
          <form
            id="submitForm"
            action="{{ route("taskapi.store") }}"
            method="post">

            @csrf

            <div class="space-y-12">

              <div class="col-span-full">

                <label
                  for="about"
                  class="block text-sm/6 font-medium text-white"
                  >{{ __("Task Body") }}</label>

                <div class="mt-2">

                  <textarea
                    id="body"
                    name="body"
                    rows="3"
                    class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
                    ></textarea>
                
                </div>
              
              </div>
            
            </div>

            <div class="sm:col-span-3 mt-4">

              <label
                for="country"
                class="block text-sm/6 font-medium text-white"
                >{{ __('Status') }}</label>

              <div class="mt-2 grid grid-cols-1">

                <select
                  id="status"
                  name="status"
                  class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white/5 py-1.5 pr-8 pl-3 text-base text-white outline-1 -outline-offset-1 outline-white/10 *:bg-gray-800 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6">
                  
                  @foreach ($statusOptions as $key => $case)

                    <option value="{{ $case->value }}">{{ ucfirst(__($case->value)) }}</option>
                  
                  @endforeach

                </select>

              </div>

            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
              
              <button
                form="submitForm"
                type="submit"
                class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
                >{{ __('Save') }}</button>
            
            </div>

          </form>

          @if (session()->exists('success'))

            {{-- https://tailwindcss.com/docs/colors --}}

            <div class="mt-4">

              <h4 class="text-green-500">{{ session('success') }}</h4>

            </div>
          
          @endif

        </div>

      </div>

      <div class="mt-4">

        @foreach ($tasks as $key => $task)

          <div class="my-1 rounded {{ $task->tailwindColor }}">
          
            <span class="px-1">{{ __("$task->body") }}</span>

          </div>

        @endforeach

      </div>

    </div> <!-- /margin-wrapper -->

  </div>

</x-app-layout>
