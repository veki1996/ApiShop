@php use App\Helpers\ContentHelper; @endphp
<div class="contact-module" data-step="1">
    <span class="input-item-title">{{ContentHelper::staticText('howToContact') }}</span>
    <div class="input-container">
        <div class="input-item">
            <label for="ime" class="label_ime">{!!ContentHelper::staticText('fullName') !!}</label>
            <input type="text" id="ime" name="name" class="input"
                placeholder="{!!ContentHelper::staticText('fullName') !!}" autocomplete="given-name"
                data-mandatory="true" data-field="name"
                value="{{ isset($user) && isset($user->data->name) ? $user->data->name : (isset($customerData) && isset($customerData['name']) ? $customerData['name'] : '') }}">
            <div class="mandatory_field"><span>{!!ContentHelper::staticText('fullNameRequired') !!}</span></div>
            <img src="{{env('APP_URL')}}/static/checkmark.png" class="check-icon" data-id="ime" alt="">
        </div>

        <div class="input-item">
            <label for="phone" class="label_phone">{!!ContentHelper::staticText('phone') !!}</label>
            <input type="tel" id="phone" name="phone" class="input"
                placeholder="{!!ContentHelper::staticText('phone') !!}" autocorrect="off" autocomplete="tel"
                data-mandatory="true" data-field="telephone" value="{{ isset($user) && isset($user->data->phone) ? $user->data->phone : (isset($customerData) && isset($customerData['telephone']) ? $customerData['telephone'] : '') }}">
            <div class="mandatory_field"><span>{!!ContentHelper::staticText('mandatoryInfo') !!}</span></div>
            <img src="{{env('APP_URL')}}/static/checkmark.png" class="check-icon" data-id="phone" alt="">
        </div>
    </div>
</div>