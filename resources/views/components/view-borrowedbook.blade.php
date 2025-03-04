@props(['borrowedbook'=> '','display'=>true, ])

<div>
    <article class="flex max-w-64 flex-col items-start justify-between rounded-lg border-4 border-double p-3">
        <div class=" gap-x-5 text-xs">
            <div class="group relative">
                <h3 class=" text-base font-semibold">Book Tittle</h3>
                <h4 class=" text-gray-900 text-ms group-hover:text-gray-600">                   
                    {{ $borrowedbook->book->tittle }}                   
                </h4>
                <h3 class=" text-base font-semibold">Quantity</h3>
                <h4 class=" text-gray-900 text-ms group-hover:text-gray-600">
                    {{ $borrowedbook->quantity }}
                </h4>
                <h3 class=" text-base font-semibold">Name</h3>
                <h4 class=" text-gray-900 text-ms group-hover:text-gray-600">
                    {{ $borrowedbook->name }}
                </h4>
                <h3 class=" text-base font-semibold">Address</h3>
                <h4 class=" text-gray-900 text-ms group-hover:text-gray-600">
                    {{ $borrowedbook->address }}
                </h4>
                <h3 class=" text-base font-semibold">Email</h3>
                <h4 class=" text-gray-900 text-ms group-hover:text-gray-600">
                    {{ $borrowedbook->email }}
                </h4>
                <h3 class=" text-base
                    font-semibold">Borrowed At</h3>
                <h4 class=" text-gray
                    -900 text-ms group-hover:text-gray-600">
                    {{ $borrowedbook->borrowed_at }}
                </h4>
                <span @class([ ])>
                    <h3 class="text-base font-semibold">Return Date</h3>
                    <h4 class=" text-gray
                    -900 text-ms group-hover:text-gray-600">
                        {{ $borrowedbook->returned_at }}
                    </h4>
                </span>

                <h3 class="text-base font-semibold">Notes</h3>
                <h4 class=" text-gray
                    -900 text-ms group-hover:text-gray-600">
                    {{ $borrowedbook->notes }}
                </h4>

                <div class=" mt-4 grid grid-cols-3 gap-2 items-center ">

                    <div class="{{ date($borrowedbook->returned_at) < date(now()) ? 'd-block' : 'd-none' }}">
                        <h4 class="bg-red-50 text-red-500 font-bold text-sm p-1">
                            {{ __("Overdue") }}
                    </div>

                </div>

            </div>
            <div class="mt-4 grid grid-cols-4 gap-5 items-center">
                <table class="table-fixed">
                    <tr>
                        <td>
                            <div>
                                <a href="{{ route('borrowedbook.edit', $borrowedbook->id) }}"
                                    class="btn px-3 py-2 text-xs rounded-lg font-medium text-center border-blue-200  hover:bg-blue-200  ">
                                    <span class="">
                                        Edit
                                    </span>
                                </a>
                            </div>
                        </td>
                        <td>
                            <div class="">
                                <a href="{{ route('borrowedbook.return', $borrowedbook->id) }}"
                                    class="btn px-3 py-2 text-xs rounded-lg font-medium text-center border-blue-200  hover:bg-blue-200  ">
                                    <span class="">
                                        Checkin
                                    </span>
                                </a>
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('borrowedbook.delete',$borrowedbook->id)}}" method="POST">
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