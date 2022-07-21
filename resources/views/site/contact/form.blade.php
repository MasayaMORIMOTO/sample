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
      <div class="natural section-2">
        <p>
          <span class="lead stick">お問い合わせありがとうございます。<br>下記のフォームに必要事項を入力の上、「入力内容を確認する」ボタンを押してください。</span><br>
          <small><em>※</em> 必須は必須入力項目です。</small><br>
          <small><em>※</em> 数字は半角、カタカナは全角で入力してください。</small>
        </p>
      </div>

      <form action="{{ route('contact_confirm') }}" method="post">
        @csrf
        <table class="table-formed">
          <tr>
            <th>名前 <em class="_badge -required">必須</em></th>
            <td>
              <p class="_group">
                @if (isset($errorArray['name']))
                <strong>※ 名前を入力してください。</strong>
                @endif
                <input class="full"
                       name="name"
                       size="24"
                       tabindex="2"
                       type="text"
                       value="{{ EXUS::exist($formData, 'name') }}">
              </p>
            </td>
          </tr>
          <tr>
            <th>会社・団体名</th>
            <td>
              <p class="_group">
                <input class="full"
                       name="cname"
                       size="24"
                       tabindex="3"
                       type="text"
                       value="{{ EXUS::exist($formData, 'cname') }}">
              </p>
            </td>
          </tr>
          <tr>
            <th>部署・役職</th>
            <td>
              <p class="_group">
                <input class="full"
                       name="pos"
                       size="24"
                       tabindex="4"
                       type="text"
                       value="{{ EXUS::exist($formData, 'pos') }}">
              </p>
            </td>
          </tr>
          <tr>
            <th>電話番号</th>
            <td>
              <p class="_group">
                <input class="full"
                       name="tel"
                       size="24"
                       tabindex="5"
                       type="text"
                       value="{{ EXUS::exist($formData, 'tel') }}">
              </p>
            </td>
          </tr>
          <tr>
            <th>メールアドレス <em class="_badge -required">必須</em></th>
            <td>
              <p class="_group">
                @if (isset($errorArray['mail']))
                <strong>※ メールアドレスを入力してください。</strong><br>
                @endif
                @if (isset($errorArray['mail2']))
                <strong>※ メールアドレスを正しく入力してください。</strong><br>
                @endif
                <input class="full"
                       name="mail"
                       size="24"
                       tabindex="6"
                       type="text"
                       value="{{ EXUS::exist($formData, 'mail') }}">
              </p>
            </td>
          </tr>
          <tr>
            <th>お問い合わせ内容 <em class="_badge -required">必須</em></th>
            <td>
              <p class="_group">
                @if (isset($errorArray['contact']))
                <strong>※ お問い合わせ内容を入力してください。</strong><br>
                @endif
                <textarea class="full"
                          name="contact"
                          rows="5"
                          tabindex="7"
                          >{{ EXUS::exist($formData, 'contact') }}</textarea>
              </p>
            </td>
          </tr>
        </table>

        <div class="natural section-3">
          <p class="text-center">
            <input class="button-action -colored" type="submit" value="入力内容を確認する">
          </p>
        </div>

        <hr>

      </form>
    </div>
  </div>
</div>
@endsection
