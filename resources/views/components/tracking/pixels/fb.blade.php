@php
    /**
    * @var stdClass $trackingCodes
    */

    $multiplePixels = request()->input('utm_pix_1');
    $utmParameters = request()->input();

    foreach ($utmParameters as $key => $parameter) {
        if (
            $key === 'utm_pix'
             || strpos($key, 'utm_an') !== false
             || strpos($key, 'utm_aw') !== false
        ) {
            unset($utmParameters[$key]);
        }
    }

    $fbInitParameters = [$trackingCodes->fbCode];

    if (request()->is('/thanks') && isset($userData))
    {
        $userData->validatedEmail = strpos(base64_decode($userData->email), '@')
            ? strtolower(base64_decode($userData->email))
            : '';

         $fbData = [
          'em' => $userData->validatedEmail,
          'fn' => strtolower(base64_decode($userData->name)),
          'ln' => strtolower(base64_decode($userData->lastName)),
          'ph' => base64_decode($userData->phone),
          'cn' => strtolower(env('COUNTRY_CODE')),
          'ct' => preg_replace('/\s/', '', base64_decode($userData->city)),
          'zp' => base64_decode($userData->zip)
        ];

        $fbInitParameters[] = json_encode($fbData);
    }
@endphp


<script>
    !function (f, b, e, v, n, t, s) {
        if (f.fbq) {
            return
        }
        n = f.fbq = function () {
            n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        }
        if (!f._fbq) {
            f._fbq = n
        }
        n.push = n
        n.loaded = !0
        n.version = '2.0'
        n.queue = []
        t = b.createElement(e)
        t.async = !0
        t.src = v
        s = b.getElementsByTagName(e)[0]
        s.parentNode.insertBefore(t, s)
    }(
        window,
        document,
        'script',
        'https://connect.facebook.net/en_US/fbevents.js',
    )

    fbq('init', '{{implode(',', $fbInitParameters)}}')

    @php
        if ($multiplePixels) {
            foreach ($utmParameters as $key => $parameter) {
                echo "fbq('init', '$parameter');\n";
            }
        }

        if (!request()->is('/cart')) {
            echo "fbq('track', 'PageView')";
        }
    @endphp
</script>

<noscript>
    <img height="1" width="1" style="display:none"
         src="https://www.facebook.com/tr?id={{$trackingCodes->fbCode}}&ev=PageView&noscript=1"/>

    <?php
    if ($multiplePixels) {
        foreach ($utmParameters as $key => $parameter) {
            echo "<img height='1' width='1' style='display:none' src='https://www.facebook.com/tr?id=$parameter&ev=PageView&noscript=1'/><br>";
        }
    }
    ?>
</noscript>
