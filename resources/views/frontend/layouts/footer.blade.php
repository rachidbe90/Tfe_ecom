<!-- Footer Section Starts -->
<footer class="footer-section" style="background: #61849C ;">

    <div class="footer-container">
        <div class="row justify-content-center">
            <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 footer-list">
                <div class="footer-subtitle" style="color: black">About</div>
                <ul class="footer-menu">
                    <li><a href="{{route('contact.us')}}">Contact Us</a></li>
                    <li><a href="{{route('about.us')}}">About Us</a></li>
                </ul>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 footer-list">
                <div class="footer-subtitle" style="color: black">Help</div>
                <ul class="footer-menu">
                    <li><a href="https://www.paypal.com/fr/smarthelp/contact-us">Payments</a></li>
                    <li><a href="{{route('contact.us')}}">Shipping</a></li>
                    <li><a href="{{route('contact.us')}}">Cancellations & Return</a></li>
                </ul>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 footer-list">
                <div class="footer-subtitle" style="color: black">Policy</div>
                <ul class="footer-menu">
                    <li><a href="{{route('return')}}">Return Policy</a></li>
                    <li><a href="{{route('condition')}}">Terms of use</a></li>
                    <li><a href="{{route('prive')}}">Privacy</a></li>
                </ul>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 footer-list">
                <div class="footer-subtitle" style="color: black">Contact Us:</div>
                <p> <i class="fa fa-map-marker footer-icon"></i> <span>{{get_setting('address')}} </span> </p>
                <p> <i class="fa fa-envelope footer-icon"></i> <span>{{get_setting('email')}} </span> </p>
                <p> <i class="fa fa-mobile footer-icon"></i> <span>Contact: <a>{{get_setting('phone')}} </a></span> </p>
            </div>
        </div>
    </div>
    <div class="footer-bottom-row">
        <div class="col-xs-12 col-md-12 pt-2">
            <ul class="footer-bottom-menu justify-content-center">
                <li>
                    <span>{{get_setting('footer')}}</span>
                </li>
            </ul>
        </div>
    </div>
</footer>
<!-- Footer Section Ends -->

