<?php

namespace App\Http\Controllers;
use App\Models\GuiaRemision;
use Carbon\Carbon;
use ZipArchive;


class TestController extends Controller
{
    public function __invoke()
    {
        $guia = GuiaRemision::find(1);

        $carpetaxml = "xml/";
        $carpetacdr = "cdr/";

        $emisor = array(
            "tipo_documento" => 6,
            "ruc" => $guia->supplier_ruc,
            "razon_social" => $guia->supplier_name,
            "nombre_comercial" => $guia->supplier_name,
            "departamento" => "LIMA",
            "provincia" => "LIMA",
            "distrito" => "LIMA",
            "direccion" => $guia->supplier_address,
            "ubigeo" => "140101",
            "usuario_emisor" => "MODDATOS",
            "clave_emisor" => "MODDATOS"
        );

        $cliente = array(
            "tipo_documento" => "6",
            "ruc" => $guia->customer->ruc,
            "razon_social" => $guia->customer->name,
            "direccion" => $guia->address
        );

        $cabecera = array(
            "tipo_comprobante" => "09",
            "serie"           => "T001",
            "correlativo"     => $guia->document_id,
            "fecha_emision"   => Carbon::parse($guia->delivery_date)->format('Y-m-d')
        );

        $nombrexml = $emisor['ruc']."-".$cabecera['tipo_comprobante']."-".$cabecera['serie']."-".$cabecera['correlativo'];


        $doc = new \DOMDocument();
        $doc->formatOutput = FALSE;
        $doc->preserveWhiteSpace = TRUE;
        $doc->encoding = 'utf-8';

        $xml = '<?xml version="1.0" encoding="utf-8"?>
<DespatchAdvice xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:ccts="urn:un:unece:uncefact:documentation:2" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:sac="urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1" xmlns="urn:oasis:names:specification:ubl:schema:xsd:DespatchAdvice-2">
    <ext:UBLExtensions>
        <ext:UBLExtension>
            <ext:ExtensionContent/>
        </ext:UBLExtension>
    </ext:UBLExtensions>
    <cbc:UBLVersionID>2.1</cbc:UBLVersionID>
    <cbc:CustomizationID>1.0</cbc:CustomizationID>
    <cbc:ID>'.$cabecera['serie'].'-'.$cabecera['correlativo'].'</cbc:ID>
    <cbc:IssueDate>'.$cabecera['fecha_emision'].'</cbc:IssueDate>
    <cbc:IssueTime>00:00:00</cbc:IssueTime>
    <cbc:DespatchAdviceTypeCode>'.$cabecera['tipo_comprobante'].'</cbc:DespatchAdviceTypeCode>
    <cbc:Note>--</cbc:Note>
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
            <cbc:HandlingCode>01</cbc:HandlingCode>
            <cbc:Information>VENTA</cbc:Information>
            <cbc:GrossWeightMeasure unitCode="KGM">'.$guia->weight.'</cbc:GrossWeightMeasure>
            <cac:ShipmentStage>
                <cbc:TransportModeCode>'.$guia->transporte->code.'</cbc:TransportModeCode>
                <cac:TransitPeriod>
                    <cbc:StartDate>'.Carbon::parse($guia->delivery_date)->format('Y-m-d').'</cbc:StartDate>
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
        $xml.='</cac:ShipmentStage>
            <cac:Delivery>
                <cac:DeliveryAddress>
                    <cbc:ID>140306</cbc:ID>
                    <cbc:StreetName>'.$guia->customer->address.'</cbc:StreetName>
                </cac:DeliveryAddress>
            </cac:Delivery>

            <cac:OriginAddress>
                        <cbc:ID>140306</cbc:ID>
                        <cbc:StreetName>'.$guia->supplier_address.'</cbc:StreetName>
            </cac:OriginAddress>
        </cac:Shipment>';

        foreach($guia->items as $k => $gitem){
            $xml.='<cac:DespatchLine>
            <cbc:ID>'.($k+1).'</cbc:ID>
            <cbc:DeliveredQuantity unitCode="'.$gitem->item->unit.'">'.$gitem->quantity.'</cbc:DeliveredQuantity>
            <cac:OrderLineReference>
                <cbc:LineID>'.($k+1).'</cbc:LineID>
            </cac:OrderLineReference>
            <cac:Item>
                <cbc:Name>'.$gitem->item->name.'</cbc:Name>
                <cac:SellersItemIdentification>
                    <cbc:ID>'.$gitem->item->code.'</cbc:ID>
                </cac:SellersItemIdentification>
            </cac:Item>
        </cac:DespatchLine>';
        }
        $xml.='</DespatchAdvice>';

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
        $ws = "https://e-beta.sunat.gob.pe/ol-ti-itemision-guia-gem-beta/billService";
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
                $objCdrXML = new \DOMDocument();
                $rutacdr = $carpetacdr.'R-'.$nombrexml.'/R-'.$nombrexml.'.XML';
                $objCdrXML->loadXML(file_get_contents($rutacdr));
                $mensaje = $objCdrXML->getElementsByTagName('Description')->item(0)->nodeValue;
                echo "<br/> <b>".$mensaje."</b></br>";

                $receptor = $objCdrXML->getElementsByTagName('DocumentResponse')->item(0)
                    ->getElementsByTagName("RecipientParty")->item(0)
                    ->getElementsByTagName("ID")->item(0)->nodeValue;

                echo "<br/> <b>".$receptor."</b></br>";
                echo "GUÍA ENVIADA CORRECTAMENTE";
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



}
