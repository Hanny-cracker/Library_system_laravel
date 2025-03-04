@props(['book'=> '', 'display'=> 'd-none','show'=> 'd-none'])

<div>
    <article class="flex max-w-64 flex-col items-start justify-between rounded-lg border-4 border-double p-3">
        <div class=" gap-x-5 text-xs">
            <div class="group relative">
                <h3 class=" text-base font-semibold">Tittle</h3>
                <h4 class=" text-gray-900 text-ms group-hover:text-gray-600">
                    <a href="{{ route('book.show', $book->slug) }}">
                        <span class="absolute inset-0"></span>
                        {{ $book->tittle }}
                    </a>
                </h4>
                <h3 class=" text-base font-semibold">Author</h3>
                <h4 class=" text-gray-900 text-ms group-hover:text-gray-600">
                    {{ $book->author }}
                </h4>
                <h3 class=" text-base font-semibold">Publisher</h3>
                <h4 class=" text-gray-900 text-ms group-hover:text-gray-600">
                    {{ $book->publisher }}
                </h4>
                <h3 class=" text-base
                    font-semibold">Pages</h3>
                <h4 class=" text-gray
                    -900 text-ms group-hover:text-gray-600">
                    {{ $book->pages }}
                </h4>
                <h3 class=" text-base
                    font-semibold">Published Date</h3>
                <h4 class=" text-gray
                    -900 text-ms group-hover:text-gray-600">
                    {{ $book->published_at }}
                </h4>
                <span @class([ $display])>
                    <h3 class="text-base font-semibold">Description</h3>
                    <h4 class=" text-gray
                    -900 text-ms group-hover:text-gray-600">
                        {{ $book->description }}
                    </h4>
                </span>
                <div class=" mt-4 grid grid-cols-3 gap-2 items-center ">
                    <div>
                        <h3 class=" text-base
                    font-semibold"> Qty</h3>
                        <h4 class=" text-gray
                    -900 text-ms group-hover:text-gray-600">
                            {{ $book->quantity }}
                        </h4>
                    </div>

                    <div>
                        <h3 class=" text-base
                    font-semibold">Avl</h3>
                        <h4 class=" text-gray
                    -900 text-ms group-hover:text-gray-600">
                            {{ $book->available }}
                        </h4>
                    </div>

                    <div>
                        <h4
                            class=" {{ $book->status === 'Available'? 'bg-green-50 text-green-500 font-bold':'bg-red-50 text-red-500 font-bold'  }} text-sm p-1">
                            {{ $book->status }}
                    </div>

                </div>

            </div>
            <div class="mt-4 grid grid-cols-4 gap-5 items-center">
                <table class="table-fixed">
                    <tr>
                        <td>
                            <div @class([ $display])>
                                <a href="{{ route('book.edit', $book->slug) }}"
                                    class="btn px-3 py-2 text-xs rounded-lg font-medium text-center border-blue-200  hover:bg-blue-200  ">
                                    <span class="">
                                        Edit
                                    </span>
                                </a>
                            </div>
                        </td>
                        <td>
                            <div class="{{ $book->status == 'Available' ? 'block' : 'hidden' }}">
                                <a href="{{ route('borrowedbook.create', $book->slug) }}"
                                    class="btn px-3 py-2 text-xs rounded-lg font-medium text-center border-blue-200  hover:bg-blue-200  ">
                                    <span class="">
                                        Checkout
                                    </span>
                                </a>
                            </div>
                        </td>
                        <td>
                            <form @class([$show]) action="{{ route('book.delete',$book->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mt-2 ml-9 text-red-500 btn">
                                    <span class="material-symbols-outlined">
                                        delete
                                    </span>
                                </button>
                            </form>
                        </td>
                    </tr>
                </table>



            </div>
        </div>
    </article>
</div>