<x-layout>
    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="text-4xl font-semibold text-pretty text-gray-900 sm:text-5xl tracking-widest">Welcome To Your
                    Library
                </h2>
                <p class="mt-2 text-lg/8 text-gray-600">Keeping your Books organized is the key.</p>

                @guest
                @else
                <div class="mt-5 grid gap-4 grid-cols-3">

                    <button>
                        <a href="{{route('books')}}"
                            class="mt-6 inline-block bg-black px-4 py-2 text-sm/6 font-semibold text-white  hover:bg-pretty-dark rounded-lg">My Books</a>
                    </button>
                    <button>
                        <a href="{{route('book.create')}}"
                            class="mt-6 inline-block bg-black px-4 py-2 text-sm/6 font-semibold text-white  hover:bg-pretty-dark rounded-lg">Add a Book</a>
                    </button>
                    <button>
                        <a href="{{route('borrowedbooks')}}"
                            class="mt-6 inline-block bg-black px-4 py-2 text-sm/6 font-semibold text-white  hover:bg-pretty-dark rounded-lg">Checked-Out Books</a>
                    </button>
                </div>
                @endguest
            </div>
        </div>
    </div>

</x-layout>