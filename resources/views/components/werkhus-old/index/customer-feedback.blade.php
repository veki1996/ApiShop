@php use App\Helpers\ContentHelper; @endphp

<div class="feedback-container">
    <div class="feedback-title">{{ContentHelper::staticText('customersFeedback')}}</div>
    <div class="rating-container">
        <div class="rating-txt">{{ContentHelper::staticText('excellent') }}</div>
        <div class="star-rating-container">
            <div class="stars-container">
                <img src="{{env('APP_URL')}}/static/stars.png" alt="Stars rating">
            </div>
            <div class="review-count">{{ContentHelper::staticText('numOfFeedbacks') }}</div>
        </div>
    </div>
</div>

<style>
    .feedback-container {
        width: 100%;

        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 32px 0px;
        gap: 24px;

        background: #FEFEFE;
    }
    .feedback-title {
        font-weight: 600;
        font-size: 20px;
        line-height: 23px;
        text-align: center;
        text-transform: uppercase;

        color: #070707;
    }
    .rating-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 0px;
        gap: 8px;
    }
    .rating-txt {
        font-weight: 400;
        font-size: 24px;
        line-height: 28px;
        text-align: center;

        color: #070707;
    }
    .star-rating-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 0px;
        gap: 8px;
    }
    .stars-container {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        padding: 0px;
    }
    .review-count {
        font-weight: 400;
        font-size: 14px;
        line-height: 16px;
        text-align: center;

        color: #070707;

    }
</style>
