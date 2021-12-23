<?php


use Carbon\Carbon;

function color_statuses($key) {
    if (! $key)
        return '';

    $colors = [
        'draft'           => 'badge badge-light',
        'confirmed'       => 'badge badge-primary',
        'canceled'        => 'badge badge-danger',
        'done'            => 'badge badge-success',
        'closed'          => 'badge badge-success',
        'unreceived'      => 'badge badge-light',
        'received'        => 'badge badge-success',
        'partialreceived' => 'badge badge-warning',
        'unpaid'          => 'badge badge-light',
        'partialpaid'     => 'badge badge-warning',
        'paid'            => 'badge badge-success',
        'unsent'          => 'badge badge-light',
        'sent'            => 'badge badge-primary',
        'pending'         => 'badge badge-warning',
        'despatch'        => 'badge badge-primary'
    ];

    return $colors[$key];
}
function truncar($numero, $digitos = 0)
{
    $truncar = 10**$digitos;
    return intval($numero * $truncar) / $truncar;
}

function l($string = NULL, $data = [], $langfile = NULL)
{
    if ( is_string($data) && ($langfile == NULL) ) {
        $langfile = $data;
        $data = [];
    }

    if (Lang::has($langfile.'.'.$string))
        return Lang::get($langfile.'.'.$string, $data);
    else
    {
        foreach ($data as $key => $value)
        {
            $string = str_replace(':'.$key, $value, $string);
        }
        return $string;
    }
}

function format_time(string $timeWorked): string
{
    $cut = explode(':',$timeWorked);
    $hour = $cut[0].' h';
    $min = $cut[1].' m';

    return "$hour $min";
}

function abi_date_short(Carbon $date = null, $format = 'd/m/Y')
{
    if (!$date) return null;
    return $date->format($format);
}

function abi_r($foo, $exit=false)
{
    echo '<pre>';
    print_r($foo);
    echo '</pre>';

    if ($exit) die();
}

function slug(string $text,$format = '_'): string
{
    if (!$text)
        return '';

    return Str::slug($text,$format);
}

function draftLink(): string
{
    return 'https://brainbox-vouchers-s3.s3.amazonaws.com/companies/sZUBeXUwP8pssyydraft.png';
}

function calcPorcentage($value,$porcentage = 0.0)
{
    if (floatval($porcentage) === 0.0)
        return 0;

    return round((($porcentage * floatval($value)) / 100),2);
}

function isOpenRoute($segmento, $route = '')
{
    request()->segment($segmento) === $route ? $route = 'open' : $route;
    return $route;
}

function isActiveRoute($segmento, $route = '')
{
    request()->segment($segmento) === $route ? $route = 'active' : $route;
    return $route;
}

if (!function_exists('_add4NumRand')) {
    function _add4NumRand(String $string = "123456")
    {
        $text_without_spaces = str_replace(' ', '', $string);
        return strtolower($text_without_spaces.rand(1000,9999));
    }
}

function companyID(): int
{
    return \Auth::user()->company->id;
}

function companyEmail(): string
{
    return \Auth::user()->company->email;
}

function formatDate(string $date = null, bool $showTime = false)
{
    if ($date === null)
        return '';

    if ($showTime)
        return Carbon::parse($date)->format('d/m/y h:i');
    else
        return Carbon::parse($date)->format('d/m/y');
}

function EventExportStyles()
{
    return [
        'TITLE'=> [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true
            ],
            'font' => [
                'bold' => true,
                'name' => 'Arial',
                'size' => 12,
                'color' => ['argb' => 'ffffff'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '292B57',
                ],
            ],
        ],
        'HEADER' => [
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            ),
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true
            ],
            'font' => [
                'bold' => true,
                'name' => 'Arial',
                'size' => 11,
                'color' => ['argb' => '434448'],
            ],
        ],
        'DATA' => [
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            ),
        ]
    ];
}

function EventExportImageLogo($coordinates = "B2")
{
    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    $drawing->setPath(public_path('/img/betagen.jpeg'));
    $drawing->setHeight(80);
    $drawing->setWidth(150);
    $drawing->setCoordinates($coordinates);

    return $drawing;
}
