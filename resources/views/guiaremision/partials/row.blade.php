<tr>
    <td>{{ $guia->document_reference }}</td>
    <td>{{ \Carbon\Carbon::parse($guia->delivery_date)->format('Y-m-d') }}</td>
    <td class="text-primary">{{ $guia->customer->name }}</td>
    <td>{{ $guia->transporte->description }}</td>
    <td>{{ $guia->items->count() }}</td>
    <td>
        @if($guia->estado_sunat == '0')
            <span class='badge badge-warning'>No Enviado</span>
        @elseif($guia->estado_sunat == '1')
            <span class='badge badge-success'>Enviado</span>
        @endif
    </td>
    <td class="text-right">
        <a href="{{ route('guiaremision.pdf',$guia->id) }}" class="btn btn-outline-light btn-sm mr-2 small"  target="_blank" title="Exportar Guía Despacho en PDF">
            <small><i data-feather="download" class="mr-2"></i>Guía</small>
        </a>
        @if($guia->estado_sunat == '1')
            <a href="/{{ $guia->src_cdr }}" class="btn btn-outline-light btn-sm mr-2"  target="_blank" title="Exportar Guía Despacho en PDF">
                <small><i data-feather="download" class="mr-2"></i>CDR</small>
            </a>
            <a href="{{ $guia->name_xml }}" class="btn btn-outline-light btn-sm mr-2"  target="_blank" title="Exportar Guía Despacho en PDF">
                <small><i data-feather="download" class="mr-2"></i>XML</small>
            </a>
        @endif
        <a href="{{ route('guiaremision.show',$guia->id) }}">
            <img src="{{ asset('img/eye.png') }}" class="ml-2" title="Editar" alt="icon edit">
        </a>
    </td>
</tr>
