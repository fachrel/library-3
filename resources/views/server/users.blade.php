@extends('layouts.server')
@section('title', 'Users')

@section('content')
    <h2 class="intro-y text-lg font-medium mt-10">
        List User
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <div class="text-center"> <a href="javascript:;" data-toggle="modal" data-target="#create-user-modal" class="button inline-block bg-theme-1 text-white">Tambahkan User</a> </div>
            <div class="modal" id="create-user-modal">
                <div class="modal__content">
                    <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">Tambahkan User</h2>
                    </div>
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                            <div class="col-span-12">
                                <label>Nama Lengkap</label>
                                <input type="text" name="name" class="input w-full border mt-2" placeholder="Jhon Doe">
                            </div>
                            <div class="col-span-12">
                                <label>Username</label>
                                <input type="text" name="username" class="input w-full border mt-2" placeholder="username">

                            </div>
                            <div class="col-span-12">
                                <label>Email</label>
                                <input type="email" name="email" class="input w-full border mt-2" placeholder="example@test.com">

                            </div>
                            <div class="col-span-12">
                                <label>Alamat</label>
                                <input type="text" name="address" class="input w-full border mt-2" placeholder="Pojok, Delingan">

                            </div>
                            <div class="col-span-12">
                                <label>Password</label>
                                <input type="password" name="password" class="input w-full border mt-2">

                            </div>
                            <div class="col-span-12">
                                <label>Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="input w-full border mt-2">

                            </div>
                            <div class="col-span-12">
                                <label>Role</label>
                                <select name="role" class="input w-full border mt-2">
                                    <option value="0">User</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Petugas</option>
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
            <div class="hidden md:block mx-auto text-gray-600">Showing {{ $users->firstItem() }} to {{$users->lastItem()}} of {{$users->total()}} entries</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <form action="{{ route('users.index') }}" method="get" class="flex">
                    <div class="w-56 relative text-gray-700 mr-2">
                        <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search..." value="{{ request('search') != null ? request('search') : '' }}" name="search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </div>
                    <button type="submit" class="button inline-block bg-theme-1 text-white">Search</button>
                </form>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <table class="table col-span-12">
            <thead>
                <tr>
                    <th class="border-b-2 whitespace-no-wrap">#</th>
                    <th class="border-b-2 whitespace-no-wrap">Nama Lengkap</th>
                    <th class="border-b-2 whitespace-no-wrap">Username</th>
                    <th class="border-b-2 whitespace-no-wrap">Email</th>
                    <th class="border-b-2 whitespace-no-wrap">Alamat</th>
                    <th class="border-b-2 whitespace-no-wrap">Role</th>
                    <th class="border-b-2 whitespace-no-wrap text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user )

                    <tr>
                        <td class="border-b">{{ $loop->iteration }}</td>
                        <td class="border-b">{{ $user->name }}</td>
                        <td class="border-b">{{ $user->username }}</td>
                        <td class="border-b">{{ $user->email }}</td>
                        <td class="border-b">{{ $user->address }}</td>
                        <td class="border-b">
                            @if($user->role == "0")
                                Peminjam
                            @elseif ($user->role == "1")
                                Admin
                            @elseif ($user->role = "2")
                                Petugas
                            @endif
                        </td>
                        <td class="table-report__action w-56 border-b">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="javascript:;" data-toggle="modal" data-target="#edit-user-modal-{{ $user->id }}"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg> Edit </a>
                                <a class="flex items-center text-theme-6" href="javascript:;" data-toggle="modal" data-target="#delete-user-modal-{{ $user->id }}"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-4 h-4 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> Delete </a>
                            </div>
                            <div class="modal" id="edit-user-modal-{{ $user->id }}">
                                <div class="modal__content">
                                    <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                                        <h2 class="font-medium text-base mr-auto">Edit User</h2>
                                    </div>
                                    <form action="{{ route('users.update', $user->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                                            <div class="col-span-12">
                                                <label>Nama Lengkap</label>
                                                <input type="text" name="name" value="{{ $user->name }}" class="input w-full border mt-2" placeholder="Jhon Doe">
                                            </div>
                                            <div class="col-span-12">
                                                <label>Username</label>
                                                <input type="text" value="{{ $user->username }}" name="username" class="input w-full border mt-2" placeholder="username">

                                            </div>
                                            <div class="col-span-12">
                                                <label>Email</label>
                                                <input type="email" value="{{ $user->email }}" name="email" class="input w-full border mt-2" placeholder="example@test.com">
                                            </div>
                                            <div class="col-span-12">
                                                <label>Alamat</label>
                                                <input type="text" value="{{ $user->address }}" name="address" class="input w-full border mt-2" placeholder="Pojok, Delingan">
                                            </div>
                                            <div class="col-span-12">
                                                <label>Password lama</label>
                                                <input type="password" name="password" class="input w-full border mt-2">
                                            </div>
                                            <div class="col-span-12">
                                                <label>Password Baru</label>
                                                <input type="password" name="new_password" class="input w-full border mt-2">
                                            </div>
                                            <div class="col-span-12">
                                                <label>Konfirmasi Password Baru</label>
                                                <input type="password" name="password_confirmation" class="input w-full border mt-2">
                                            </div>
                                            <div class="col-span-12">
                                                <label>Role</label>
                                                <select name="role" value="{{ $user->role }}" class="input w-full border mt-2">
                                                    <option value="0">User</option>
                                                    <option value="1">Admin</option>
                                                    <option value="2">Petugas</option>
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
                            <div class="modal" id="delete-user-modal-{{ $user->id }}">
                                <div class="modal__content">
                                    <div class="p-5 text-center"> <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                                        <div class="text-3xl mt-5">Are you sure?</div>
                                        <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot be undone.</div>
                                    </div>
                                    <div class="px-5 pb-8 text-center flex justify-center">
                                        <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                                        <form action="{{ route('users.destroy',$user->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="button w-24 bg-theme-6 text-white">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <!-- END: Data List -->
        <div>
            {{ $users->links('vendor.pagination.tailwind') }}
        </div>

    </div>
@endsection
