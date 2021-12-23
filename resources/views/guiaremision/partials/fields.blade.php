@csrf
<div class="form-row mb-1">
    <div class="form-group col-md-4">
        <label for="inputEmail4">Cliente</label>
        <select class="form-control form-control-sm" name="customer_id">
            <option value="">Seleccionar</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" {{ old('customer_id', $model->customer_id === $customer->id ? 'selected' : '') }}>{{ $customer->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="inputEmail4">Motivo</label>
        <select class="form-control form-control-sm" name="reason_id">
            <option value="">Seleccionar</option>
            @foreach($motivos as $motivo)
                <option value="{{ $motivo->id }}" {{ old('reason_id', $model->reason_id === $motivo->id ? 'selected' : '') }}>{{ $motivo->description }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="inputEmail4">Fecha envio</label>
        @include('components.input-date-sm',['name' => 'delivery_date'])
    </div>

</div>
<div class="form-row mb-1">
    <div class="form-group col-md-4">
        <label for="inputEmail4">Modalidad</label>
        <select class="form-control form-control-sm" name="modality_id">
            <option value="">Seleccionar</option>
            @foreach($transportes as $transporte)
                <option value="{{ $transporte->id }}" {{ old('modality_id', $model->modality_id === $transporte->id ? 'selected' : '') }}>{{ $transporte->description }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="inputEmail4">Descripción</label>
        @include('components.input-sm',['name' => 'description'])
    </div>
    <div class="form-group col-md-4">
        <label>Peso Bruto Total(KGM)</label>
        <input type="number" name="weight" class="form-control form-control-sm" value="1" />
    </div>
</div>
<br>
<button type="submit" class="btn btn-sm btn-primary"> Continuar </button>
<a href="{{ $back }}" class="btn btn-sm btn-outline-light ml-2"> Regresar </a>
