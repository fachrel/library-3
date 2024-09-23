<div class="border-b border-theme-24 -mt-10 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 pt-3 md:pt-0 mb-10">
    <div class="top-bar-boxed flex items-center">
        <!-- BEGIN: Logo -->
        <a href="" class="-intro-x hidden md:flex">
            <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="{{asset('Midone/Compiled/dist/images/logo.svg')}}"/>
            <span class="text-white text-lg ml-3"> Mid<span class="font-medium">one</span> </span>
        </a>
        <!-- END: Logo -->
        <!-- BEGIN: Breadcrumb -->
        <div class="-intro-x breadcrumb breadcrumb--light mr-auto"> </div>
        <!-- END: Breadcrumb -->
        <!-- BEGIN: Search -->
        <div class="intro-x relative mr-3 sm:mr-6">
            <div class="search hidden sm:block">
                <input type="text" class="search__input input placeholder-theme-13" placeholder="Search...">
                <i data-feather="search" class="search__icon"></i>
            </div>

        </div>
        <!-- END: Search -->
        <!-- BEGIN: Account Menu -->
        @if(Auth::user())
            <div class="intro-x dropdown w-8 h-8 relative">
                <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                    <img alt="Midone Tailwind HTML Admin Template" src="{{asset('Midone/Compiled/dist/images/profile-12.jpg')}}">
                </div>
                <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                    <div class="dropdown-box__content box bg-theme-38 text-white">
                        <div class="p-4 border-b border-theme-40">
                            <div class="font-medium">{{Auth::user()->name}}</div>
                            <div class="text-xs text-theme-41">
                                @if(Auth::user()->role == "0")
                                Peminjam
                                @elseif (Auth::user()->role == "1")
                                    Admin
                                @elseif (Auth::user()->role = "2")
                                    Petugas
                                @endif
                            </div>
                        </div>
                        <div class="p-2">
                            <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
                        </div>
                        <div class="p-2 border-t border-theme-40">
                            <a href="{{route('logout')}}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}" type="button" class="button button--md rounded-full w-full xl:w-32 text-gray-700 bg-white border border-gray-300 mt-3 xl:mt-0">Login</a>
        @endif
        <!-- END: Account Menu -->
    </div>
</div>
