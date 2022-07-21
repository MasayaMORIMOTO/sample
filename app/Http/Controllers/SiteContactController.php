<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Libraries\EXUS;

class SiteContactController extends BaseController
{
    public function form(Request $request)
    {
        $formData = [];
        if ($request->get('_from_confirm') == '') {
            // 初期値があればここでセットする
        } else {
            $formData = $request->except(['_token']);
        }

        $bladeArgs = [
            'formData' => $formData,
        ];
        return view('site/contact/form', $bladeArgs);
    }

    public function confirm(Request $request)
    {
        // 入力チェック
        $errorArray = $this->checkInput($request);

        // フォームデータ
        $formData = $request->except(['_token']);

        $bladeArgs = [
            'formData' => $formData,
            'errorArray' => $errorArray,
        ];
        if (count($errorArray) == 0) {
            return view('site/contact/confirm', $bladeArgs);
        } else {
            return view('site/contact/form', $bladeArgs);
        }
    }

    public function complete(Request $request)
    {
        // フォームデータ
        $formData = $request->except(['_token']);

        // メール送信
        $time = date('Y/m/d H:i');

        $body = <<<___EOF___

【問い合わせ】

[登録日時] $time
[ お名前 ] ${formData['name']}
[会社団体] ${formData['cname']}
[部署役職] ${formData['pos']}
[ T E L  ] ${formData['tel']}
[ E-mail ] ${formData['mail']}
[お問い合わせ内容]
${formData['contact']}

___EOF___;

        $address = 'masaya_morimoto@yahoo.co.jp';
        $sender = $address;
        $jsender = $address;
        $toArray = [$address];
        $ccArray = [];
        $bccArray = [];
        $subject = '[From Site Contact]';
        $fileArray = [];

        $blade = ['text' => 'emails.plain'];
        $bladeArgs = ['body' => $body];

        Mail::send(
          $blade,
          $bladeArgs,
          function($message) use($sender,
                                 $jsender,
                                 $toArray,
                                 $ccArray,
                                 $bccArray,
                                 $subject,
                                 $fileArray) {
            $message
                ->from($sender, $jsender)
                ->to($toArray)
                ->cc($ccArray)
                ->bcc($bccArray)
                ->subject($subject);
            foreach ($fileArray as $file) {
                $path = storage_path($file['path']);
                $message->attach($path, ['as' => $file['name']]);
            }
        });

        $bladeArgs = [
        ];
        return view('site/contact/complete', $bladeArgs);
    }

    // 入力チェック
    private function checkInput($request)
    {
        // エラーメッセージ格納配列
        $errorArray = [];

        // 必須項目のキー
        $requiredKeyArray = [
            'name', 'mail', 'contact',
        ];

        // 必須チェック
        foreach ($requiredKeyArray as $key) {
            $formValue = $request->get($key);
            if ($formValue == '') {
                $errorArray[$key] = 1;
            }
        }

        // メールアドレスチェック
        $mail = $request->get('mail');
        if ($mail != '') {
            if (!EXUS::isOnlyHankaku($mail)) {
                $errorArray['mail2'] = 1;
            }
            if (strpos($mail, '@') === false) {
                $errorArray['mail2'] = 1;
            }
        }

        return $errorArray;
    }
}
