<title>{{ App\Helpers\ContentHelper::staticText('jewelry')}} - {{env('BRAND_NAME')}}</title>

<link rel="shortcut icon" type="image/x-icon" href="{{env('APP_URL')}}/static/favicon.png">

<link rel="stylesheet" href="{{env('APP_URL')}}/css/index.css">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz@6..12&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

</style>
    
@foreach($pixels as $pixel)
    @include("components.tracking.pixels.$pixel")
@endforeach
