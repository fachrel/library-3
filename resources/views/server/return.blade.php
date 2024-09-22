@extends('layouts.server')
@section('title', 'Return')

@section('content')
<h2 class="intro-y text-lg font-medium mt-10">
    Transaction List
</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <div class="text-center">
            <a href="{{ route('loan') }}" class="button inline-block bg-theme-1 text-white">Tambah Peminjaman</a>
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
    <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">
                        <input class="form-check-input" type="checkbox">
                    </th>
                    <th class="whitespace-nowrap">INVOICE</th>
                    <th class="whitespace-nowrap">NAMA PEMINJAM</th>
                    <th class="text-center whitespace-nowrap">STATUS</th>
                    <th class="whitespace-nowrap">TANGGAL PEMINJAMAN</th>
                    <th class="whitespace-nowrap">DIKEMBALIKAN SEBELUM</th>
                    <th class="text-right whitespace-nowrap">
                        <div class="pr-16">DENDA</div>
                    </th>
                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loans as $loan)
                    <tr class="intro-x">
                        <td class="w-10">
                            <input class="form-check-input" type="checkbox">
                        </td>
                        <td class="!py-4"> <a href="" class="underline decoration-dotted whitespace-nowrap">{{ $loan->invoice }}</a> </td>
                        <td class="">
                            <a href="" class="font-medium whitespace-nowrap">{{$loan->user->username}}</a>
                            <div class="text-slate-500 text-xs mt-0.5">{{ $loan->user->address }}</div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center whitespace-nowrap text-success"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg> {{ $loan->CountReturnedBook() }}/{{ $loan->CountBorrowedBook() }} Dikembalikan </div>
                        </td>
                        <td>
                            <div class="whitespace-nowrap">{{$loan->borrowed_at}}</div>
                        </td>
                        <td>
                            <div class="whitespace-nowrap">{{$loan->must_returned_at}}</div>
                        </td>
                        <td class="w-40 text-right">
                            <div class="pr-16">0</div>
                        </td>
                        <td class="table-report__action">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center text-primary whitespace-nowrap mr-5" href="javascript:;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg> Lihat Detail </a>
                            </div>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
    <!-- END: Data List -->

</div>
@endsection
