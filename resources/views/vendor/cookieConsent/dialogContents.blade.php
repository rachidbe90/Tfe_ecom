<div class="js-cookie-consent cookie-consent">

    <span class="cookie-consent__message">
        {!! trans('cookieConsent::texts.message') !!}

        <span> Ohé the cookies !🍪</span>
        <h6>control of your data is important... We use cookies to improve the site <a href="{{route('condition')}}" style="color: red">Terms of use</a></h6>
        </span>


    <div class="modal-footer">
        <button class="js-cookie-consent-agree cookie-consent__agree btn btn-sm btn-success">
            Ok. Allow cookies, let's go !
        </button>
        <button class="btn btn-danger btn-sm">
            <a href="http://www.google.be">I denied</a>
        </button>
    </div>

</div>
