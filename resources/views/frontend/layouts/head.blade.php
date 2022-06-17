<meta charset="UTF-8">
<meta name="description" content="{{get_setting('meta_description')}}">
<meta name="keywords" content="{{get_setting('meta_keywords')}}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="author" content="Rachid AHGGOUNE">
<!-- Title  -->
<title>{{get_setting('title')}}</title>

<!-- Favicon  -->
<link rel="icon" href="{{asset(get_setting('favicon'))}}">

<!-- Css Styles Here -->
<!-- <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="{{asset('frontend')}}/css/font-awesome.min.css" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('frontend')}}/css/elegant-icons.css" type="text/css">
<link rel="stylesheet" href="{{asset('frontend')}}/css/bootstrap.min.css" type="text/css">

<link rel="stylesheet" href="{{asset('frontend')}}/css/flaticon.css">
<link rel="stylesheet" href="{{asset('frontend')}}/css/animate.css">
<link rel="stylesheet" href="{{asset('frontend')}}/css/nice-select.css" type="text/css">
<link rel="stylesheet" href="{{asset('frontend')}}/css/jquery-ui.min.css" type="text/css">
<link rel="stylesheet" href="{{asset('frontend')}}/css/owl.carousel.min.css" type="text/css">
<link rel="stylesheet" href="{{asset('frontend')}}/css/slicknav.min.css" type="text/css">
<link rel="stylesheet" href="{{asset('frontend')}}/sass/style.css" type="text/css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
    #header{
        position: sticky;
        background: #ffffff;
        top: 0;
        z-index: 9999;
        width: 100%;
    }
    .js-cookie-consent{
        position: fixed;
        bottom: 60px;
        left: 20px;
        right: 20px;
        max-width: 310px;
        z-index: 1070;
        background: #61849C;
        color: white;
        padding: 14px 16px;
        border-radius: 4px;
        font-size: 14px;

    }
    @media(max-width:530px){
        .js-cookie-consent{
            display:none;
        }
    }
</style>

@yield('styles')
