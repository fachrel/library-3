@extends('layouts.client')
@section('title', 'My Book')

@section('content')
    <div class="content px-10">
        <div class="intro-y col-span-12 lg:col-span-8 mt-5">
            <div class="intro-y lg:flex text-lg">
                Buku Yang Dipinjam
            </div>
            <div class="border-theme-5 mt-5 grid grid-cols-12 gap-5 border-t pt-3">
                @forelse (Auth::user()->userCurrentlyBorrowedBooks() as $loanDetail)
                    <div class="intro-y col-span-12 md:col-span-4 xl:col-span-2 box">
                        <div class="p-5">
                            <div class="h-56 xxl:h-56 image-fit" style="height: 310px">
                                <img alt="Midone Tailwind HTML Admin Template" class="rounded-md" src="{{asset('storage/'.$loanDetail->book->photo)}}" >
                            </div>
                            <div class="mt-5">
                                @foreach ($loanDetail->book->categories as $category)
                                    <span class="text-xs px-3 p-1 rounded-md bg-theme-1 text-white mr-1">{{ $category->name }}</span>
                                @endforeach
                            </div>
                            <a href="" class="block font-medium text-base mt-1 truncate">{{ $loanDetail->book->name }}</a>
                            <p class="text-slate-600">{{ $loanDetail->book->author }}</p>
                            <div class="text-slate-600 mt-1">
                                <div class="flex items-center"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="link" data-lucide="link" class="lucide lucide-link w-4 h-4 mr-2"><path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"></path></svg> Penerbit: {{ $loanDetail->book->publisher }} </div>
                                <div class="flex items-center mt-2"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg> Tahun: {{ $loanDetail->book->year }} </div>
                                <div class="flex items-center mt-2"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="layers" data-lucide="layers" class="lucide lucide-layers w-4 h-4 mr-2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg> Stock: {{ $loanDetail->book->quantity }} </div>
                            </div>
                        </div>
                        <div class="flex items-center px-5 py-3 border-t border-gray-200">
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-500 w-4 h-4 mr-1"><polygon fill="#fde047" points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-500 w-4 h-4 mr-1"><polygon fill="#fde047" points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-500 w-4 h-4 mr-1"><polygon fill="#fde047" points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-500 w-4 h-4 mr-1"><polygon fill="#fde047" points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="star" data-lucide="star" class="lucide lucide-star text-slate-400 fill-slate/30 w-4 h-4 mr-1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg> </div>
                                <div class="text-xs text-slate-500 ml-1">(4.5+)</div>
                            </div>
                            @if ($loanDetail->book->isBookBookmarked())
                                <a href="{{ route('add.bookmark', $loanDetail->book->id) }}" class="intro-x w-8 h-8 ml-auto flex items-center justify-center rounded-full border border-gray-500 text-white tooltip tooltipstered"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#1C3FAA" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark w-4 h-4"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg> </a>
                            @else
                                <a href="{{ route('add.bookmark', $loanDetail->book->id) }}" class="intro-x w-8 h-8 ml-auto flex items-center justify-center rounded-full border border-gray-500 text-gray-600 tooltip tooltipstered"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark w-4 h-4"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg> </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-12 flex justify-center items-center h-40">
                        Gaada buku dipinjam
                    </div>
                @endforelse
            </div>
        </div>
        <div class="intro-y col-span-12 lg:col-span-8 mt-5">
            <div class="intro-y lg:flex text-lg">
                Buku Yang Telah Dikembalikan
            </div>

            @foreach (Auth::user()->userReturnedBooks() as $borrowedDate => $loanDetails)
                <div class="mt-5">
                    <h3 class="font-bold">{{ \Carbon\Carbon::parse($borrowedDate)->format('d F Y') }}</h3> <!-- Display Borrowed Date -->
                    <div class="border-theme-5 mt-5 grid grid-cols-12 gap-5 border-t pt-3">
                        @foreach ($loanDetails as $loanDetail)
                            <div class="intro-y col-span-12 md:col-span-4 xl:col-span-2 box">
                                <div class="p-5">
                                    <div class="h-56 xxl:h-56 image-fit" style="height: 310px">
                                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-md" src="{{asset('storage/'.$loanDetail->book->photo)}}" >
                                    </div>
                                    <div class="mt-5">
                                        @foreach ($loanDetail->book->categories as $category)
                                            <span class="text-xs px-3 p-1 rounded-md bg-theme-1 text-white mr-1">{{ $category->name }}</span>
                                        @endforeach
                                    </div>
                                    <a href="" class="block font-medium text-base mt-1 truncate">{{ $loanDetail->book->name }}</a>
                                    <p class="text-slate-600">{{ $loanDetail->book->author }}</p>
                                    <div class="text-slate-600 mt-1">
                                        <div class="flex items-center"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="link" data-lucide="link" class="lucide lucide-link w-4 h-4 mr-2"><path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"></path></svg> Penerbit: {{ $loanDetail->book->publisher }} </div>
                                        <div class="flex items-center mt-2"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg> Tahun: {{ $loanDetail->book->year }} </div>
                                        <div class="flex items-center mt-2"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="layers" data-lucide="layers" class="lucide lucide-layers w-4 h-4 mr-2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg> Stock: {{ $loanDetail->book->quantity }} </div>
                                    </div>
                                </div>
                                <div class="flex items-center px-5 py-3 border-t border-gray-200">
                                    <div class="flex items-center">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-500 w-4 h-4 mr-1"><polygon fill="#fde047" points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-500 w-4 h-4 mr-1"><polygon fill="#fde047" points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-500 w-4 h-4 mr-1"><polygon fill="#fde047" points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-500 w-4 h-4 mr-1"><polygon fill="#fde047" points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="star" data-lucide="star" class="lucide lucide-star text-slate-400 fill-slate/30 w-4 h-4 mr-1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg> </div>
                                        <div class="text-xs text-slate-500 ml-1">(4.5+)</div>
                                    </div>
                                    @if ($loanDetail->book->isBookBookmarked())
                                        <a href="{{ route('add.bookmark', $loanDetail->book->id) }}" class="intro-x w-8 h-8 ml-auto flex items-center justify-center rounded-full border border-gray-500 text-white tooltip tooltipstered"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#1C3FAA" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark w-4 h-4"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg> </a>
                                    @else
                                        <a href="{{ route('add.bookmark', $loanDetail->book->id) }}" class="intro-x w-8 h-8 ml-auto flex items-center justify-center rounded-full border border-gray-500 text-gray-600 tooltip tooltipstered"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark w-4 h-4"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg> </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
