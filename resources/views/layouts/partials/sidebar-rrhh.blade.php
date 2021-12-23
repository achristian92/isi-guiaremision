<div id="rrhh" class="{{ isOpenRoute(2,'employees') }} || {{ isOpenRoute(2,'payrolls') }}">
    <ul>
        <li class="navigation-divider text-center">RRHH</li>
        <hr class="mt-0">
        <li class="navigation-divider m-0 text-light font-weight-bold">RRHH</li>
        <li><a href="{{ route('rrhh.employees.index') }}" class="{{ isActiveRoute(2,'employees') }}">Empleados</a></li>
        <li><a href="{{ route('rrhh.payrolls.index') }}" class="{{ isActiveRoute(2,'payrolls') }}">Nóminas</a></li>
    </ul>
</div>
