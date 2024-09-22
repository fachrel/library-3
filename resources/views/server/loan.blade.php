@extends('layouts.server')
@section('title', 'Loan')

@section('content')
    <div class="mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">
            Peminjaman
        </h2>
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <a href="javascript:;" data-toggle="modal" data-target="#select-user-modal" class="button bg-theme-1 mr-2 text-white shadow-md">Pilih Peminjam</a>
            <div class="modal" id="select-user-modal">
                <div class="modal__content">
                    <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">Pilih Peminjam</h2>
                    </div>
                    <form action="{{ route('loan.select.user') }}" method="post">
                        @csrf
                        <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                            <div class="col-span-12">
                                <label>Nama Peminjam</label>
                                <select name="user" class="input w-full border mt-2">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="px-5 py-3 text-right border-t border-gray-200">
                            <button type="button" class="button w-20 border text-gray-700 mr-1">Batal</button>
                            <button type="submit" class="button w-20 bg-theme-1 text-white">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="pos mt-5 grid grid-cols-12 gap-5">
        <!-- BEGIN: Item List -->
        <div class="col-span-12 lg:col-span-8">
            <div class="lg:flex">
                <div class="relative text-gray-700">
                    <input type="text" class="input input--lg box placeholder-theme-13 w-full pr-10 lg:w-64"
                        placeholder="Search item...">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-search absolute inset-y-0 right-0 my-auto mr-3 h-4 w-4">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <select class="input input--lg box ml-auto mt-3 w-full lg:mt-0 lg:w-auto">
                    <option>Sort By</option>
                    <option>A to Z</option>
                    <option>Z to A</option>
                    <option>Lowest Price</option>
                    <option>Highest Price</option>
                </select>
            </div>
            <div class="border-theme-5 mt-5 grid grid-cols-12 gap-5 border-t pt-5">
                @foreach ($books as $book)
                    <div class="col-span-12 md:col-span-4 xl:col-span-3 box">
                        <div class="p-5">
                            <div class="h-56 xxl:h-56 image-fit" style="height: 300px">
                                <img alt="Midone Tailwind HTML Admin Template" class="rounded-md" src="{{asset('storage/'.$book->photo)}}" >
                            </div>
                            <div class="mt-5">
                                @foreach ($book->categories as $category)
                                    <span class="text-xs px-3 p-1 rounded-md bg-theme-1 text-white mr-1">{{ $category->name }}</span>
                                @endforeach
                            </div>
                            <a href="" class="block font-medium text-base mt-1 truncate">{{ $book->name }}</a>
                            <p class="text-slate-600">{{ $book->author }}</p>
                            <div class="text-slate-600 mt-1">
                                <div class="flex items-center"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="link" data-lucide="link" class="lucide lucide-link w-4 h-4 mr-2"><path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"></path></svg> Penerbit: {{ $book->publisher }} </div>
                                <div class="flex items-center mt-2"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg> Tahun: {{ $book->year }} </div>
                                <div class="flex items-center mt-2"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="layers" data-lucide="layers" class="lucide lucide-layers w-4 h-4 mr-2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg> Stock: {{ $book->quantity - $book->CountBorrowedBook() }}/{{ $book->quantity }} </div>
                            </div>
                        </div>
                        <div class="flex items-center px-5 py-3 border-t border-gray-200">
                            <a href="" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-500 text-gray-600 mr-2 tooltip tooltipstered"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye mx-auto w-5 h-5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                            <a href="{{ route('add.book', $book->id) }}" class="w-10 h-10 flex items-center ml-auto justify-center rounded-full bg-green-600 text-white ml-2 tooltip tooltipstered"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle h-5 w-5 mx-auto"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg> </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- END: Item List -->
        <!-- BEGIN: Ticket -->
        <div class="col-span-12 lg:col-span-4">
            <div class="pr-1">
                <div class="box p-2">
                    <div class="pos__tabs nav-tabs flex justify-center">
                        <a data-toggle="tab" data-target="#ticket"
                            href="javascript:;" class="active flex-1 rounded-md py-2 text-center">Buku
                        </a>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-content__pane active" id="ticket">
                    <div class="pos__ticket box mt-5 p-2">
                        @if(session('cart'))
                            @foreach ( session('cart') as $id => $details )
                                <div class="flex items-center rounded-md bg-white px-3 py-2 transition duration-300 ease-in-out hover:bg-gray-200">
                                    <div class="flex-1">
                                        <div class="pos__ticket__item-name mr-1 truncate">{{$details['name']}}</div>
                                        <span class="block text-sm text-gray-600">{{$details['author']}}</span>
                                    </div>
                                    <div class="ml-auto">
                                        <a href="{{ route('remove.book', $details['id']) }}"><svg class="text-theme-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-6 h-6 mx-auto"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                                    </div>
                                </div>
                            @endforeach

                        @else
                            <div class="flex items-center rounded-md bg-white p-3 transition duration-300 ease-in-out hover:bg-gray-200">
                                <div class="pos__ticket__item-name mr-1 truncate">Tidak ada buku.</div>
                                {{-- <div class="ml-auto">
                                    <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-6 h-6 mx-auto"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                                </div> --}}
                            </div>
                        @endif
                    </div>
                    <div class="box mt-5 p-5">
                        <div class="">
                            <div class="mr-auto">
                                Peminjam :
                                @if (session('selectedUser'))
                                    @php $selectedUser = session('selectedUser') @endphp
                                    {{ $selectedUser['username'] }}
                                @else
                                <span class="text-theme-6">Belum dipilih</span>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="box mt-5 p-5">
                        <div class="mt-4 flex">
                            <div class="mr-auto">Dikembalikan Sebelum</div>
                            <div>{{ now()->addDays(7)->format('Y-m-d') }}</div>
                        </div>
                        <div class="mt-4 flex border-t border-gray-200 pt-4">
                            <div class="mr-auto text-base font-medium">Total Buku : </div>
                            <div class="text-base font-medium">{{ count((array) session('cart')) }}</div>
                        </div>
                    </div>
                    <div class="mt-5 flex">
                        <a href="{{ route('remove.all.books') }}" type="button" class="button w-32 border border-gray-400 text-gray-600">Hapus Buku</a>
                        <a href="{{ route('borrow.book') }}" type="button" class="button bg-theme-1 ml-auto w-32 text-white shadow-md">Pinjam</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Ticket -->
    </div>
@endsection
