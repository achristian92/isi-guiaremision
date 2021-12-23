<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label  class="text-muted">Cliente</label>
            <h6>
                <a href="" class="btn-link text-info" title=" Ir a la Ficha del Proveedor " target="_blank">
                    <u>{{ $guia->customer->name }}</u>
                </a>
            </h6>
            <small>{{ $guia->customer->address }}</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label  class="text-muted">Fecha de creación</label>
            <h6>{{ abi_date_short($guia->created_at) }}</h6>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label  class="text-muted">Motivo</label>
            <h6>{{ $guia->motivo->description }}</h6>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label  class="text-muted">Transporte</label>
            <h6>{{ $guia->transporte->description }}</h6>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label  class="text-muted"># Productos </label>
            <h6>{{ $guia->items->count() }}</h6>
        </div>
    </div>
</div>

