<div id="settings"  class="{{ isOpenRoute(2,'users') }} || {{ isOpenRoute(2,'roles') }} ||
                        {{ isOpenRoute(2,'permissions') }} || {{ isOpenRoute(2,'my-profile') }} ||
                        {{ isOpenRoute(2,'company') }} || {{ isOpenRoute(2,'payment-terms') }} ||
                        {{ isOpenRoute(2,'currencies') }} || {{ isOpenRoute(2,'sequences') }}">
    <ul>
        <li class="navigation-divider">Configuraciones</li>
        @can('Usuarios')
            <li><a href="{{ route('setup.users.index') }}" class="{{ isActiveRoute(2,'users') }}">Usuarios</a></li>
        @endcan
        @can('Roles')
            <li><a href="{{ route('setup.roles.index') }}" class="{{ isActiveRoute(2,'roles') }}">Roles</a></li>
        @endcan
        @hasanyrole('SuperAdmin')
        <li><a href="{{ route('setup.permissions.index') }}" class="{{ isActiveRoute(2,'permissions') }}">Permisos</a></li>
        @endhasanyrole

        <li><a href="{{ route('setup.my-profile.show',$userCurrent) }}" class="{{isActiveRoute(2,'my-profile')}}" >Mi cuenta</a></li>
        @if ($userCurrent->isAdmin())
            <li><a href="{{ route('setup.company.show',$userCurrent->company->id) }}" class="{{isActiveRoute(2,'company')}}" >Empresa</a></li>
        @endif
        <li><a href="{{ route('setup.payment-terms.index') }}" class="{{isActiveRoute(2,'payment-terms')}}">Condiciones pago</a></li>
        <li><a href="{{ route('setup.currencies.index') }}" class="{{isActiveRoute(2,'currencies')}}">Monedas</a></li>
        <li><a href="{{ route('setup.sequences.index') }}" class="{{isActiveRoute(2,'sequences')}}">Series Documentos</a></li>
        <li><a href="" class="">Conclomerado</a></li>
    </ul>
</div>
