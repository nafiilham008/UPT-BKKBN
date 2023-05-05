<div class="container-fluid d-flex justify-content-arround">
    <!-- <div class="d-flex justify-content-arround"> -->
    <a class="navbar-brand" href="{{ route('home.index') }}">
        <img src="{{asset('img/logo/logo_upt.png')}}">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
        aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- </div> -->
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home.profile' ? 'active' : '' }}" aria-current="page" href="{{ route('home.profile') }}">Profil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home.training' ? 'active' : '' }}" href="{{ route('home.training') }}">Kediklatan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Dokumentasi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Informasi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Unduh</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pelayanan Publik</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Tautan</a>
            </li>
        </ul>
        <form class="d-flex" role="search">
            <input class="form-control me-2 font-14" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success font-14" type="submit"><i class="bi bi-search"></i></button>
        </form>
    </div>
</div>
