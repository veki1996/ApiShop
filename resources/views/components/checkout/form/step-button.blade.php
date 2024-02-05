@php use App\Helpers\ContentHelper; @endphp
<div class="step-button-wrapper parent col" style="display: none;" >
    <a href="javascript:void(0);" class="step-button" 
        data-direction="next">{{ ContentHelper::staticText('next')  }}</a>
</div>

<a href="javascript:void(0);" class="step-button" data-direction="previous" style="display: none"
>{{ ContentHelper::staticText('back') }}</a>