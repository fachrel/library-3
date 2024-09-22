@extends('layouts.server')
@section('title', 'Books')

@section('content')
<h2 class="intro-y text-lg font-medium mt-10">
    List Buku
</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <div class="text-center"> <a href="javascript:;" data-toggle="modal" data-target="#create-book-modal" class="button inline-block bg-theme-1 text-white">Tambahkan Buku</a> </div>
        <div class="modal" id="create-book-modal">
            <div class="modal__content">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">Tambahkan Buku</h2>
                </div>
                <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                        <div class="col-span-12">
                            <label>Nama Buku</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="input w-full border mt-2" placeholder="Malioboro at Midnight">
                        </div>
                        <div class="col-span-12">
                            <label>Nama Penulis</label>
                            <input type="text" name="author" value="{{ old('author') }}" class="input w-full border mt-2" placeholder="Skysphire">
                        </div>
                        <div class="col-span-12">
                            <label>Nama Penerbit</label>
                            <input type="text" name="publisher" value="{{ old('publisher') }}" class="input w-full border mt-2" placeholder="Bukune">
                        </div>
                        <div class="col-span-12 lg:col-span-6">
                            <label>Tahun Rilis</label>
                            <input type="text" name="year" value="{{ old('year') }}" class="input w-full border mt-2" placeholder="2022">
                        </div>
                        <div class="col-span-12 lg:col-span-6">
                            <label>Jumlah Buku</label>
                            <input type="number" name="quantity" value="{{ old('quantity') }}" class="input w-full border mt-2" placeholder="5">
                        </div>
                        <div class="col-span-12">
                            <label class="mb-2">Kategori</label>
                            <select data-placeholder="Pilih Kategori" class="select2 w-full mt-2" multiple name="categories[]">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-12 w-full">
                            <label>Upload Cover</label>
                            <input type="file" name="photo" class="input w-full border mt-2">
                        </div>
                    </div>
                    <div class="px-5 py-3 text-right border-t border-gray-200">
                        <button type="button" class="button w-20 border text-gray-700 mr-1">Batal</button>
                        <button type="submit" class="button w-20 bg-theme-1 text-white">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="hidden md:block mx-auto text-gray-600">Showing 1 to 10 of 150 entries</div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-56 relative text-gray-700">
                <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </div>
        </div>
    </div>
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 lg:col-span-8">
        <div class="border-theme-5 mt-5 grid grid-cols-12 gap-5 border-t pt-5">
            @foreach ($books as $book)
                <div class="intro-y col-span-12 md:col-span-4 xl:col-span-3 box">
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
                        <a href="" class="intro-x w-10 h-10 flex items-center justify-center rounded-full border border-gray-500 text-gray-600 mr-2 tooltip tooltipstered"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye mx-auto w-5 h-5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                        <a href="javascript:;" data-toggle="modal" data-target="#edit-book-modal-{{ $book->id }}" class="intro-x w-10 h-10 flex items-center justify-center rounded-full bg-yellow-400 text-gray-600 ml-auto tooltip tooltipstered"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-5 h-5 mx-auto"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg> </a>
                        <a href="javascript:;" data-toggle="modal" data-target="#delete-book-modal-{{ $book->id }}" class="intro-x w-10 h-10 flex items-center justify-center rounded-full bg-red-600 text-white ml-2 tooltip tooltipstered"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-5 h-5 mx-auto"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> </a>
                    </div>
                    <div class="modal" id="delete-book-modal-{{ $book->id }}">
                        <div class="modal__content">
                            <div class="p-5 text-center"> <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                                <div class="text-3xl mt-5">Are you sure?</div>
                                <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot be undone.</div>
                            </div>
                            <div class="px-5 pb-8 text-center flex justify-center">
                                <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                                <form action="{{ route('books.destroy',$book->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="button w-24 bg-theme-6 text-white">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal" id="edit-book-modal-{{$book->id}}">
                        <div class="modal__content">
                            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                                <h2 class="font-medium text-base mr-auto">Edit Buku</h2>
                            </div>
                            <form action="{{ route('books.update', $book->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                                    <div class="col-span-12">
                                        <label>Nama Buku</label>
                                        <input type="text" name="name" value="{{ $book->name }}" class="input w-full border mt-2" placeholder="Malioboro at Midnight">
                                    </div>
                                    <div class="col-span-12">
                                        <label>Nama Penulis</label>
                                        <input type="text" name="author" value="{{ $book->author }}" class="input w-full border mt-2" placeholder="Skysphire">
                                    </div>
                                    <div class="col-span-12">
                                        <label>Nama Penerbit</label>
                                        <input type="text" name="publisher" value="{{ $book->publisher }}" class="input w-full border mt-2" placeholder="Bukune">
                                    </div>
                                    <div class="col-span-12 lg:col-span-6">
                                        <label>Tahun Rilis</label>
                                        <input type="text" name="year" value="{{ $book->year }}" class="input w-full border mt-2" placeholder="2022">
                                    </div>
                                    <div class="col-span-12 lg:col-span-6">
                                        <label>Jumlah Buku</label>
                                        <input type="number" name="quantity" value="{{ $book->quantity }}" class="input w-full border mt-2" placeholder="5">
                                    </div>
                                    <div class="col-span-12">
                                        <label class="mb-2">Kategori</label>
                                        <select data-placeholder="Pilih Kategori" class="select2 w-full mt-2" multiple name="categories[]">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $book->categories->contains($category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-span-12 w-full">
                                        <label>Upload Cover</label>
                                        <input type="file" name="photo" value="{{ $book->image }}" class="input w-full border mt-2">
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
            @endforeach
        </div>
    </div>
    <!-- END: Data List -->
    {{-- <!-- BEGIN: Pagination -->
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
        <ul class="pagination">
            <li>
                <a class="pagination__link" href=""> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left w-4 h-4"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg> </a>
            </li>
            <li>
                <a class="pagination__link" href=""> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left w-4 h-4"><polyline points="15 18 9 12 15 6"></polyline></svg> </a>
            </li>
            <li> <a class="pagination__link" href="">...</a> </li>
            <li> <a class="pagination__link" href="">1</a> </li>
            <li> <a class="pagination__link pagination__link--active" href="">2</a> </li>
            <li> <a class="pagination__link" href="">3</a> </li>
            <li> <a class="pagination__link" href="">...</a> </li>
            <li>
                <a class="pagination__link" href=""> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right w-4 h-4"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
            </li>
            <li>
                <a class="pagination__link" href=""> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right w-4 h-4"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg> </a>
            </li>
        </ul>
        <select class="w-20 input box mt-3 sm:mt-0">
            <option>10</option>
            <option>25</option>
            <option>35</option>
            <option>50</option>
        </select>
    </div>
    <!-- END: Pagination --> --}}
</div>

@endsection
