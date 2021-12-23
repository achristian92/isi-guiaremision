<div id="contact" class="
                {{ isOpenRoute(2,'suppliers') }} || {{ isOpenRoute(2,'customers') }} ||
                {{ isOpenRoute(2,'supplier-types') }}">
    <ul>
        <li class="navigation-divider m-0 text-center">Gestión comercial</li>
        <hr class="mt-0">
        <li class="navigation-divider m-0 text-light font-weight-bold">Contactos</li>
        <li class="m-0"><a href="{{ route('contact.suppliers.index') }}" class="{{ isActiveRoute(2,'suppliers') }} ml-3 mb-0">Proveedores</a></li>
        <li class="m-0"><a href="{{ route('contact.customers.index') }}" class="{{ isActiveRoute(2,'customers') }} ml-3 mb-0">Clientes</a></li>
        <li class="navigation-divider m-0 text-light font-weight-bold">General</li>
        <li class="m-0"><a href="{{ route('contact.supplier-types.index') }}" class="{{ isActiveRoute(2,'supplier-types') }} ml-3 mb-0">Tipos Proveedores</a></li>
    </ul>
</div>
