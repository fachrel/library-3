<nav class="top-nav">
    <ul>
        <li>
            <a href="{{ route('home') }}" class="top-menu {{ request()->routeIs('home') ? 'top-menu--active' : '' }}">
                <div class="top-menu__icon"> <i data-feather="home"></i> </div>
                <div class="top-menu__title"> Home </div>
            </a>
        </li>
        @auth
            <li>
                <a href="{{ route('my.books') }}" class="top-menu {{ request()->routeIs('my.books') ? 'top-menu--active' : '' }}">
                    <div class="top-menu__icon"> <i data-feather="book-open"></i> </div>
                    <div class="top-menu__title"> Buku saya </div>
                </a>
            </li>
            <li>
                <a href="{{ route('bookmarks') }}" class="top-menu {{ request()->routeIs('bookmarks') ? 'top-menu--active' : '' }}">
                    <div class="top-menu__icon"> <i data-feather="bookmark"></i> </div>
                    <div class="top-menu__title"> Koleksi buku </div>
                </a>
            </li>
            <li>
                <a href="top-menu-dashboard.html" class="top-menu">
                    <div class="top-menu__icon"> <i data-feather="user-plus"></i> </div>
                    <div class="top-menu__title"> Ajukan Peminjaman </div>
                </a>
            </li>
        @endauth

    </ul>
</nav>
