<div id="inventory" class="
        {{ isOpenRoute(2,'items') }} || {{ isOpenRoute(2,'mass-items') }}
       {{ isOpenRoute(2,'contact-info') }} || {{ isOpenRoute(2,'stock-movements') }} || {{ isOpenRoute(2,'kardex') }} ||
       {{ isOpenRoute(2,'adjustments') }} || {{ isOpenRoute(2,'stock-items') }} || {{ isOpenRoute(2,'supplier-orders') }} ||
       {{ isOpenRoute(2,'categories') }} || {{ isOpenRoute(2,'sub-categories') }} || {{ isOpenRoute(2,'brands') }} ||
       {{ isOpenRoute(2,'groups') }} || {{ isOpenRoute(2,'units') }} || {{ isOpenRoute(2,'unit-groups') }} ||
       {{ isOpenRoute(2,'movement-types') }} || {{ isOpenRoute(2,'warehouses') }}">
    <ul>
        <li class="navigation-divider m-0 text-center">Inventario</li>
        <hr class="mt-0">
        <li class="navigation-divider m-0 text-light font-weight-bold">Productos</li>
        <li class="m-0"><a href="{{ route('inventory.items.index') }}" class="{{ isActiveRoute(2,'items') }} ml-3 mb-0">Productos/Servicios</a></li>
        <li class="m-0"><a href="{{ route('inventory.mass-items.index') }}" class="{{ isActiveRoute(2,'mass-items') }} ml-3 mt-0">Carga masiva</a></li>
        <li><a href="{{ route('inventory.contact-info.index') }}" class="{{ isActiveRoute(2,'contact-info') }} ml-3">Información comercial</a></li>

        <li class="navigation-divider m-0 text-light font-weight-bold">Almacenes</li>
        <li><a href="{{ route('inventory.stock-items.index') }}" class="{{ isActiveRoute(2,'stock-items') }} ml-3">Stock productos</a></li>
        <li><a href="{{ route('inventory.stock-movements.index') }}" class="{{ isActiveRoute(2,'stock-movements') }} ml-3">Movimientos</a></li>
        <li><a href="{{ route('inventory.kardex.index') }}" class="{{ isActiveRoute(2,'kardex') }} ml-3">Kardex</a></li>
        {{--<li><a href="{{ route('inventory.adjustments.index') }}" class="{{ isActiveRoute(2,'adjustments') }} ml-3">Ajuste inventario</a></li>--}}

        <li class="navigation-divider m-0 text-light font-weight-bold">Abastecimiento</li>
        <li><a href="{{ route('inventory.supplier-orders.index') }}" class="{{ isActiveRoute(2,'supplier-orders') }} ml-3">Orden de Compra</a></li>

        <li class="navigation-divider m-0 text-light font-weight-bold">General</li>
        <li><a href="{{ route('inventory.warehouses.index') }}" class="{{ isActiveRoute(2,'warehouses') }} ml-3">Almacenes</a></li>
        <li><a href="{{ route('inventory.categories.index') }}" class="{{ isActiveRoute(2,'categories') }} ml-3">Categorías</a></li>
        <li><a href="{{ route('inventory.brands.index') }}" class="{{ isActiveRoute(2,'brands') }} ml-3">Marcas</a></li>
     {{--   <li><a href="{{ route('inventory.groups.index') }}" class="{{ isActiveRoute(2,'groups') }} ml-3">Grupo</a></li>--}}
       {{--<li><a href="{{ route('inventory.units.index') }}" class="{{ isActiveRoute(2,'units') }} {{ isActiveRoute(2,'unit-groups') }} ml-3">Unidades medida</a></li>--}}
        {{--<li><a href="{{ route('inventory.movement-types.index') }}" class="{{ isActiveRoute(2,'movement-types') }} ml-3">Tipo movimientos</a></li>--}}
    </ul>
</div>
