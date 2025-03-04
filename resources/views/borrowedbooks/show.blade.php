<x-layout>
    <div class="bg-white flex justify-center">
        <div class="px-6 lg:px-8">
            <div class=" text-center mx-auto max-w-2xl lg:mx-0 border-b mt-10 border-gray-200">
                <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">Book by
                </h2>
                <p class="mt-2 text-lg/8 text-gray-600"> {{$borrowedbook->book->tittle}}</p>
            </div>
            <div class="  border-t border-gray-200 pt-10 sm:mt-1 sm:pt-16 lg:mx-0 lg:max-w-none ">
                <x-view-borrowedbook :borrowedbook="$borrowedbook"  :display="false"/>
                <div class="flex w-full justify-end py-1.5 float-right">                   
                        <button>
                            <a href="{{ route('borrowedbooks') }}"
                                class="px-4 py-2 text-gray-900  rounded-full select-none hover:bg-gray-900/10 "
                                type="button">
                                Close
                            </a>
                        </button>
                </div>
            </div>
        </div>
    </div>
</x-layout>