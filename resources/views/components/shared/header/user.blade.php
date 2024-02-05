@push('head-css')
<link rel="stylesheet" href="{{env('APP_URL')}}/css/user/user.css">
@endpush

<div>
    @isset($user)
   
    <div class="dropdown">
        <img class="dropbtn" src="{{env('APP_URL')}}/static/user-online.png" alt="user profile button">
        <div class="dropdown-content">
            <a href="{{route('user.profile')}}">Profile</a>
            <a href="{{route('user.orders')}}">Orders</a>
            <a href="{{route('user.logout')}}">Logout</a>
        </div>
    </div>
    @else

    <img class="user" src="{{env('APP_URL')}}/static/user.png" alt="user profile button">
    @endisset
</div>
<script>

$(document).ready(function(){
    $('.dropbtn').click(function(){
        $(this).next('.dropdown-content').toggle();
    });
});


</script>