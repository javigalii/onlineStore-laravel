@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 ms-auto">
                <p class="lead">{{ $viewData["description"] }}</p>
            </div>
            <div class="col-lg-4 me-auto">
                <p class="lead">{{ $viewData["author"] }}</p>
            </div>
        </div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6290.289561769078!2d-1.0699180235801653!3d37.97375040067244!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6382a81dc444bd%3A0x5de930770cb8d2d4!2sAv.%20Maestros%2C%2062%2C%20a%2C%2030570%20Murcia!5e0!3m2!1ses!2ses!4v1765789253629!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
@endsection
