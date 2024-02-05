@php use App\Helpers\ContentHelper; @endphp

<div class="delivery-module"  data-step="2">
    <span class="input-item-title">{{ContentHelper::staticText('whereToSend') }}</span>

    <div class="input-container">
        <div class="double--input parent row">
            <div class="input-item double--item double--max70">
                <label for="address" class="label_address">{!!ContentHelper::staticText('address') !!}</label>
                <input type="text" id="address" name="address" class="input"
                       placeholder="{!!ContentHelper::staticText('address') !!}"
                       data-mandatory="true" data-field="address"  value="{{ isset($user) && isset($user->data->address) ? $user->data->address : (isset($customerData) && isset($customerData['address']) ? $customerData['address'] : '') }}">
                <div class="mandatory_field"><span>{!!ContentHelper::staticText('mandatoryInfo') !!}</span></div>
                <img src="{{env('APP_URL')}}/static/checkmark.png" class="check-icon" data-id="address">
            </div>

            <div class="input-item double--item double--max30">
                <label for="number" class="label_number">{!!ContentHelper::staticText('houseNumber') !!}</label>
                <input type="text" id="number" name="number" class="input"
                       placeholder="{!!ContentHelper::staticText('houseNumber') !!}"
                       data-mandatory="true" data-field="address"  value="{{ $customerData['houseno'] ?? '' }}">
                <div class="mandatory_field"><span>{!!ContentHelper::staticText('mandatoryInfo') !!}</span></div>
                <img src="{{env('APP_URL')}}/static/checkmark.png" class="check-icon" data-id="number">
            </div>
        </div>

        <div class="input-item">
            <label for="postal" class="label_postal">{!!ContentHelper::staticText('postNumber') !!}</label>
            <input type="text" id="postal" name="postal" class="input"
                   placeholder="{!!ContentHelper::staticText('postNumber') !!}"
                   data-mandatory="true" data-field="postcode"  value="{{ $customerData['postcode'] ?? '' }}">
            <div class="mandatory_field"><span>{!!ContentHelper::staticText('mandatoryInfo') !!}</span></div>
            <img src="{{env('APP_URL')}}/static/checkmark.png" class="check-icon" data-id="postal">
        </div>

        <div class="input-item">
            <label for="city" class="label_city">{!!ContentHelper::staticText('place') !!}</label>
            <input type="text" id="city" name="city" class="input"
                   placeholder="{!!ContentHelper::staticText('place') !!}" data-mandatory="true"
                   data-field="city"  value="{{ isset($user) && isset($user->data->city) ? $user->data->city : (isset($customerData) && isset($customerData['city']) ? $customerData['city'] : '') }}">
            <div class="mandatory_field"><span>{!!ContentHelper::staticText('mandatoryInfo')!!}</span></div>
            <img src="{{env('APP_URL')}}/static/checkmark.png" class="check-icon" data-id="city">
        </div>
        @if (strtolower(env('COUNTRY_CODE'))  === 'it')
        <div class="input-item">
            @include('components.checkout.form.region')
        </div>
        @endif
    </div>
</div>
