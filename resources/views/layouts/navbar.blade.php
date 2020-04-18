<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link {{ set_active('dashboard') }}" href="{{ route('dashboard') }}">
            <i class="ni ni-tv-2 text-primary"></i>
            <span class="nav-link-text">Halaman Utama</span>
        </a>
    </li>

    @if (Auth::guard('admin')->user()->role_id == 1)
    {{-- Super Admin Menu --}}
    <li class="nav-item">
        <a class="nav-link {{ set_active(['branch-office.index', 'branch-office.create', 'branch-office.show', 'branch-office.edit']) }}" href="{{ route('branch-office.index') }}">
            <i class="ni ni-building text-primary"></i>
            <span class="nav-link-text">Kantor Cabang</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ set_active(['user.index', 'user.create', 'user.show', 'user.edit']) }}" href="{{ route('user.index') }}">
            <i class="ni ni-single-02 text-primary"></i>
            <span class="nav-link-text">Data Pengguna</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ set_active(['admin.index', 'admin.create', 'admin.show', 'admin.edit']) }}" href="{{ route('admin.index') }}">
            <i class="ni ni-badge text-primary"></i>
            <span class="nav-link-text">Data Admin</span>
        </a>
    </li>
    @endif

    @if (Auth::guard('admin')->user()->role_id == 2)
    {{-- Office Staff Menu --}}
    <li class="nav-item">
        <a class="nav-link {{ set_active(['program.index', 'program.create', 'program.show', 'program.edit']) }}" href="{{ route('program.index') }}">
            <i class="ni ni-archive-2 text-primary"></i>
            <span class="nav-link-text">Program</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ set_active(['donor.index', 'donor.create', 'donor.show', 'donor.edit']) }}" href="#">
            <i class="ni ni-circle-08 text-primary"></i>
            <span class="nav-link-text">Donatur</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ set_active(['post.index', 'post.create', 'post.show', 'post.edit']) }}" href="#">
            <i class="ni ni-single-copy-04 text-primary"></i>
            <span class="nav-link-text">Artikel</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ set_active(['donation-account.index', 'donation-account.create', 'donation-account.show', 'donation-account.edit']) }}" href="#">
            <i class="ni ni-collection text-primary"></i>
            <span class="nav-link-text">Rekening Donasi</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ set_active(['ebook.index', 'ebook.create', 'ebook.show', 'ebook.edit']) }}" href="#">
            <i class="ni ni-folder-17 text-primary"></i>
            <span class="nav-link-text">Majalah & Ebook</span>
        </a>
    </li>
    @endif
</ul>
