<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ trans('front/site.title') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    @yield('head')

    {!! HTML::style('css/front.css') !!}

    <style>
        .c57back {
            margin: 20px;
            font-weight: 800;
            color: red;
            text-decoration: none;
        }

        .c57back a {
            /*color: red;*/
            padding: 3px 7px;
            background-color: yellow;
            text-decoration: none;
            -webkit-border-radius: 7px;
            -moz-border-radius: 7px;
            border-radius: 7px;
            transition: 7s;
        }

        .c57back a:hover {
            color: red;
            transition: .5s
        }
    </style>
</head>

<body>

<header>

    <div class="c57back">
        <a href="http://c57.fr">c57.fr</a>
    </div>

    <div class=" brand">{{ trans('front/site.title') }}</div>
    <div class="address-bar">{{ trans('front/site.sub-title') }}</div>
    <div id="flags" class="text-center"></div>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">{{ trans('front/site.title') }}</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li {!! classActivePath('/') !!}>
                        {!! link_to('/', trans('front/site.home')) !!}
                    </li>
                    @if(session('statut') == 'visitor' || session('statut') == 'user')
                        <li {!! classActivePath('contact/create') !!}>
                            {!! link_to('contact/create', trans('front/site.contact')) !!}
                        </li>
                    @endif
                    <li {!! classActiveSegment(1, ['articles', 'blog']) !!}>
                        {!! link_to('articles', trans('front/site.blog')) !!}
                    </li>
                    @if(Request::is('auth/register'))
                        <li class="active">
                            {!! link_to('auth/register', trans('front/site.register')) !!}
                        </li>
                    @elseif(Request::is('password/email'))
                        <li class="active">
                            {!! link_to('password/email', trans('front/site.forget-password')) !!}
                        </li>
                    @else
                        @if(session('statut') == 'visitor')
                            <li {!! classActivePath('login') !!}>
                                {!! link_to('login', trans('front/site.connection')) !!}
                            </li>
                        @else
                            @if(session('statut') == 'admin')
                                <li>
                                    {!! link_to_route('admin', trans('front/site.administration')) !!}
                                </li>
                            @elseif(session('statut') == 'redac')
                                <li>
                                    {!! link_to('blog', trans('front/site.redaction')) !!}
                                </li>
                            @endif
                            <li>
                                {!! link_to('/logout', trans('front/site.logout'), ['id' => "logout"]) !!}
                                {!! Form::open(['url' => '/logout', 'id' => 'logout-form']) !!}{!! Form::close() !!}
                            </li>
                        @endif
                    @endif
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><img width="32" height="32"
                                                                                        alt="{{ session('locale') }}"
                                                                                        src="{!! asset('img/' . session('locale') . '-flag.png') !!}"/>&nbsp;
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @foreach ( config('app.languages') as $user)
                                @if($user !== config('app.locale'))
                                    <li><a href="{!! url('language') !!}/{{ $user }}"><img width="32" height="32"
                                                                                           alt="{{ $user }}"
                                                                                           src="{!! asset('img/' . $user . '-flag.png') !!}"></a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('header')
</header>

<main class="container">
    @if(session()->has('ok'))
        @include('partials/error', ['type' => 'success', 'message' => session('ok')])
    @endif
    @if(isset($info))
        @include('partials/error', ['type' => 'info', 'message' => $info])
    @endif
    @yield('main')
</main>

<footer>
    @yield('footer')
    <p class="text-center">
        <small>Copyright &copy; Momo</small>
    </p>
</footer>

{!! HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js') !!}
{!! HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') !!}

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function () {
        $('#logout').click(function (e) {
            e.preventDefault();
            $('#logout-form').submit();
        })
    });
</script>

@yield('scripts')

        <!-- Piwik -->
<script type="text/javascript">
    var _paq = _paq || [];
    /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
    _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
    _paq.push(["setCookieDomain", "*.c57.fr"]);
    _paq.push(["setDomains", ["*.c57.fr"]]);
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function () {
        var u = "//piwik.cote7.com/";
        _paq.push(['setTrackerUrl', u + 'piwik.php']);
        _paq.push(['setSiteId', '7']);
        var d = document, g = d.createElement('script'), s = d.getElementsByTagName('script')[0];
        g.type = 'text/javascript';
        g.async = true;
        g.defer = true;
        g.src = u + 'piwik.js';
        s.parentNode.insertBefore(g, s);
    })();
</script>
<noscript><p><img src="//piwik.cote7.com/piwik.php?idsite=7&rec=1" style="border:0;" alt=""/></p></noscript>
<!-- End Piwik Code -->

</body>
</html>