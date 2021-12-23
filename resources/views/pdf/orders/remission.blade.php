<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Orden de Despacho</title>
</head>
<style type="text/css">
    html {
        font-size: 10px;
        font-family: sans-serif;
    }
    table, th, td  {
        border-collapse: collapse;
        border: 1px solid black;
    }
    td, th {
        height: 25px;
    }
    .tr-center {
        text-align: center;
    }
    .align-left {
        text-align: left;
    }
    #watermark {
        position: fixed;
        bottom:   10cm;
        left:     5.5cm;
        width:    8cm;
        height:   8cm;
        z-index:  -1000;
    }
    .title {
        font-weight: bold;
        /*font-size: 10px;*/
        background: #d0d0d0 !important;
    }
</style>
<body>
@if($guia->estado_sunat == '0')
    <div id="watermark">
        <img src="{{ draftLink() }}" height="100%" width="100%" />
    </div>
@endif

<table width="100%">
    <tr class="tr-center">
        <td width="20%">
            <img src="https://cunitech.s3.amazonaws.com/companies/isi-zuJy.png" style="object-fit: contain" alt="logo_company" height=50 width=150>
        </td>
        <td width="60%"><h3>GUÍA DE REMISIÓN</h3></td>
        <td width="20%"><strong>NRO {{ $guia->document_reference }}</strong></td>
    </tr>
</table>
<br>
<table width="100%">
    <tr class="tr-center">
        <td width="20%" class="title">ORIGEN</td>
        <td width="50%"> {{ $guia->supplier_name   }}</td>
        <td width="15%" class="title">TELÉF.</td>
        <td width="15%">939342435</td>
    </tr>
    <tr class="tr-center">
        <td width="20%" class="title">DIRECCIÓN</td>
        <td width="50%">{{ $guia->supplier_address }}</td>
        <td width="15%" class="title">R.U.C</td>
        <td width="15%">{{ $guia->supplier_ruc }}</td>
    </tr>
</table>
<br>
<table width="100%">
    <tr class="tr-center">
        <td width="20%" class="title">CLIENTE</td>
        <td width="50%"> {{ $guia->customer->name   }}</td>
        <td width="15%" class="title">FECHA DE ENVIÓ</td>
        <td width="15%">{{ abi_date_short($guia->delivery_date) }}</td>
    </tr>
    <tr class="tr-center">
        <td width="20%" class="title">DIRECCIÓN</td>
        <td width="50%">{{ $guia->customer->address }}</td>
        <td width="15%" class="title">R.U.C</td>
        <td width="15%">{{ $guia->customer->ruc }}</td>
    </tr>
</table>
<br>
<table width="100%">
    <tr class="title">
        <th width="5%">NRO</th>
        <th width="55%">DESCRIPCIÓN</th>
        <th width="20%">CÓDIGO.</th>
        <th width="10%">UNIDAD.</th>
        <th width="10%">CANT.</th>
    </tr>
    @foreach($guia->items as $key => $gitem)
        <tr class="td_data">
            <td  align="center">{{ $key+1 }}</td>
            <td style="margin-left: 10px;">{{ $gitem->item->name }}</td>
            <td>{{ $gitem->item->code }}</td>
            <td>{{ $gitem->item->unit }}</td>
            <td align="center">{{ $gitem->quantity }}</td>
        </tr>
    @endforeach
</table>
<br>
<table width="100%">
    <tr class="tr-center">
        <td width="20%" class="title">MODALIDAD</td>
        <td width="30%">{{ $guia->transporte->description }}</td>
        <td width="20%" class="title">MOTIVO</td>
        <td width="30%">{{ $guia->motivo->description }}</td>
    </tr>
    @if ($guia->modality_id == '1')
        <tr class="tr-center">
            <td width="20%" class="title">RUC TRANSPORTE</td>
            <td width="30%">{{ $guia->trans_ruc_pub }}</td>
            <td width="20%" class="title">NOMBRE TRANSPORTE</td>
            <td width="30%">RUC: {{ $guia->trans_razon_name_pub }}</td>
        </tr>
    @else
        <tr class="tr-center">
            <td width="20%" class="title">NRO PLACA</td>
            <td width="30%">{{ $guia->trans_placa_pri }}</td>
            <td width="20%" class="title">TIPO</td>
            <td width="30%">DNI : {{ $guia->trans_nro_doc_priv }}</td>
        </tr>
    @endif

</table>

</body>
</html>
