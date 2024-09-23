@extends('layouts.server')
@section('title', 'Return')

@section('content')
<h2 class="intro-y text-lg font-medium mt-10">
    Transaction List
</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-56 relative text-gray-700">
                <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </div>
        </div>

        <div class="hidden md:block mx-auto text-gray-600">Showing 1 to 10 of 150 entries</div>

        <div class="text-center">
            <a href="{{ route('loan') }}" class="button inline-block bg-theme-1 text-white mr-1">Tambah Peminjaman</a>
            <a href="javascript:;" data-toggle="modal" data-target="#print-modal" class="button inline-block bg-theme-1 text-white">Cetak</a>
        </div>
        <div class="modal" id="print-modal">
            <div class="modal__content">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">Tambahkan Kategori</h2>
                </div>
                <form action="{{ route('po') }}" method="post">
                    @csrf
                    <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                        <!-- Nama Peminjam Field -->
                        <div class="col-span-12">
                            <label>Nama Peminjam</label>
                            <select name="user" class="input w-full border mt-2">
                                <option value="">All users</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Start Date Field -->
                        <div class="col-span-6 mt-2">
                            <div class="relative w-56 mx-auto">
                                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">
                                    <i data-feather="calendar" class="w-4 h-4"></i>
                                </div>
                                <input type="text" name="start_date" class="datepicker input pl-12 border" placeholder="Start Date">
                            </div>
                        </div>

                        <!-- End Date Field -->
                        <div class="col-span-6 mt-2">
                            <div class="relative w-56 mx-auto">
                                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">
                                    <i data-feather="calendar" class="w-4 h-4"></i>
                                </div>
                                <input type="text" name="end_date" class="datepicker input pl-12 border" placeholder="End Date">
                            </div>
                        </div>
                    </div>

                    <!-- Form Buttons -->
                    <div class="px-5 py-3 text-right border-t border-gray-200">
                        <button type="button" class="button w-20 border text-gray-700 mr-1">Batal</button>
                        <button type="submit" class="button w-20 bg-theme-1 text-white">Simpan</button>
                    </div>
                </form>
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
                                <a href="{{ route('return.detail', $loan->id) }}" class="flex items-center text-primary whitespace-nowrap mr-5" href="javascript:;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg> Lihat Detail </a>
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
