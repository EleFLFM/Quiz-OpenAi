<nav class="navbar">
    <div class="container">

        <div class="navbar-header">
            <button class="navbar-toggler" data-toggle="open-navbar1">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <a href="#">
                <h4>Your<span>Logo</span></h4>
            </a>
        </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
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
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                        </form>
                    </ul>
                </li>



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

    body {
        font-family: "Roboto", sans-serif;
        font-size: 0.925rem;
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
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        background-color: #fff;
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