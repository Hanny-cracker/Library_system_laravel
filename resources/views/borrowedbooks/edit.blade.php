<x-layout >
    <div class=" text-center mx-auto max-w-2xl lg:mx-0 border-b my-10 border-gray-200">
        <h2 class="text-4xl font-semibold tracking-widest text-pretty text-gray-900 sm:text-5xl">Editing Checked-Out By
        </h2>
        <p class="mt-2 text-lg/8 text-gray-600">{{ $borrowedbook->name }}</p>
    </div> 
<x-borrowedbook action="{{ route('borrowedbook.update',$borrowedbook->id)}}" :borrowedbook="$borrowedbook" :book="$book" text="Save" />
</x-layout>