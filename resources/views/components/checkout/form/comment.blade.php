@php use App\Helpers\ContentHelper; @endphp
<div class="input-item">
    <label style="line-height: 4; background:transparent ;border:none !important ; padding: 23px 0 0 6px;" class="label_komentar" for="komentar">{!! ContentHelper::staticText('commentTitle')  !!}</label>
    <textarea id="komentar" name="komentar" class="input" placeholder="{!! ContentHelper::staticText('commentTitle')  !!}" data-mandatory="false"
        data-field="komentar"></textarea>
</div>
