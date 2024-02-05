@php
    /**
    * @var stdClass $trackingCodes
    */

    $utm_aw = request()->input();
    $utm_an = request()->input();


    $gaScript = $trackingCodes->ga4Code ?? request()->input('utm_an', $trackingCodes->awCode);
    $ga = request()->input('utm_an', $trackingCodes->gaCode);


    foreach ($utm_aw as $key => $value) {
        if (
            $key === 'utm_aw'
            || strpos($key, 'utm_an') !== false
            || strpos($key, 'utm_pix') !== false
        ) {
            unset($utm_aw[$key]);
        }
    }

    foreach ($utm_an as $key => $value) {
        if (
            $key === 'utm_an'
            || strpos($key, 'utm_aw') !== false
            || strpos($key, 'utm_pix') !== false
        ) {
            unset($utm_an[$key]);
        }
    }
@endphp


<script async src="https://www.googletagmanager.com/gtag/js?id={{$gaScript}}"></script>
<script>
    window.dataLayer = window.dataLayer || []

    function gtag () {dataLayer.push(arguments)}

    gtag('js', new Date())
    gtag('config', '{{$trackingCodes->awCode}}')

    @php
        if ($trackingCodes->awCodeRem) {
            echo "gtag('config', '$trackingCodes->awCodeRem');\n";
        }

        if ($trackingCodes->ga4Code) {
            echo "gtag('config', '$trackingCodes->ga4Code', {anonymize_ip: true});\n";
        }

        if (request()->input('utm_aw_1')) {
            foreach ($utm_aw as $key => $value) {
                $value = explode('/', $value);
                echo sprintf("gtag('config', '%s');\n", $value[0]);
            }
        }
    @endphp
    gtag('config', '{{$ga}}', {anonymize_ip: true})


    @php
        if (request()->input('utm_an_1')) {
            foreach ($utm_an as $key => $value) {
                echo 'gtag(\'config\', \'' . $value . '\');';
            }
        }
    @endphp
</script>
