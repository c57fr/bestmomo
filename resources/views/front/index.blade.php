@extends('front.template')

@section('main')
    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center"><strong>INSTALLATION</strong></h2>
                <hr>
                <img class="img-responsive img-left" src="img/laravel-l-slant.png" alt="">
                <p><strong><a href="https://github.com/c57fr/bestmomo"
                              target="_blank">
                            <mark>{{ trans('front/site.depot-git') }}</mark>
                        </a></strong>
                </p>
            </div>
        </div>
    </div>
@endsection
