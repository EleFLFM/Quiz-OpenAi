<nav class="navbar">
    <div style="padding: 0;" class="container">

        <div class="navbar-header">
            <button class="navbar-toggler" data-toggle="open-navbar1">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <a href="{{route('dashboard')}}">
                <img width="100px" src="/img/logo.png" alt="">
            </a>
        </div>

        <div class="navbar-menu" id="open-navbar1">
            <ul class="navbar-nav">

                @role('Administrador')
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link style="color: black;" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
                @else
                <x-nav-link style="color: black;" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Inicio') }}
                </x-nav-link>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link style="color: black;" :href="route('student.educational-content')" :active="request()->routeIs('student.educational-content')">
                        {{ __('Contenido Educativo') }}
                    </x-nav-link>
                </div>
                @endrole

                @role('Administrador')
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link style="color: black;" :href="route('admin.show')" :active="request()->routeIs('admin.show')">
                        {{ __('Resultados') }}
                    </x-nav-link>
                </div>
                @else
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link style="color: black;" :href="route('test.show')" :active="request()->routeIs('test.show')">
                        {{ __('Test') }}
                    </x-nav-link>
                </div>
                @endrole
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <li class="navbar-dropdown">
                        <a style="margin-right: 20px;" href="#" class="dropdown-toggler" data-dropdown="my-dropdown-id">
                            {{ Auth::user()->name }} <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown" id="my-dropdown-id">
                            <li><a href="{{route('profile.edit')}}" class="nav-item">Perfil</a></li>
                            <li><a class="nav-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Cerrar Sesión
                                </a> </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                </div>
            </ul>
        </div>
    </div>
</nav>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap");

    * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }



    a {
        text-decoration: none;
    }

    .container {
        width: 1170px;
        position: relative;
        margin-left: auto;
        margin-right: auto;
        padding-left: 15px;
        padding-right: 15px;
    }

    .navbar,
    .navbar>.container {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
    }

    @media (max-width: 768px) {

        .navbar,
        .navbar>.container {
            display: block;
        }
    }

    .navbar {

        padding: 1rem 1.15rem;
        border-bottom: 1px solid #eceef3;
        /*
  |-----------------------------------
  | Start navbar logo or brand etc..
  |-----------------------------------
  */
        /*
  |-----------------------------------
  | Start navbar menu
  |-----------------------------------
  */
    }

    @media (min-width: 576px) {
        .navbar .container {
            max-width: 540px;
        }
    }

    @media (min-width: 768px) {
        .navbar .container {
            max-width: 720px;
        }
    }

    @media (min-width: 992px) {
        .navbar .container {
            max-width: 960px;
        }
    }

    @media (min-width: 1200px) {
        .navbar .container {
            max-width: 1140px;
        }
    }

    .navbar .navbar-header {
        display: flex;
        align-items: center;
    }

    @media (max-width: 768px) {
        .navbar .navbar-header {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-direction: row-reverse;
        }
    }

    .navbar .navbar-header .navbar-toggler {
        cursor: pointer;
        border: none;
        display: none;
        outline: none;
    }

    @media (max-width: 768px) {
        .navbar .navbar-header .navbar-toggler {
            display: block;
        }
    }

    .navbar .navbar-header .navbar-toggler span {
        height: 2px;
        width: 22px;
        background-color: #929aad;
        display: block;
    }

    .navbar .navbar-header .navbar-toggler span:not(:last-child) {
        margin-bottom: 0.2rem;
    }

    .navbar .navbar-header>a {
        font-weight: 500;
        color: #3c4250;
    }

    .navbar .navbar-menu {
        display: flex;
        align-items: center;
        flex-basis: auto;
        flex-grow: 1;
    }

    @media (max-width: 768px) {
        .navbar .navbar-menu {
            display: none;
            text-align: center;
        }
    }

    .navbar .navbar-menu.active {
        display: flex !important;
    }

    .navbar .navbar-menu .navbar-nav {
        margin-left: auto;
        flex-direction: row;
        display: flex;
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
    }

    @media (max-width: 768px) {
        .navbar .navbar-menu .navbar-nav {
            width: 100%;
            display: block;
            border-top: 1px solid #EEE;
            margin-top: 1rem;
        }
    }

    .navbar .navbar-menu .navbar-nav>li>a {
        color: #3c4250;
        text-decoration: none;
        display: inline-block;
        padding: 0.5rem 1rem;
    }

    .navbar .navbar-menu .navbar-nav>li>a:hover {
        color: #66f;
    }

    @media (max-width: 768px) {
        .navbar .navbar-menu .navbar-nav>li>a {
            border-bottom: 1px solid #eceef3;
        }
    }

    .navbar .navbar-menu .navbar-nav>li.active a {
        color: #66f;
    }

    .navbar .navbar-menu .navbar-nav .navbar-dropdown .dropdown {
        list-style: none;
        position: absolute;
        top: 150%;
        left: 0;
        background-color: #fff;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        min-width: 160px;
        width: auto;
        white-space: nowrap;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        z-index: 99999;
        border-radius: 0.75rem;
        display: none;
    }

    @media (max-width: 768px) {
        .navbar .navbar-menu .navbar-nav .navbar-dropdown .dropdown {
            position: relative;
            box-shadow: none;
        }
    }

    .navbar .navbar-menu .navbar-nav .navbar-dropdown .dropdown li a {
        color: #3c4250;
        padding: 0.25rem 1rem;
        display: block;
    }

    .navbar .navbar-menu .navbar-nav .navbar-dropdown .dropdown.show {
        display: block !important;
    }

    .navbar .navbar-menu .navbar-nav .dropdown>.separator {
        height: 1px;
        width: 100%;
        margin-top: 9px;
        margin-bottom: 9px;
        background-color: #eceef3;
    }

    .navbar .navbar-dropdown {
        position: relative;
    }

    .navbar .navbar-header>a span {
        color: #66f;
    }

    .navbar .navbar-header h4 {
        font-weight: 500;
        font-size: 1.25rem;
    }

    @media (max-width: 768px) {
        .navbar .navbar-header h4 {
            font-size: 1.05rem;
        }
    }
</style>
<script>
    let dropdowns = document.querySelectorAll('.navbar .dropdown-toggler')
    let dropdownIsOpen = false

    // Handle dropdown menues
    if (dropdowns.length) {
        dropdowns.forEach((dropdown) => {
            dropdown.addEventListener('click', (event) => {
                let target = document.querySelector(`#${event.target.dataset.dropdown}`)

                if (target) {
                    if (target.classList.contains('show')) {
                        target.classList.remove('show')
                        dropdownIsOpen = false
                    } else {
                        target.classList.add('show')
                        dropdownIsOpen = true
                    }
                }
            })
        })
    }

    // Handle closing dropdowns if a user clicked the body
    window.addEventListener('mouseup', (event) => {
        if (dropdownIsOpen) {
            dropdowns.forEach((dropdownButton) => {
                let dropdown = document.querySelector(`#${dropdownButton.dataset.dropdown}`)
                let targetIsDropdown = dropdown == event.target

                if (dropdownButton == event.target) {
                    return
                }

                if ((!targetIsDropdown) && (!dropdown.contains(event.target))) {
                    dropdown.classList.remove('show')
                }
            })
        }
    })

    function handleSmallScreens() {
        document.querySelector('.navbar-toggler')
            .addEventListener('click', () => {
                let navbarMenu = document.querySelector('.navbar-menu')

                if (!navbarMenu.classList.contains('active')) {
                    navbarMenu.classList.add('active')
                } else {
                    navbarMenu.classList.remove('active')
                }
            })
    }

    handleSmallScreens()
</script>