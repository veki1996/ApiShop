@php use App\Helpers\ContentHelper; @endphp

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>


<div class="container">
  <div class="rate">{{ContentHelper::staticText('rate') }}</div>
  <div class="starsHolder">
    <p class="rateUs">{{ContentHelper::staticText('rateUs') }}:</p>
    <div class="star-widget">
      <input type="radio" name="rate" id="rate-5">
      <label for="rate-5" class="fas fa-star"></label>
      <input type="radio" name="rate" id="rate-4">
      <label for="rate-4" class="fas fa-star"></label>
      <input type="radio" name="rate" id="rate-3">
      <label for="rate-3" class="fas fa-star"></label>
      <input type="radio" name="rate" id="rate-2">
      <label for="rate-2" class="fas fa-star"></label>
      <input type="radio" name="rate" id="rate-1">
      <label for="rate-1" class="fas fa-star"></label>
    </div>
  </div>
  <div class="rateUs">{{ContentHelper::staticText('yourComment') }}:</div>
  <div class="textarea">
    <textarea cols="30" placeholder="{{ContentHelper::staticText('addCom')}}..."></textarea>
  </div>
  <button class="addRateBtn">{{ContentHelper::staticText('addRate') }}</button>
</div>


@push('head-css')
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
            .addRateBtn{
              font-weight: 700;
              font-size: 16px;
              line-height: 24px;
              border-radius: 6px;
              border:solid 1px #202020;
              width:100%;
              height:40px;
              display: flex;
              justify-content: center;
              align-items: center;
              margin-top:14px;
              box-shadow: 0px 2px 8px rgb(0 0 0 / 8%);

            }
            .container{
              height:440px;
              padding: 16px;
            }
            .rate{
              font-size: 24px;
              text-align: center;
              font-weight: 700;
              margin-bottom: 26px;
            }
            .rateUs{
              font-size: 16px;
              margin-bottom: 18px;
           
            }
            .starsHolder{
              display: flex;
              align-items: center;
            }
            .container .star-widget input{
            display: none;
            }
            .star-widget{
              width: 160px;
            }
            .star-widget label{
            font-size: 18px;
            color: #444;
            padding: 5px;
            float: right;
            transition: all 0.2s ease;
            height:30px;
            
            }
            input:not(:checked) ~ label:hover,
            input:not(:checked) ~ label:hover ~ label{
            color: #efcd63;
            }
            input:checked ~ label{
            color: #efcd63;
            }
            input#rate-5:checked ~ label{
            color: #efcd63;
            }

            .textarea{
              width:100%;
              height: 108px;
            }

            textarea{
              width: 100%;
              height: 100%;
              border-radius: 8px;
              padding: 6px;
              box-shadow: 0px 2px 8px rgb(0 0 0 / 8%);
            }
            @media only screen and (min-width: 768px) {
              .addRateBtn {
                width: 337px;
                margin-left: auto;
                margin-right: auto;
                }
              }


    </style>
@endpush

<script>
  $(".addRateBtn").on("click", function() {
    location.reload();
  })
 </script>