@php
    $staticContainers = App\Helpers\ContentHelper::staticContent();
@endphp
@if ($staticContainers)
<div class="qa-content">
    <h2>{{$staticContainers['s_text_static_400']->text}}</h2>
    <p>{{$staticContainers['s_text_static_392']->text}}</p>
    <h2>{{$staticContainers['s_text_static_330']->text}}</h2>
    <p>{{$staticContainers['s_text_static_394']->text}}</p>
    <h2>{{$staticContainers['s_text_static_395']->text}}</h2>
    <p>{{$staticContainers['s_text_static_396']->text}}</p>
    <h2>{{$staticContainers['s_text_static_397']->text}}</h2>
    <p>{{$staticContainers['s_text_static_415']->text}}</p>
</div>
@endif