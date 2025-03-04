<x-layout>
    <div class="bg-white py-20 sm:py-30">
        <div class="mx-auto max-w-7xl px-3 lg:px-8">
            <div class="pb-5 text-center mx-auto max-w-2xl lg:mx-0  border-b border-gray-200">
                <h2 class="text-4xl font-semibold tracking-widest text-pretty text-gray-900 sm:text-5xl">My Books
                </h2>
                <div class="flex justify-center gap-3">
                    <button>
                        <a href="{{route('book.create')}}"
                            class="mt-6 inline-block bg-slate-800 px-4 py-2 text-sm/6 font-semibold text-white  hover:bg-slate-500 rounded-lg">Add
                            a Book</a>
                    </button>
                    <button>
                        <a href="{{route('borrowedbooks')}}"
                            class="mt-6 inline-block bg-black px-4 py-2 text-sm/6 font-semibold text-white  hover:bg-pretty-dark rounded-lg">Checked-Out Books</a>
                    </button>
                </div>

                <form class="flex justify-center mt-6 max-w-md mx-auto" action="{{route('book.search')}}" method="GET">
                    <div class=" flex justify-center w-full max-w-sm min-w-[200px]">
                        <div class="relative">
                            <input
                                class=" w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                placeholder="Search by Tittel, Author..." name="search" id="search"
                                value="{{isset($search) ? $search : ""}}" />
                            @if(!$search)
                            <button
                                class="absolute top-1 right-1 flex items-center rounded bg-slate-800 py-1 px-2.5 border border-transparent text-center text-sm text-white transition-all shadow-sm hover:shadow focus:bg-slate-200 focus:shadow-none active:bg-slate-700 hover:bg-slate-500 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-4 h-4 mr-2">
                                    <path fill-rule="evenodd"
                                        d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
                                        clip-rule="evenodd" />
                                </svg>

                                Search
                            </button>
                            @else
                            <button
                                class="absolute top-1 right-1 flex items-center rounded bg-slate-800 py-1 px-2.5 border border-transparent text-center text-sm text-white transition-all shadow-sm hover:shadow focus:bg-slate-200 focus:shadow-none active:bg-slate-700 hover:bg-slate-500 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                <a href="{{route('books')}}">Clear</a>
                            </button>
                            @endif
                        </div>
                    </div>
                </form>

            </div>
            @if(!$books->count())
            <div
                class="mx-auto mt-5 grid max-w-2xl grid-cols-4 gap-x-12 gap-y-12 sm:mt-16 sm:pt-1 lg:mx-0 lg:max-w-none lg:grid-cols-4">
                <div class="col-span-4">
                    <div class="flex items  justify-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 2a8 8 0 100 16 8 8 0 000-16zM8 12a2 2 0 114 0 2 2 0 01-4 0zm1-9a1 1 0 112 0 1 1 0 01-2 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="mt-2 text-sm/6 text-gray-600">No books found</p>
                            @else
                            <div
                                class="mx-auto mt-5 grid max-w-2xl grid-cols-1 gap-x-12 gap-y-12 sm:mt-16 sm:pt-1 lg:mx-0 lg:max-w-none lg:grid-cols-4">
                                @foreach($books as $book)
                                <x-view-book :book="$book" text="Check Out" show="d-block" display='d-none' />
                                @endforeach
                            </div>
                            @endif
                            <!-- More posts... -->
                            <div class="justify-self-right col-span-3 mt-20">
                                {{ $books->links() }}
                            </div>
                        </div>
                    </div>
</x-layout>