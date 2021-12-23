<?php

namespace App\Http\Controllers;
use ZipArchive;

class Test2Controller extends Controller
{
    public function __invoke()
    {
        $carpetaxml = "xml/";
        $carpetacdr = "cdr/";

        $emisor = array(
            "tipo_documento" => 6,
            "ruc" => "20607599727",
            "razon_social" => "INSTITUTO INTERNACIONAL DE SOFTWARE S.A.C.",
            "nombre_comercial" => "ACADEMIA DE SOFTWARE",
            "departamento" => "LAMBAYEQUE",
            "provincia" => "CHICLAYO",
            "distrito" => "CHICLAYO",
            "direccion" => "CALLE OCHO DE OCTUBRE 123",
            "ubigeo" => "140101",
            "usuario_emisor" => "MODDATOS",
            "clave_emisor" => "MODDATOS"
        );

        $cliente = array(
            "tipo_documento" => "6",
            "ruc" => "20605145648",
            "razon_social" => "AGROINVERSIONES Y SERVICIOS AJINOR S.R.L. - AGROSERVIS AJINOR S.R.L.",
            "direccion" => "MZA. C LOTE. 46 URB. SAN ISIDRO LA LIBERTAD - TRUJILLO - TRUJILLO"
        );

        $cabecera = array(
            "tipo_operacion"  => "0101",
            "tipo_comprobante" => "01",
            "moneda"          => "PEN",
            "serie"           => "F001",
            "correlativo"     => 333,
            "total_op_gravadas" => 50.17,
            "igv"          => 9.03,
            "icbper"       => 0.30,
            "total_op_exoneradas"=> 140.00,
            "total_op_inafectas" => 270.00,
            "total_antes_impuestos" => 460.17,
            "total_impuestos"    => 9.33,
            "total_despues_impuestos"=> 469.50,
            "total_a_pagar"      =>469.50,
            "fecha_emision"      =>"2021-08-24",
            "hora_emision"    =>"19:43:00",
            "fecha_vencimiento" =>"2021-08-24",
            "forma_pago"      => "Credito",
            "monto_credito"   => 200.00,
            "anexo_sucursal"  => "0000"
        );

        $cuotas = array();

        $cuotas[] = array(
            "numero"    => "001",
            "importe"   => 150.00,
            "vencimiento"=> "2021-10-30"
        );

        $cuotas[] = array(
            "numero"    => "002",
            "importe"   => 50.00,
            "vencimiento"=> "2021-11-30"
        );


        $items =array();

        $items[] = array(
            "item"   => 1,
            "cantidad"   => 1,
            "unidad"   => "NIU",
            "nombre" => "MOCHILA",
            "valor_unitario" => 50.00,
            "precio_lista" => 59.00,
            "valor_total" => 50.00,
            "igv"  => 9.00,
            "icbper"  => 0.00,
            "factor_icbper"   => 0.30,
            "total_antes_impuestos" => 50.00,
            "total_impuestos" => 9.00,
            "codigos" => array("S","10","1000","IGV","VAT")
        );

        $items[] = array(
            "item"   => 2,
            "cantidad"   => 2,
            "unidad"   => "NIU",
            "nombre" => "LIBRO COQUITO",
            "valor_unitario" => 70.00,
            "precio_lista" => 70.00,
            "valor_total" => 140.00,
            "igv"  => 0.00,
            "icbper"  => 0.00,
            "factor_icbper"   => 0.30,
            "total_antes_impuestos" => 140.00,
            "total_impuestos" => 0.00,
            "codigos" => array("E","20","9997","EXO","VAT")
        );

        $items[] = array(
            "item"   => 3,
            "cantidad"   => 3,
            "unidad"   => "NIU",
            "nombre" => "MANZANA",
            "valor_unitario" => 90.00,
            "precio_lista" => 90.00,
            "valor_total" => 270.00,
            "igv"  => 0.00,
            "icbper"  => 0.00,
            "factor_icbper"   => 0.30,
            "total_antes_impuestos" => 270.00,
            "total_impuestos" => 0.00,
            "codigos" => array("O","30","9998","INA","FRE")
        );

        $items[] = array(
            "item"   => 4,
            "cantidad"   => 1,
            "unidad"   => "NIU",
            "nombre" => "BOLSA PLÁSTICA",
            "valor_unitario" => 0.17,
            "precio_lista" => 0.50,
            "valor_total" => 0.17,
            "igv"  => 0.03,
            "icbper"  => 0.30,
            "factor_icbper"   => 0.30,
            "total_antes_impuestos" => 0.17,
            "total_impuestos" => 0.33,
            "codigos" => array("S","10","1000","IGV","VAT")
        );


        $nombrexml = $emisor['ruc']."-".$cabecera['tipo_comprobante']."-".$cabecera['serie']."-".$cabecera['correlativo'];


        $doc = new \DOMDocument();
        $doc->formatOutput = FALSE;
        $doc->preserveWhiteSpace = TRUE;
        $doc->encoding = 'utf-8';

        $xml = '<?xml version="1.0" encoding="utf-8"?>
<Invoice xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ccts="urn:un:unece:uncefact:documentation:2" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2">
   <ext:UBLExtensions>
      <ext:UBLExtension>
         <ext:ExtensionContent/>
      </ext:UBLExtension>
   </ext:UBLExtensions>
   <cbc:UBLVersionID>2.1</cbc:UBLVersionID>
   <cbc:CustomizationID schemeAgencyName="PE:SUNAT">2.0</cbc:CustomizationID>
   <cbc:ProfileID schemeName="Tipo de Operacion" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo17">'.$cabecera['tipo_operacion'].'</cbc:ProfileID>
   <cbc:ID>'.$cabecera['serie'].'-'.$cabecera['correlativo'].'</cbc:ID>
   <cbc:IssueDate>'.$cabecera['fecha_emision'].'</cbc:IssueDate>
   <cbc:IssueTime>'.$cabecera['hora_emision'].'</cbc:IssueTime>
   <cbc:DueDate>'.$cabecera['fecha_vencimiento'].'</cbc:DueDate>
   <cbc:InvoiceTypeCode listAgencyName="PE:SUNAT" listName="Tipo de Documento" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo01" listID="0101" name="Tipo de Operacion">'.$cabecera['tipo_comprobante'].'</cbc:InvoiceTypeCode>
   <cbc:DocumentCurrencyCode listID="ISO 4217 Alpha" listName="Currency" listAgencyName="United Nations Economic Commission for Europe">'.$cabecera['moneda'].'</cbc:DocumentCurrencyCode>
            <cbc:LineCountNumeric>'.count($items).'</cbc:LineCountNumeric>
    <cac:Signature>
      <cbc:ID>'.$cabecera['serie'].'-'.$cabecera['correlativo'].'</cbc:ID>
      <cac:SignatoryParty>
         <cac:PartyIdentification>
            <cbc:ID>'.$emisor['ruc'].'</cbc:ID>
         </cac:PartyIdentification>
         <cac:PartyName>
            <cbc:Name><![CDATA['.$emisor['razon_social'].']]></cbc:Name>
         </cac:PartyName>
      </cac:SignatoryParty>
      <cac:DigitalSignatureAttachment>
         <cac:ExternalReference>
            <cbc:URI>#SignatureSP</cbc:URI>
         </cac:ExternalReference>
      </cac:DigitalSignatureAttachment>
   </cac:Signature>
   <cac:AccountingSupplierParty>
      <cac:Party>
         <cac:PartyIdentification>
            <cbc:ID schemeID="'.$emisor['tipo_documento'].'" schemeName="Documento de Identidad" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">'.$emisor['ruc'].'</cbc:ID>
         </cac:PartyIdentification>
         <cac:PartyName>
            <cbc:Name><![CDATA['.$emisor['razon_social'].']]></cbc:Name>
         </cac:PartyName>
         <cac:PartyTaxScheme>
            <cbc:RegistrationName><![CDATA['.$emisor['razon_social'].']]></cbc:RegistrationName>
            <cbc:CompanyID schemeID="'.$emisor['tipo_documento'].'" schemeName="SUNAT:Identificador de Documento de Identidad" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">'.$emisor['ruc'].'</cbc:CompanyID>
            <cac:TaxScheme>
               <cbc:ID schemeID="'.$emisor['tipo_documento'].'" schemeName="SUNAT:Identificador de Documento de Identidad" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">'.$emisor['ruc'].'</cbc:ID>
            </cac:TaxScheme>
         </cac:PartyTaxScheme>
         <cac:PartyLegalEntity>
            <cbc:RegistrationName><![CDATA['.$emisor['razon_social'].']]></cbc:RegistrationName>
            <cac:RegistrationAddress>
               <cbc:ID schemeName="Ubigeos" schemeAgencyName="PE:INEI">'.$emisor['ubigeo'].'</cbc:ID>
               <cbc:AddressTypeCode listAgencyName="PE:SUNAT" listName="Establecimientos anexos">'.$cabecera['anexo_sucursal'].'</cbc:AddressTypeCode>
               <cbc:CityName><![CDATA['.$emisor['provincia'].']]></cbc:CityName>
               <cbc:CountrySubentity><![CDATA['.$emisor['departamento'].']]></cbc:CountrySubentity>
               <cbc:District><![CDATA['.$emisor['distrito'].']]></cbc:District>
               <cac:AddressLine>
                  <cbc:Line><![CDATA['.$emisor['direccion'].']]></cbc:Line>
               </cac:AddressLine>
               <cac:Country>
                  <cbc:IdentificationCode listID="ISO 3166-1" listAgencyName="United Nations Economic Commission for Europe" listName="Country">PE</cbc:IdentificationCode>
               </cac:Country>
            </cac:RegistrationAddress>
         </cac:PartyLegalEntity>
         <cac:Contact>
            <cbc:Name><![CDATA[]]></cbc:Name>
         </cac:Contact>
      </cac:Party>
   </cac:AccountingSupplierParty>
   <cac:AccountingCustomerParty>
      <cac:Party>
         <cac:PartyIdentification>
            <cbc:ID schemeID="'.$cliente['tipo_documento'].'" schemeName="Documento de Identidad" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">'.$cliente['ruc'].'</cbc:ID>
         </cac:PartyIdentification>
         <cac:PartyName>
            <cbc:Name><![CDATA['.$cliente['razon_social'].']]></cbc:Name>
         </cac:PartyName>
         <cac:PartyTaxScheme>
            <cbc:RegistrationName><![CDATA['.$cliente['razon_social'].']]></cbc:RegistrationName>
            <cbc:CompanyID schemeID="'.$cliente['tipo_documento'].'" schemeName="SUNAT:Identificador de Documento de Identidad" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">'.$cliente['ruc'].'</cbc:CompanyID>
            <cac:TaxScheme>
               <cbc:ID schemeID="'.$cliente['tipo_documento'].'" schemeName="SUNAT:Identificador de Documento de Identidad" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">'.$cliente['ruc'].'</cbc:ID>
            </cac:TaxScheme>
         </cac:PartyTaxScheme>
         <cac:PartyLegalEntity>
            <cbc:RegistrationName><![CDATA['.$cliente['razon_social'].']]></cbc:RegistrationName>
            <cac:RegistrationAddress>
               <cbc:ID schemeName="Ubigeos" schemeAgencyName="PE:INEI"/>
               <cbc:CityName><![CDATA[]]></cbc:CityName>
               <cbc:CountrySubentity><![CDATA[]]></cbc:CountrySubentity>
               <cbc:District><![CDATA[]]></cbc:District>
               <cac:AddressLine>
                  <cbc:Line><![CDATA['.$cliente['direccion'].']]></cbc:Line>
               </cac:AddressLine>
               <cac:Country>
                  <cbc:IdentificationCode listID="ISO 3166-1" listAgencyName="United Nations Economic Commission for Europe" listName="Country"/>
               </cac:Country>
            </cac:RegistrationAddress>
         </cac:PartyLegalEntity>
      </cac:Party>
   </cac:AccountingCustomerParty>';

        $xml.='<cac:PaymentTerms>
      <cbc:ID>FormaPago</cbc:ID>
      <cbc:PaymentMeansID>'.$cabecera['forma_pago'].'</cbc:PaymentMeansID>
      <cbc:Amount currencyID="PEN">'.$cabecera['monto_credito'].'</cbc:Amount>
   </cac:PaymentTerms>';


        foreach ($cuotas as $k => $v) {
            $xml.='<cac:PaymentTerms>
                  <cbc:ID>FormaPago</cbc:ID>
                  <cbc:PaymentMeansID>Cuota'.$v['numero'].'</cbc:PaymentMeansID>
                  <cbc:Amount currencyID="PEN">'.$v['importe'].'</cbc:Amount>
                  <cbc:PaymentDueDate>'.$v['vencimiento'].'</cbc:PaymentDueDate>
            </cac:PaymentTerms>
            ';
        }

        $xml.='<cac:TaxTotal>
      <cbc:TaxAmount currencyID="'.$cabecera['moneda'].'">'.$cabecera['total_impuestos'].'</cbc:TaxAmount>
      <cac:TaxSubtotal>
         <cbc:TaxableAmount currencyID="'.$cabecera['moneda'].'">'.$cabecera['total_op_gravadas'].'</cbc:TaxableAmount>
         <cbc:TaxAmount currencyID="'.$cabecera['moneda'].'">'.$cabecera['igv'].'</cbc:TaxAmount>
         <cac:TaxCategory>
            <cbc:ID schemeID="UN/ECE 5305" schemeName="Tax Category Identifier" schemeAgencyName="United Nations Economic Commission for Europe">S</cbc:ID>
            <cac:TaxScheme>
               <cbc:ID schemeID="UN/ECE 5153" schemeAgencyID="6">1000</cbc:ID>
               <cbc:Name>IGV</cbc:Name>
               <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
            </cac:TaxScheme>
         </cac:TaxCategory>
      </cac:TaxSubtotal>';

        if($cabecera['total_op_exoneradas']>0){
            $xml.='<cac:TaxSubtotal>
         <cbc:TaxableAmount currencyID="'.$cabecera['moneda'].'">'.$cabecera['total_op_exoneradas'].'</cbc:TaxableAmount>
         <cbc:TaxAmount currencyID="'.$cabecera['moneda'].'">0.00</cbc:TaxAmount>
         <cac:TaxCategory>
            <cbc:ID schemeID="UN/ECE 5305" schemeName="Tax Category Identifier" schemeAgencyName="United Nations Economic Commission for Europe">E</cbc:ID>
            <cac:TaxScheme>
               <cbc:ID schemeID="UN/ECE 5153" schemeAgencyID="6">9997</cbc:ID>
               <cbc:Name>EXO</cbc:Name>
               <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
            </cac:TaxScheme>
         </cac:TaxCategory>
      </cac:TaxSubtotal>';
        }

        if($cabecera['total_op_inafectas']>0){
            $xml.='<cac:TaxSubtotal>
         <cbc:TaxableAmount currencyID="'.$cabecera['moneda'].'">'.$cabecera['total_op_inafectas'].'</cbc:TaxableAmount>
         <cbc:TaxAmount currencyID="'.$cabecera['moneda'].'">0.00</cbc:TaxAmount>
         <cac:TaxCategory>
            <cbc:ID schemeID="UN/ECE 5305" schemeName="Tax Category Identifier" schemeAgencyName="United Nations Economic Commission for Europe">O</cbc:ID>
            <cac:TaxScheme>
               <cbc:ID schemeID="UN/ECE 5153" schemeAgencyID="6">9998</cbc:ID>
               <cbc:Name>INA</cbc:Name>
               <cbc:TaxTypeCode>FRE</cbc:TaxTypeCode>
            </cac:TaxScheme>
         </cac:TaxCategory>
      </cac:TaxSubtotal>';
        }


        if($cabecera['icbper']>0){
            $xml.='<cac:TaxSubtotal>
         <cbc:TaxAmount currencyID="'.$cabecera['moneda'].'">'.$cabecera['icbper'].'</cbc:TaxAmount>
         <cac:TaxCategory>
            <cac:TaxScheme>
               <cbc:ID schemeID="UN/ECE 5153" schemeAgencyID="6">7152</cbc:ID>
               <cbc:Name>ICBPER</cbc:Name>
               <cbc:TaxTypeCode>OTH</cbc:TaxTypeCode>
            </cac:TaxScheme>
         </cac:TaxCategory>
      </cac:TaxSubtotal>';
        }

        $xml.='</cac:TaxTotal>
   <cac:LegalMonetaryTotal>
      <cbc:LineExtensionAmount currencyID="'.$cabecera['moneda'].'">'.$cabecera['total_antes_impuestos'].'</cbc:LineExtensionAmount>
      <cbc:TaxInclusiveAmount currencyID="'.$cabecera['moneda'].'">'.$cabecera['total_despues_impuestos'].'</cbc:TaxInclusiveAmount>
      <cbc:PayableAmount currencyID="'.$cabecera['moneda'].'">'.$cabecera['total_a_pagar'].'</cbc:PayableAmount>
   </cac:LegalMonetaryTotal>';

        foreach ($items as $k=>$v){

            $xml.='<cac:InvoiceLine>
      <cbc:ID>'.$v['item'].'</cbc:ID>
      <cbc:InvoicedQuantity unitCode="'.$v['unidad'].'" unitCodeListID="UN/ECE rec 20" unitCodeListAgencyName="United Nations Economic Commission for Europe">'.$v['cantidad'].'</cbc:InvoicedQuantity>
      <cbc:LineExtensionAmount currencyID="'.$cabecera['moneda'].'">'.$v['total_antes_impuestos'].'</cbc:LineExtensionAmount>
      <cac:PricingReference>
         <cac:AlternativeConditionPrice>
            <cbc:PriceAmount currencyID="'.$cabecera['moneda'].'">'.$v['precio_lista'].'</cbc:PriceAmount>
            <cbc:PriceTypeCode listName="Tipo de Precio" listAgencyName="PE:SUNAT" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo16">01</cbc:PriceTypeCode>
         </cac:AlternativeConditionPrice>
      </cac:PricingReference>
      <cac:TaxTotal>
         <cbc:TaxAmount currencyID="'.$cabecera['moneda'].'">'.$v['total_impuestos'].'</cbc:TaxAmount>
         <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID="'.$cabecera['moneda'].'">'.$v['valor_total'].'</cbc:TaxableAmount>
            <cbc:TaxAmount currencyID="'.$cabecera['moneda'].'">'.$v['igv'].'</cbc:TaxAmount>
            <cac:TaxCategory>
               <cbc:ID schemeID="UN/ECE 5305" schemeName="Tax Category Identifier" schemeAgencyName="United Nations Economic Commission for Europe">'.$v['codigos'][0].'</cbc:ID>
               <cbc:Percent>18</cbc:Percent>
               <cbc:TaxExemptionReasonCode listAgencyName="PE:SUNAT" listName="Afectacion del IGV" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo07">'.$v['codigos'][1].'</cbc:TaxExemptionReasonCode>
               <cac:TaxScheme>
                  <cbc:ID schemeID="UN/ECE 5153" schemeName="Codigo de tributos" schemeAgencyName="PE:SUNAT">'.$v['codigos'][2].'</cbc:ID>
                  <cbc:Name>'.$v['codigos'][3].'</cbc:Name>
                  <cbc:TaxTypeCode>'.$v['codigos'][4].'</cbc:TaxTypeCode>
               </cac:TaxScheme>
            </cac:TaxCategory>
         </cac:TaxSubtotal>';

            if($v['icbper']>0){
                $xml.='<cac:TaxSubtotal>
                   <cbc:TaxAmount currencyID="'.$cabecera['moneda'].'">'.$v['icbper'].'</cbc:TaxAmount>
                   <cbc:BaseUnitMeasure unitCode="'.$v['unidad'].'">'.$v['cantidad'].'</cbc:BaseUnitMeasure>
                   <cac:TaxCategory>
                          <cbc:PerUnitAmount currencyID="'.$cabecera['moneda'].'">'.$v['factor_icbper'].'</cbc:PerUnitAmount>
                          <cac:TaxScheme>
                                <cbc:ID>7152</cbc:ID>
                                <cbc:Name>ICBPER</cbc:Name>
                                <cbc:TaxTypeCode>OTH</cbc:TaxTypeCode>
                          </cac:TaxScheme>
                   </cac:TaxCategory>
            </cac:TaxSubtotal>';
            }

            $xml.='</cac:TaxTotal>
      <cac:Item>
         <cbc:Description><![CDATA['.$v['nombre'].']]></cbc:Description>
         <cac:SellersItemIdentification>
            <cbc:ID><![CDATA[195]]></cbc:ID>
         </cac:SellersItemIdentification>
         <cac:CommodityClassification>
            <cbc:ItemClassificationCode listID="UNSPSC" listAgencyName="GS1 US" listName="Item Classification">10191509</cbc:ItemClassificationCode>
         </cac:CommodityClassification>
      </cac:Item>
      <cac:Price>
         <cbc:PriceAmount currencyID="'.$cabecera['moneda'].'">'.$v['valor_unitario'].'</cbc:PriceAmount>
      </cac:Price>
   </cac:InvoiceLine>';

        }

        $xml.='</Invoice>';

        $doc->loadXML($xml);
        $doc->save($carpetaxml.$nombrexml.'.XML');


        //PASO 02
        //FIRMAR EL XML
        require_once("signature.php");
        $objSignature = new \Signature();

        $flg_firma = "0";
        $ruta = $carpetaxml.$nombrexml.'.XML';

        $ruta_firma = "LLAMA-PE-CERTIFICADO-DEMO-1047472755.pfx";
        $pass_firma = "10229909";

        $resp = $objSignature->signature_xml($flg_firma, $ruta, $ruta_firma, $pass_firma);

        print_r($resp);

        //PASO 03
        $zip = new ZipArchive();
        $nombrezip = $nombrexml.".ZIP";
        $rutazip = $carpetaxml.$nombrexml.".ZIP";

        if($zip->open($rutazip,ZIPARCHIVE::CREATE)===true){
            $zip->addFile($carpetaxml.$nombrexml.'.XML', $nombrexml.'.XML');
            $zip->close();
        }

        //PASO 04
//PREPARAR EL ENVÍO DEL XML
        $contenido_del_zip = base64_encode(file_get_contents($rutazip));
        $xml_envio ='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
        xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.sunat.gob.pe"
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
     <soapenv:Header>
            <wsse:Security>
                <wsse:UsernameToken>
                    <wsse:Username>'.$emisor['ruc'].$emisor['usuario_emisor'].'</wsse:Username>
   <wsse:Password>'.$emisor['clave_emisor'].'</wsse:Password>
                </wsse:UsernameToken>
           </wsse:Security>
 </soapenv:Header>
 <soapenv:Body>
   <ser:sendBill>
      <fileName>'.$nombrezip.'</fileName>
      <contentFile>'.$contenido_del_zip.'</contentFile>
   </ser:sendBill>
 </soapenv:Body>
</soapenv:Envelope>';


        //PASO 05
        //ENVÍO DEL CPE A WS DE SUNAT

        $ws = "https://e-beta.sunat.gob.pe/ol-ti-itcpfegem-beta/billService";
        $header = array(
            "Content-type: text/xml; charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: ",
            "Content-lenght: ".strlen($xml_envio)
        );

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,1);
        curl_setopt($ch,CURLOPT_URL,$ws);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HTTPAUTH,CURLAUTH_ANY);
        curl_setopt($ch,CURLOPT_TIMEOUT,30);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$xml_envio);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_CAINFO, "cacert.pem");
        $response = curl_exec($ch);


        //PASO 06
        // OBTENEMOS RESPUESTA (CDR)
        $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        if($httpcode == 200){
            $doc = new \DOMDocument();
            $doc->loadXML($response);
            if(isset($doc->getElementsByTagName('applicationResponse')->item(0)->nodeValue)){
                $cdr = $doc->getElementsByTagName('applicationResponse')->item(0)->nodeValue;
                $cdr = base64_decode($cdr);
                file_put_contents($carpetacdr."R-".$nombrezip, $cdr);
                $zip = new ZipArchive;
                if($zip->open($carpetacdr."R-".$nombrezip)===true){
                    $zip->extractTo($carpetacdr.'R-'.$nombrexml);
                    $zip->close();
                }
                echo "FACTURA ENVIADA CORRECTAMENTE";
            }else{
                $codigo = $doc->getElementsByTagName("faultcode")->item(0)->nodeValue;
                $mensaje = $doc->getElementsByTagName("faultstring")->item(0)->nodeValue;
                echo "error ".$codigo.": ".$mensaje;
            }
        }else{
            echo curl_error($ch);
            echo "Problema de conexión";
        }
        curl_close($ch);


    }

    public function guia()
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
<DespatchAdvice
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"
 xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2"
  xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2"
   xmlns:ccts="urn:un:unece:uncefact:documentation:2" xmlns:ds="http://www.w3.org/2000/09/xmldsig#"
    xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2"
    xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2"
     xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2"
      xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2">
   <ext:UBLExtensions>
      <ext:UBLExtension>
         <ext:ExtensionContent/>
      </ext:UBLExtension>
   </ext:UBLExtensions>
   <cbc:UBLVersionID>2.1</cbc:UBLVersionID>
   <cbc:CustomizationID schemeAgencyName="PE:SUNAT">1.0</cbc:CustomizationID>
   <cbc:ID>'.$cabecera['serie'].'-'.$cabecera['correlativo'].'</cbc:ID>
   <cbc:IssueDate>'.$cabecera['fecha_emision'].'</cbc:IssueDate>
   <cbc:IssueTime>00:00:00</cbc:IssueTime>
   <cbc:DespatchAdviceTypeCode>'.$cabecera['tipo_comprobante'].'</cbc:DespatchAdviceTypeCode>
   <cbc:Note></cbc:Note>

    <cac:Signature>
      <cbc:ID>'.$cabecera['serie'].'-'.$cabecera['correlativo'].'</cbc:ID>
      <cac:SignatoryParty>
         <cac:PartyIdentification>
            <cbc:ID>'.$emisor['ruc'].'</cbc:ID>
         </cac:PartyIdentification>
         <cac:PartyName>
            <cbc:Name><![CDATA['.$emisor['razon_social'].']]></cbc:Name>
         </cac:PartyName>
      </cac:SignatoryParty>
      <cac:DigitalSignatureAttachment>
         <cac:ExternalReference>
            <cbc:URI>#SignatureSP</cbc:URI>
         </cac:ExternalReference>
      </cac:DigitalSignatureAttachment>
   </cac:Signature>

   <cac:DespatchSupplierParty>
        <cbc:CustomerAssignedAccountID schemeID="6">'.$emisor['ruc'].'</cbc:CustomerAssignedAccountID>
        <cac:Party>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA['.$emisor['razon_social'].']]></cbc:RegistrationName>
            </cac:PartyLegalEntity>
        </cac:Party>
   </cac:DespatchSupplierParty>

   <cac:DeliveryCustomerParty>
        <cbc:CustomerAssignedAccountID schemeID="6">'.$cliente['ruc'].'</cbc:CustomerAssignedAccountID>
        <cac:Party>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA['.$cliente['razon_social'].']]></cbc:RegistrationName>
            </cac:PartyLegalEntity>
        </cac:Party>
   </cac:DeliveryCustomerParty>

    <cac:Shipment>
        <cbc:ID>1</cbc:ID>
        <cbc:HandlingCode>'.$envio['code_motivo'].'</cbc:HandlingCode>
        <cbc:Information>'.$envio['motivo'].'</cbc:Information>
        <cbc:GrossWeightMeasure unitCode="KGM">'.$envio['peso'].'</cbc:GrossWeightMeasure>
        <cac:ShipmentStage>
            <cbc:TransportModeCode>'.$envio['code_modadidad'].'</cbc:TransportModeCode>
            <cac:TransitPeriod>
                <cbc:StartDate>'.$envio['fecha_envio'].'</cbc:StartDate>
            </cac:TransitPeriod>';
        if($guia->modality_id == '1') {
            $xml.='<cac:CarrierParty>
                    <cac:PartyIdentification>
                        <cbc:ID schemeID="6">'.$guia->trans_ruc_pub.'</cbc:ID>
                    </cac:PartyIdentification>
                    <cac:PartyName>
                        <cbc:Name>'.$guia->trans_razon_name_pub.'</cbc:Name>
                    </cac:PartyName>
                  </cac:CarrierParty>';
        } else {
            $xml.='<cac:TransportMeans>
                     <cac:RoadTransport>
                        <cbc:LicensePlateID>'.$guia->trans_placa_pri.'</cbc:LicensePlateID>
                     </cac:RoadTransport>
                   </cac:TransportMeans>';

            $xml.='<cac:DriverPerson>
                    <cbc:ID schemeID="1">'.$guia->trans_nro_doc_priv.'</cbc:ID>
                   </cac:DriverPerson>';
        }

        $xml.='
        </cac:ShipmentStage>
        <cac:Delivery>
            <cac:DeliveryAddress>
                <cbc:ID>140306</cbc:ID>
                <cbc:StreetName>'.$guia->supplier_address.'</cbc:StreetName>
            </cac:DeliveryAddress>
        </cac:Delivery>
        <cac:OriginAddress>
            <cbc:ID>140306</cbc:ID>
            <cbc:StreetName>'.$guia->customer->address.'</cbc:StreetName>
        </cac:OriginAddress>
    </cac:Shipment>';

        foreach ($guia->items as $key => $guiaitem) {
            $xml.='
            <cac:DespatchLine>
                <cbc:ID>'.($key+1).'</cbc:ID>
                <cbc:DeliveredQuantity unitCode="NIU">'.$guiaitem->quantity.'</cbc:DeliveredQuantity>
                <cac:OrderLineReference>
                    <cbc:LineID>'.($key+1).'</cbc:LineID>
                </cac:OrderLineReference>
                <cac:Item>
                    <cbc:Name>'.$guiaitem->item->name.'</cbc:Name>
                    <cac:SellersItemIdentification>
                        <cbc:ID>'.$guiaitem->item->code.'</cbc:ID>
                    </cac:SellersItemIdentification>
                </cac:Item>
            </cac:DespatchLine>
            ';
        }



        $xml.='</DespatchAdvice>';
    }

}
