@extends('layouts.layout')

@section('title')お問い合わせ @endsection
@section('description')お問い合わせはこちらから。 @endsection
@section('keywords') @endsection
@section('body_class')-contact @endsection

@section('content')
<div class="billboard">
  <div class="container">
    <h1 class="_main">お問い合わせ</h1>
    <p class="_sub">Contact</p>
  </div>
</div>

<div class="container">
  <div class="container -readable">
    <div class="section-2">
      <p class="heading-2 stick-bottom text-center">お問い合わせを<em>受け付けました</em>。</p>

      <div class="lead natural stick-top text-center">
        <p>おって弊社よりご連絡させていただきます。</p>
      </div>
    </div>
  </div>

  <div class="section-2">
    <p class="bottom-back-link"><a class="button-link" href="{{ route('index') }}">トップページに戻る</a></p>
  </div>
</div>
@endsection
