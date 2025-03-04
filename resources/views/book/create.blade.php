<x-layout >
    <div class=" text-center  mx-auto tracking-widest max-w-2xl lg:mx-0 border-b my-10 border-gray-200">
        <h2 class="text-4xl font-semibold  text-pretty text-gray-900 sm:text-5xl">Adding a New Book !!
        </h2>
        <p class="mt-2 text-lg/8 text-gray-600">{{ __('Reading is FUN!!!!') }}</p>
    </div> 
<x-book action="{{ route('book.store')}}" :status="$status" text="Add Book" />
</x-layout>