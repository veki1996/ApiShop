You have the following variables available to you. Ask devs if you need others.<br/><br/>
@php
    $variables = [
        'product',
        'tosLinks',
        'tosLink',
        'orderCode',
        'trackingCodes',
        'pixels',
        'salesLink'
    ];

    foreach ($variables as $variable)
    {
        echo '$' . $variable . "<br/>";
        dump($$variable);
        echo "<br/><br/>";
    }
@endphp

<br/><br/>Use ContentHelper for containers you need

<br/><br/>Include whatever subtemplate you'll use bellow
@include("subtemplates.listicle_03.listicle_pp_03")
