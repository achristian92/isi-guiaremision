<div id="manufacturing" class="
       {{ isOpenRoute(2,'formulations') }} || {{ isOpenRoute(2,'production-orders') }} ||
       {{ isOpenRoute(2,'packages') }} || {{ isOpenRoute(2,'mixers') }} ||
       {{ isOpenRoute(2,'presentations') }} || {{ isOpenRoute(2,'balances') }}">
    <ul>
        <li class="navigation-divider m-0 text-center">PRODUCCIÓN</li>
        <hr class="mt-0">
        <li class="navigation-divider m-0 text-light font-weight-bold">Fabricación</li>
        <li><a href="{{ route('manufacturing.formulations.index') }}" class="{{ isActiveRoute(2,'formulations') }} ml-3">Formulaciones</a></li>
        <li><a href="{{ route('manufacturing.production-orders.index') }}" class="{{ isActiveRoute(2,'production-orders') }} ml-3">Orden de Producción</a></li>

        <li class="navigation-divider m-0 text-light font-weight-bold">Empaquetamiento</li>
        <li><a href="{{ route('manufacturing.presentations.index') }}" class="{{ isActiveRoute(2,'presentations') }} ml-3">Presentaciones</a></li>
        <li><a href="{{ route('manufacturing.packages.index') }}" class="{{ isActiveRoute(2,'packages') }} ml-3">Orden de Empaque</a></li>

        <li class="navigation-divider m-0 text-light font-weight-bold">General</li>
        <li><a href="{{ route('manufacturing.mixers.index') }}" class="{{ isActiveRoute(2,'mixers') }} ml-3">Mezcladores</a></li>
        <li><a href="{{ route('manufacturing.balances.index') }}" class="{{ isActiveRoute(2,'balances') }} ml-3">Balanzas</a></li>
    </ul>
</div>
