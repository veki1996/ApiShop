@php use App\Helpers\ContentHelper; @endphp

@extends('layouts.base')

@section('head')
@include('components.index.head')
@stop

@section('body')

@push('head-css')
<link rel="stylesheet" href="{{env('APP_URL')}}/css/user/user.css">
@endpush

@include('components.shared.header.header', [
'phone' => $phone,
'email' => $email,
'viberNumber' => $viberNumber,
'whatsappNumber' => $whatsappNumber,
'orderCode' => $orderCode,
])

<div class="profile-wrapper">
    <div class="profile-information">
        <h1>Profile Information</h1>
        <p>Update your account's profile information and email address.</p>
        <form method="post" action="{{route('user.setInfo')}}" class="custom-form">
           
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" name="name" type="text" value="{{$user->data->name}}" autofocus autocomplete="name">
            </div>
        
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="{{$user->data->email}}" autocomplete="email">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input id="phone" name="phone" type="phone" value="{{$user->data->phone}}" autocomplete="phone">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input id="address" name="address" type="address" value="{{$user->data->address}}" autocomplete="address">
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <input id="city" name="city" type="city" value="{{$user->data->city}}" autocomplete="city">
            </div>

            <div class="form-group">
                <label for="country">Country</label>
                <input id="country" name="country" type="country" value="{{$user->data->country}}"  autocomplete="country">
            </div>
        
            <div class="form-actions">
                <button type="submit" class="submit-button">Save</button>
            </div>
        </form>
    </div>
</div>


@include('components.shared.footer.footer', compact('email', 'phone', 'tosLink', 'tosLinks'))
@stop

