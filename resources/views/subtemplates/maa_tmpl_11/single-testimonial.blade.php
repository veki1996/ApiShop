@push('head-css')
<link rel="stylesheet" href="{{ env('APP_URL') }}/css/maa_tmpl_11/single-testimonial.css">  
<link rel="stylesheet" href="{{ env('APP_URL') }}/css/maa_tmpl_2b/reviews.css">  
@endpush
<style>
    .review-box 
    {
        box-shadow: none !important;
    }

    .review-box p 
    {
        height: auto;
    }
</style>

<div class="single-testimonial-section">
    <div class="single-testimonial">
        <div class="single-testimonial-title">{{App\Helpers\ContentHelper::staticText('safeBuy')}}</div>
        <div class="review-box">
            <img id="main-img" src="{{$allContainers['s_img_var_28']->text}}">
            <p> {!!$allContainers['s_text_var_63']->text!!}</p>
           <div class="rating-name-reviews">
            <div class="review-stars">
                 <img src="{{env('APP_URL')}}/static/grade.png" alt="star for rating">
                 <img src="{{env('APP_URL')}}/static/grade.png" alt="star for rating">
                 <img src="{{env('APP_URL')}}/static/grade.png" alt="star for rating">
                 <img src="{{env('APP_URL')}}/static/grade.png" alt="star for rating">
                 <img src="{{env('APP_URL')}}/static/grade.png" alt="star for rating">
            </div>
            <div class="review-name">
                <img src="{{$staticContainers['s_img_static_146']->text}}">
                <h3>F.F</h3>
            </div>
           </div>
    
        </div>
    
    </div>
</div>