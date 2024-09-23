@extends('layouts.client')
@section('title', 'Book detail')

@section('content')
    <div class="intro-y grid grid-cols-11 gap-5 mt-5 mx-56">
        <div class="col-span-12 lg:col-span-3">
            <div class="box p-5 rounded-md">
                <div class="h-56 xxl:h-56 image-fit" style="height: 450px">
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
            {{-- <div class="box p-5 rounded-md mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">Detail Peminjam</div>
                </div>
                <div class="flex items-center"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="clipboard" data-lucide="clipboard" class="lucide lucide-clipboard w-4 h-4 text-slate-500 mr-2"><path d="M16 4h2a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg> Nama : <a href="" class="underline decoration-dotted ml-1"></a> </div>
                <div class="flex items-center mt-3"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="calendar" data-lucide="calendar" class="lucide lucide-calendar w-4 h-4 text-slate-500 mr-2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Email :</div>
                <div class="flex items-center mt-3"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="map-pin" data-lucide="map-pin" class="lucide lucide-map-pin w-4 h-4 text-slate-500 mr-2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"></path><circle cx="12" cy="10" r="3"></circle></svg> Alamat :   </div>
            </div> --}}

        </div>
        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            <div class="intro-y news p-5 box">
                <!-- BEGIN: Comments -->
                <div class="intro-y mt-2 flex">
                    <div class="text-base sm:text-lg font-medium">2 Review</div>
                    @if ($book->isBookReturned(Auth::user()->id))
                        <a href="javascript:;" data-toggle="modal" data-target="#add-review-modal" class="button inline-block bg-theme-1 ml-auto text-white">Review</a>
                    @elseif ()
                </div>

                    <div class="modal" id="add-review-modal">
                        <div class="modal__content">
                            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                                <h2 class="font-medium text-base mr-auto">Review {{ $book->name }}</h2>
                            </div>
                            <form action="{{ route('add.review', $book->id) }}" method="post">
                                @csrf
                                <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                                    <div class="col-span-12">
                                        <label>Rating</label>
                                        <select name="rating" class="input w-full border mt-2">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        <div class="col-span-12 mt-2">
                                            <label>Komentar</label>
                                            <input type="text" name="comment" class="input w-full border mt-2" placeholder="Buku bagus">
                                        </div>
                                    </div>
                                </div>
                                <div class="px-5 py-3 text-right border-t border-gray-200">
                                    <button type="button" class="button w-20 border text-gray-700 mr-1">Batal</button>
                                    <button type="submit" class="button w-20 bg-theme-1 text-white">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <div class="intro-y mt-5 pb-10">
                    @if ($book->isBookReturned(Auth::user()->id))
                        <div class="pt-5">
                            <div class="flex">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 flex-none image-fit">
                                    <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{asset('Midone/Compiled/dist/images/profile-12.jpg')}}">
                                </div>
                                <div class="ml-3 flex-1">
                                    Review Saya
                                    <div class="text-slate-500 text-xs sm:text-sm">
                                        <div class="flex items-center">
                                            <div class="flex items-center">
                                                @for ($i = 0; $book->userReview()->rating > $i; $i++ )
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-500 w-4 h-4 mr-1"><polygon fill="#fde047" points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                @endfor

                                                @for ($i = 0; 5 - $book->userReview()->rating > $i; $i++ )
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="star" data-lucide="star" class="lucide lucide-star text-slate-400 fill-slate/30 w-4 h-4 mr-1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg> </div>
                                                @endfor

                                            <div class="text-xs text-slate-500 ml-1">({{$book->userReview()->rating }}.0)</div>
                                        </div>
                                    </div>
                                    <div class="mt-2">{{ $book->userReview()->comment }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="mt-5 pt-5 border-t border-slate-200/60 dark:border-darkmode-400">
                        <div class="flex">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 flex-none image-fit">
                                <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{asset('Midone/Compiled/dist/images/profile-12.jpg')}}">
                            </div>
                            <div class="ml-3 flex-1">
                                <div class="text-slate-500 text-xs sm:text-sm">45 seconds ago</div>
                                <div class="mt-2">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 pt-5 border-t border-slate-200/60 dark:border-darkmode-400">
                        <div class="flex">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 flex-none image-fit">
                                <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{asset('Midone/Compiled/dist/images/profile-12.jpg')}}">
                            </div>
                            <div class="ml-3 flex-1">
                                <div class="text-slate-500 text-xs sm:text-sm">45 seconds ago</div>
                                <div class="mt-2">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 pt-5 border-t border-slate-200/60 dark:border-darkmode-400">
                        <div class="flex">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 flex-none image-fit">
                                <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{asset('Midone/Compiled/dist/images/profile-12.jpg')}}">
                            </div>
                            <div class="ml-3 flex-1">
                                <div class="text-slate-500 text-xs sm:text-sm">45 seconds ago</div>
                                <div class="mt-2">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 pt-5 border-t border-slate-200/60 dark:border-darkmode-400">
                        <div class="flex">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 flex-none image-fit">
                                <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{asset('Midone/Compiled/dist/images/profile-12.jpg')}}">
                            </div>
                            <div class="ml-3 flex-1">
                                <div class="text-slate-500 text-xs sm:text-sm">45 seconds ago</div>
                                <div class="mt-2">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 pt-5 border-t border-slate-200/60 dark:border-darkmode-400">
                        <div class="flex">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 flex-none image-fit">
                                <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{asset('Midone/Compiled/dist/images/profile-12.jpg')}}">
                            </div>
                            <div class="ml-3 flex-1">
                                <div class="text-slate-500 text-xs sm:text-sm">45 seconds ago</div>
                                <div class="mt-2">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Comments -->
            </div>
        </div>
    </div>
@endsection
