<!-- SIDE MENU BAR -->
<style>
    .scrollable-menu {
        height: 1000px;
        /* Set a fixed height */
        overflow-y: auto;
        /* Add vertical scrollbar when content overflows */
        overflow-x: auto;
        width: 245px;
        /* Add vertical scrollbar when content overflows */
    }

    .submenu {
        display: none;
        list-style: none;
        padding-left: 20px;
    }

    .show-menu {
        display: block;
    }

    .toggle-icon {
        float: right;
        transition: transform 0.3s ease;
    }

    .rotate {
        transform: rotate(90deg);
    }
</style>

<aside class="app-sidebar">
    <div class="app-sidebar__logo">
        <a class="header-brand" href="{{ url('/dashboard') }}">
            <img src="{{ URL::asset('image/WIthColor_logo.png') }}" class="header-brand-img desktop-lgo"
                alt="Admintro logo" style="width:61px;margin-left:-50px">
            <img src="{{ URL::asset('image/WIthColor_logo.png') }}" class="header-brand-img mobile-logo"
                alt="Admintro logo">
        </a>
    </div>

    <div class="scrollable-menu">
        <ul class="side-menu app-sidebar3">
            <li class="side-item side-item-category mt-4 mb-3">{{ __('Islameapp') }}</li>
            {{-- Dashboard start --}}
            <li class="slide">
                <a href="javascript:void(0);" class="side-menu__item" id="toogleDashboard">
                    <span class="side-menu__icon lead-3 fa-solid fa-chart-tree-map"></span>
                    <span class="side-menu__label">Dashboard</span>
                    <span class="toggle-icon fa-solid fa-chevron-right"></span>
                </a>
                <ul class="submenu" id="quranDashboard">
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('dashboard') }}">
                            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-arrows-to-circle "></span>
                            <span class="side-menu__label">Dashboard</span></a>
                    </li>
                    {{-- ################### About ################## --}}

                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('about') }}">
                            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-user fa-regular "></span>
                            <span class="side-menu__label">Add About</span></a>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('AdminBlog') }}">
                            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-images fa-regular "></span>
                            <span class="side-menu__label">Create Blog </span></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('AdminPost') }}">
                            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-images fa-regular  "></span>
                            <span class="side-menu__label">Create Post </span></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('ProfileQariSahib') }}">
                            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-address-card fa-regular "></span>
                            <span class="side-menu__label"> ProfileQariSahib </span></a>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('TestmonialApp') }}">
                            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-rectangle-list fa-regular "></span>
                            <span class="side-menu__label"> TestmonialApp </span></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('ContactMe') }}">
                            <span class="side-menu__icon lead-3 fs-18 fa-id-badge fa-regular"></span>
                            <span class="side-menu__label"> ContactMe </span></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('Islameapp') }}">
                            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-square fa-regular "></span>
                            <span class="side-menu__label"> Islameapp </span></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('Visitor') }}">
                            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-user fa-regular "></span>
                            <span class="side-menu__label"> Visitor </span></a>
                    </li>

                </ul>
            </li>
            {{-- ################### Quaida ################## --}}

            <li class="slide">
                <a href="javascript:void(0);" class="side-menu__item" id="toggleQuaida">
                    <span class="side-menu__icon lead-3 fa-solid fa-folder-closed fa-regular"></span>
                    <span class="side-menu__label">Qaida</span>
                    <span class="toggle-icon fa-solid fa-chevron-right"></span>
                </a>
                <ul class="submenu" id="quaidaMenu">
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('Quaida') }}">
                            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-book-open"></span>
                            <span class="side-menu__label">Qaida</span></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('QuaidaDetail') }}">
                            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-book-open"></span>
                            <span class="side-menu__label">Description</span></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('QuaidaGuaide') }}">
                            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-book-open"></span>
                            <span class="side-menu__label">Guaideness</span></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('QuaidaTest') }}">
                            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-book-open"></span>
                            <span class="side-menu__label">Testing</span></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('QuaidaAnswer') }}">
                            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-book-open"></span>
                            <span class="side-menu__label">Answer </span></a>
                    </li>
                </ul>
            </li>

            {{-- Quaran --}}
            <li class="slide">
                <a href="javascript:void(0);" class="side-menu__item" id="toggleQuran">
                    <span class="side-menu__icon lead-3 fa-solid fa-folder-closed fa-regular"></span>
                    <span class="side-menu__label">Quran</span>
                    <span class="toggle-icon fa-solid fa-chevron-right"></span>
                </a>
                <ul class="submenu" id="quranMenu">

                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('Quran') }}">
                            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-book-open"></span>
                            <span class="side-menu__label">Quran </span></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('QuranWithAyat') }}">
                            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-book-open"></span>
                            <span class="side-menu__label">QuranWithAyat </span></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('QuranAyatWithAnswer') }}">
                            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-book-open"></span>
                            <span class="side-menu__label">QuranAyatWithAnswer </span></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('QuranAyatWithTesting') }}">
                            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-book-open"></span>
                            <span class="side-menu__label">QuranAyatWithTesting </span></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('QuranGuaide') }}">
                            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-book-open"></span>
                            <span class="side-menu__label">QuranGuaide </span></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('QuranWithWord') }}">
                            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-book-open"></span>
                            <span class="side-menu__label"> QuranWithWord </span></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('QuranWordWithTesting') }}">
                            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-book-open"></span>
                            <span class="side-menu__label"> QuranWordWithTesting </span></a>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('QuranWordWithAnswer') }}">
                            <span class="side-menu__icon lead-3 fs-18 fa-solid fa-book-open"></span>
                            <span class="side-menu__label"> QuranWordWithAnswer </span></a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</aside>

<script>
    document.getElementById('toggleQuran').addEventListener('click', function() {
        // document.getElementById('quranMenu').classList.toggle('show-menu');
        let menu = document.getElementById('quranMenu');
        let folderIcon = this.querySelector('.side-menu__icon');
        let arrowIcon = this.querySelector('.toggle-icon');
        menu.classList.toggle('show-menu');
        // Toggle Folder Icon
        if (folderIcon.classList.contains('fa-folder-closed')) {
            folderIcon.classList.replace('fa-folder-closed', 'fa-folder-open');
        } else {
            folderIcon.classList.replace('fa-folder-open', 'fa-folder-closed');
        }
        // Rotate Arrow Icon
        arrowIcon.classList.toggle('rotate');
    });
    document.getElementById('toggleQuaida').addEventListener('click', function() {
        let menu = document.getElementById('quaidaMenu');
        let folderIcon = this.querySelector('.side-menu__icon');
        let arrowIcon = this.querySelector('.toggle-icon');
        menu.classList.toggle('show-menu');
        // Toggle Folder Icon
        if (folderIcon.classList.contains('fa-folder-closed')) {
            folderIcon.classList.replace('fa-folder-closed', 'fa-folder-open');
        } else {
            folderIcon.classList.replace('fa-folder-open', 'fa-folder-closed');
        }
        // Rotate Arrow Icon
        arrowIcon.classList.toggle('rotate');
    });
    document.getElementById('toogleDashboard').addEventListener('click', function() {
        document.getElementById('quranDashboard').classList.toggle('show-menu');
        let icon = this.querySelector('.toggle-icon');
        icon.classList.toggle('rotate');
    });
</script>

<style>

</style>
