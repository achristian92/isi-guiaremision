<div class="navigation-menu-body">
    <!-- begin::navigation-logo -->
    <div>
        <div id="navigation-logo">
            <a href="">
                <img class="logo" src="{{ asset('img/isi (3).png') }}" style="max-width: 100%; object-fit: contain" alt="logo">
                {{--<img class="logo" src="{{ asset('img/betagen.jpeg') }}" style="max-width: 100%; object-fit: contain" alt="logo">--}}
            </a>
        </div>
    </div>
    <!-- end::navigation-logo -->

    <div class="navigation-menu-group">

        <div id="elements">
            <ul>
                <li class="navigation-divider">UI Elements</li>
                <li>
                    <a href="#">Basic</a>
                    <ul>
                        <li><a href="alerts.html">Alert</a></li>
                        <li><a href="accordion.html">Accordion</a></li>
                        <li><a href="buttons.html">Buttons</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        @include('layouts.partials.sidebar-finance')

    </div>
</div>
