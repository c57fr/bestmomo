@extends('front.template')

@section('main')
    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center"><strong>Comitem</strong></h2>
                <hr>
                <img class="img-responsive img-left" src="img/laravel-l-slant.png" alt="">
                <p>{{ trans('front/site.first-paragraph') }}.</p>
            </div>
        </div>
    </div>

@endsection
