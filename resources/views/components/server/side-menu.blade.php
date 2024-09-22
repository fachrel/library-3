<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4">
        <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="{{asset('Midone/Compiled/dist/images/logo.svg')}}">
        <span class="hidden xl:block text-white text-lg ml-3"> Mid<span class="font-medium">one</span> </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="{{ route('dashboard') }}" class="side-menu {{ request()->routeIs('dashboard') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                <div class="side-menu__title"> Dashboard </div>
            </a>
        </li>
        <li>
            <a href="{{ route('users.index') }}" class="side-menu {{ request()->routeIs('users.index') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                <div class="side-menu__title"> Users </div>
            </a>
        </li>
        <li>
            <a href="{{ route('categories.index') }}" class="side-menu {{ request()->routeIs('categories.index') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-feather="box"></i> </div>
                <div class="side-menu__title"> Kategori </div>
            </a>
        </li>
        <li>
            <a href="{{ route('books.index') }}" class="side-menu {{ request()->routeIs('books.index') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-feather="book"></i> </div>
                <div class="side-menu__title"> Buku </div>
            </a>
        </li>
        <li class="side-nav__devider my-6"></li>

        <li>
            <a href="{{ route('loan') }}" class="side-menu {{ request()->routeIs('loan') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-feather="corner-up-right"></i> </div>
                <div class="side-menu__title"> Peminjaman </div>
            </a>
        </li>
        <li>
            <a href="{{ route('return') }}" class="side-menu {{ request()->routeIs('return') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-feather="corner-down-left"></i> </div>
                <div class="side-menu__title"> Pengembalian </div>
            </a>
        </li>
        <li>
            <a href="side-menu-chat.html" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="user-plus"></i> </div>
                <div class="side-menu__title"> Pengajuan Peminjaman </div>
            </a>
        </li>
        <li>
            <a href="side-menu-chat.html" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="file-text"></i> </div>
                <div class="side-menu__title"> Laporan </div>
            </a>
        </li>

    </ul>
</nav>
