@php use App\Helpers\ContentHelper; @endphp


@extends('layouts.base')

@section('head')
@include('components.index.head')
@stop

@section('body')

@include(
'components.shared.header.header',
[
'deliveryText' => '',
'phone' => $phone,
'email' => $email,
'viberNumber' => $viberNumber,
'whatsappNumber' => $whatsappNumber,
'orderCode' => $orderCode
]
)

<div class="tosbody">
    @if (strpos(request()->url(), 'questions') !== false)
    <div class="center-content">
        @include('components.links.frequently_asked_questions')
    </div>
    @endif
    {!! $tosData !!}
</div>

@include('components.shared.footer.footer', compact('email', 'phone', 'tosLink', 'tosLinks'))

@stop
