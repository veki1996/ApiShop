<div class="c027">
    <div class="c028 c031">
        <h2>{!!$heading!!}</h2>
        <p>{!!$paragraph!!}</p>
    </div>
    <div class="c029 c030 ">
        <img alt="benefit-image" data-container-type="{{$containerType}}" src="{{$image}}">
        <div class="categoryBox">
            @foreach($product->categories as $category)
            <a href="/" class="anchor">
                <div class="productCategories">
                {{-- <div class="categoryIcon"><img src="{{$category->icon}}"></div> --}}
                {{$category}}</div>
            </a>
            @endforeach
        </div>
    </div>
</div>


<script>
$(".c029:first img").css("border-radius", "8px");
$(".categoryBox:first").css("display","block");

if($(window).width() > 767) { 
    $(".c027:odd").css("flex-direction", "row");
    $(".c027:even").css("flex-direction", "row-reverse"); 
}


</script>

<style>
    .categoryBox{
        display: none;
    }
    .productCategories{
        width: 100%;
        text-align: start;
        background: #FFFFFF;
        box-shadow: 0px 2px 8px rgb(0 0 0 / 8%);
        border-radius: 8px;
        height: 32px;
        display: flex;
        align-items: center;
        font-size: 14px;
        font-weight: 700;
        color: #202020;
        padding: 10px;
        margin-bottom: 8px;
    }
</style>



