<div id="orders" class="
                {{ isOpenRoute(2,'orders') }} || {{ isOpenRoute(2,'despatches') }}">
    <ul>
        <li class="navigation-divider m-0 text-center">Gestión Pedidos</li>
        <hr class="mt-0">
        <li class="navigation-divider m-0 text-light font-weight-bold">Pedidos</li>
        <li class="m-0"><a href="{{ route('order.orders.index') }}" class="{{ isActiveRoute(2,'orders') }} ml-3 mb-0">Orden de Pedido</a></li>
        <li class="m-0"><a href="{{ route('order.despatches.index') }}" class="{{ isActiveRoute(2,'despatches') }} ml-3 mb-0">Guía de Despacho</a></li>
    </ul>
</div>
