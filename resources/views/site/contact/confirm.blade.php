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
      <div class="lead natural">
        <p>下記の内容でよろしければ「この内容で送信する」ボタンを押してください。<br>やり直す場合は「もう一度入力し直す」ボタンを押してください。</p>
      </div>

      <table class="table-formed">
        <tr>
          <th>名前</th>
          <td>
            <p class="_group">
              {{ EXUS::exist($formData, 'name') }}
              &nbsp;
            </p>
          </td>
        </tr>
        <tr>
          <th>会社・団体名</th>
          <td>
            <p class="_group">
              {{ EXUS::exist($formData, 'cname') }}
              &nbsp;
            </p>
          </td>
        </tr>
        <tr>
          <th>部署・役職</th>
          <td>
            <p class="_group">
              {{ EXUS::exist($formData, 'pos') }}
              &nbsp;
            </p>
          </td>
        </tr>
        <tr>
          <th>電話番号</th>
          <td>
            <p class="_group">
              {{ EXUS::exist($formData, 'tel') }}
              &nbsp;
            </p>
          </td>
        </tr>
        <tr>
          <th>メールアドレス</th>
          <td>
            <p class="_group">
              {{ EXUS::exist($formData, 'mail') }}
              &nbsp;
            </p>
          </td>
        </tr>
        <tr>
          <th>お問い合わせ内容</th>
          <td>
            <p class="_group">
              {!! nl2br(EXUS::exist($formData, 'contact')) !!}
              &nbsp;
            </p>
          </td>
        </tr>
      </table>

      <div class="columns -reverse -two -to-one section-3">
        <div class="_column text-center">
          <form action="{{ route('contact_complete') }}" method="post">
            @csrf
            @foreach ($formData as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <input class="button-action -colored" tabindex="2" type="submit" value="この内容で送信する">
          </form>
        </div>
        <div class="_column text-center">
          <form action="{{ route('contact') }}" method="post">
            @csrf
            <input type="hidden" name="_from_confirm" value="1">
            @foreach ($formData as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <input class="button-action -back" tabindex="1" type="submit" value="もう一度入力し直す">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
