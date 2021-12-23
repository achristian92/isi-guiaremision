@extends('layouts.app')
@section('content')
    @include('components.header-body',['title' => 'Guía de Remisión'])
    @include('components.errors-and-messages')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h3>
                        <a class="btn btn-sm alert-success" title="Pedidos a Proveedores">
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                        <span style="color: #cccccc;">/</span>
                        Cliente
                        <span class="lead well well-sm">
                            <a href="" class="btn-link text-info" title=" Ir a la Ficha del Proveedor " target="_blank">
                                <u>{{ $guia->customer->name }}</u>
                            </a>
                       </span>
                        {{ $guia->document_reference }}
                    </h3>
                </div>
                <div class="col text-right">
                    @if($guia->estado_sunat == '1')
                    <a href="{{ $guia->name_xml }}" target="_blank" class="btn btn-outline-light btn-sm mr-2" title="Exportar Guía Despacho en PDF">
                        <small><i data-feather="download" class="mr-2"></i>XML</small>
                    </a>
                    <a href="/{{ $guia->src_cdr }}" target="_blank" class="btn btn-outline-light btn-sm mr-2" title="Exportar Guía Despacho en PDF">
                        <small><i data-feather="download" class="mr-2"></i>CDR</small>
                    </a>
                    @endif
                    <a href="{{ route('guiaremision.pdf',$guia->id) }}" class="btn btn-outline-light btn-sm mr-2" title="Exportar Guía Despacho en PDF">
                        <small><i data-feather="download" class="mr-2"></i>Guía</small>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">

                <span class="badge bg-secondary-bright btn-sm" title="Fecha de Envío">
                    {{ abi_date_short($guia->delivery_date) }}
                </span>
                <span class="badge bg-primary-bright btn-sm" title="Fecha de Envío">
                    {{ $guia->transporte->description }}
                </span>

                </div>

            </div>
            <hr>
            <ul class="nav nav-tabs mb-3" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab"
                       aria-controls="home" aria-selected="true">Datos de cabecera</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#items" role="tab"
                       aria-controls="items" aria-selected="false">Productos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="receive-units-tab" data-toggle="tab" href="#referral" role="tab"
                       aria-controls="receive-units" aria-selected="false">Transporte</a>
                </li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @include('guiaremision.partials.header_data')
                </div>
                <div class="tab-pane fade show active" id="items" role="tabpanel" aria-labelledby="profile-tab">
                    @if($guia->estado_sunat == '1')
                        <a href=""  class="btn btn-sm btn-primary mb-4 text-white">Enviado</a>
                    @else
                        <a href="{{ route('guiaremision.sunat',$guia->id) }}"  class="btn btn-sm btn-primary mb-4 text-white"> Enviar Sunat </a>
                    @endif

                    <form method="POST" action="{{route('guiaremision.items',$guia->id)}}">
                        @csrf
                        <div class="form-row mb-1">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Productos</label>
                                <select class="form-control form-control-sm" name="item_id" required>
                                    <option value="">Seleccionar</option>
                                    @foreach($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputEmail4">Cantidad</label>
                                @include('components.input-number-sm',['name' => 'quantity', 'required' => true])
                            </div>
                            <div class="form-group col-md-4" style="margin-top: 30px">
                                <button type="submit" class="btn btn-sm btn-dark"> Agregar </button>
                            </div>

                        </div>
                    </form>
                    <div class="table-responsive table-size-12">
                        <table class="table table-striped mb-0">
                            <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Código</th>
                                <th>Unidad</th>
                                <th class="text-center">Cantidad</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($guia->items as $gitem)
                                <tr>
                                    <td class="text-primary">{{ $gitem->item->name }}</td>
                                    <td>{{ $gitem->item->code }}</td>
                                    <td>{{ $gitem->item->unit }}</td>
                                    <td class="text-right">{{ $gitem->quantity }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="referral" role="tabpanel" aria-labelledby="referral-tab">
                    <form method="POST" action="{{route('guiaremision.transporte',$guia->id)}}">
                        @csrf
                        @if ($guia->modality_id == '1')
                            <div class="form-row mb-1">
                                <div class="form-group col-md-3">
                                    <label for="inputEmail4">RUC Transportista</label>
                                    <input type="text" name="trans_ruc_pub" class="form-control form-control-sm"
                                           value="{{ $guia->trans_ruc_pub }}" required/>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputEmail4">Tipo Documento</label>
                                    <select class="form-control form-control-sm" name="trans_type_doc_pub" required>
                                        <option value="1" selected>RUC</option>
                                        <option value="2">DNI</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="inputEmail4">Razón Social o nombre</label>
                                    <input type="text" name="trans_razon_name_pub" class="form-control form-control-sm"
                                           value="{{ $guia->trans_razon_name_pub }}" required/>
                                </div>
                                <div class="form-group col-md-3" style="margin-top: 30px">
                                    <button type="submit" class="btn btn-sm btn-primary"> Guardar </button>
                                </div>
                            </div>
                        @else
                            <div class="form-row mb-1">
                                <div class="form-group col-md-3">
                                    <label for="inputEmail4">Nro Placa</label>
                                    <input type="text" name="trans_placa_pri" class="form-control form-control-sm"
                                           value="{{ $guia->trans_placa_pri }}" required/>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputEmail4">Tipo Documento</label>
                                    <select class="form-control form-control-sm" name="trans_type_doc_priv" required>
                                        <option value="1">RUC</option>
                                        <option value="2" selected>DNI</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputEmail4">Nro DNI</label>
                                    <input type="text" name="trans_nro_doc_priv" class="form-control form-control-sm"
                                           value="{{ $guia->trans_nro_doc_priv }}" required/>
                                </div>

                                <div class="form-group col-md-3" style="margin-top: 30px">
                                    <button type="submit" class="btn btn-sm btn-primary"> Guardar </button>
                                </div>
                            </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
