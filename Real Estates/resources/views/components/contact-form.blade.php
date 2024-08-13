@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form id="contact-form" action="{{ route('contact.send') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <fieldset>
                <label for="name">{{ __('Full Name') }}</label>
                <input type="text" name="name" id="name" placeholder="{{ __('Your Name...') }}" autocomplete="on" required>
            </fieldset>
        </div>
        <div class="col-lg-12">
            <fieldset>
                <label for="email">{{ __('Email Address') }}</label>
                <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="{{ __('Your E-mail...') }}" required>
            </fieldset>
        </div>
        <div class="col-lg-12">
            <fieldset>
                <label for="subject">{{ __('Subject') }}</label>
                <input type="text" name="subject" id="subject" placeholder="{{ __('Subject...') }}" autocomplete="on">
            </fieldset>
        </div>
        <div class="col-lg-12">
            <fieldset>
                <label for="message">{{ __('Message') }}</label>
                <textarea name="message" id="message" placeholder="{{ __('Your Message') }}"></textarea>
            </fieldset>
        </div>
        <div class="col-lg-12">
            <fieldset>
                <button type="submit" id="form-submit" class="orange-button">{{ __('Send Message') }}</button>
            </fieldset>
        </div>
    </div>
</form>
