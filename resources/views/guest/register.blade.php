@extends('layouts.guest')

@section('title', 'Register')
@section('content')
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Register Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="{{asset('Midone/Compiled/dist/images/logo.svg')}}">
                    <span class="text-white text-lg ml-3"> Mid<span class="font-medium">One</span> </span>
                </a>
                <div class="my-auto">
                    <img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="{{asset('Midone/Compiled/dist/images/illustration.svg')}}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        A few more clicks to
                        <br>
                        sign up to your account.
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white">Manage all your e-commerce accounts in one place</div>
                </div>
            </div>
            <!-- END: Register Info -->
            <!-- BEGIN: Register Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                        Sign Up
                    </h2>
                    <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
                    <form action="{{route('register.store')}}" method="post">
                        @csrf
                        <div class="intro-x mt-8">
                            <input type="text" value="{{old('name')}}" name="name" class="intro-x login__input input input--lg border border-gray-300 block" placeholder="Nama Lengkap">
                            <input type="text" value="{{old('username')}}" name="username" class="intro-x login__input input input--lg border border-gray-300 block mt-4" placeholder="Username">
                            <input type="email" value="{{old('email')}}" name="email" class="intro-x login__input input input--lg border border-gray-300 block mt-4" placeholder="Email">
                            <input type="text" value="{{old('address')}}" name="address" class="intro-x login__input input input--lg border border-gray-300 block mt-4" placeholder="Alamat">
                            <input type="password" name="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4" placeholder="Password">
                            <input type="password" name="password_confirmation" class="intro-x login__input input input--lg border border-gray-300 block mt-4" placeholder="Konfirmasi Password">
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button type="submit" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">Register</button>
                            <a href="{{route('login')}}" type="button" class="button button--lg w-full xl:w-32 text-gray-700 border border-gray-300 mt-3 xl:mt-0">Login</a>
                        </div>
                    </form>

                </div>
            </div>
            <!-- END: Register Form -->
        </div>
    </div>
@endsection
