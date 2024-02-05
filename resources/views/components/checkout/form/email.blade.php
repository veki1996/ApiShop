@php use App\Helpers\ContentHelper; @endphp

<div class="email-module" data-step="3">
    <span class="input-item-title">{!!ContentHelper::staticText('emailTitle') !!}</span>

    <div class="input-item">
        <label for="email" class="label_email">E-mail</label>
        <input type="email" id="email" name="email" class="input" placeholder="E-mail"
               data-mandatory="false" data-field="email" list="email-options"  value="{{ isset($user) && isset($user->data->email) ? $user->data->email : (isset($customerData) && isset($customerData['email']) ? $customerData['email'] : '') }}">
        <datalist id="email-options"></datalist>
    </div>
</div>
