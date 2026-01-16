<?php
class SurveyConstants{

    const prefNames = [null, "北海道", "青森県", "岩手県", "宮城県", "秋田県", "山形県", "福島県", "茨城県", "栃木県", "群馬県", "埼玉県", "千葉県", "東京都", "神奈川県", "新潟県", "富山県", "石川県", "福井県", "山梨県", "長野県", "岐阜県", "静岡県", "愛知県", "三重県", "滋賀県", "京都府", "大阪府", "兵庫県", "奈良県", "和歌山県", "鳥取県", "島根県", "岡山県", "広島県", "山口県", "徳島県", "香川県", "愛媛県", "高知県", "福岡県", "佐賀県", "長崎県", "熊本県", "大分県", "宮崎県", "鹿児島県", "沖縄県"];

    public static function getPrefNames()
    {
        return self::prefNames;
    }
    const SURVEY_ERRORS = [
        'phone_check_err'              => "このアンケートでは、同じ電話番号（アカウント）からの回答回数が上限に達しています。  そのため、これ以上このアンケートに回答することはできません。",
        'answer_period_from_err'       => '回答期限外のため回答できません。',
        'answer_period_to_err'         => '期限を過ぎているため回答・申請することができません。',
        'invalid_target_err'           => '無効なターゲットです。',
        // 'survey_already_completed_err' => 'アンケートはすでに回答済みです。',
        'record_err'                   => 'レコードの処理中に問題が発生しました。',
        'user_not_found_err'           => '該当するユーザー情報がありません。',
        'access_token_denied_err'      => 'アクセストークンが拒否されました。',
        'permission_denied_err'        => '権限がありません。',
        // 'survey_not_found_err'         => '回答できるアンケートが見つかりません。',
        'survey_common_err'            => '無効なQRコードです。',
        'start_begin_err'              => '最初からやり直してください。',
        'page_err'                     => 'このページはアクセスできません。',
        'auth_err'                     => 'トークンまたは署名が不足しています。',
        'token_not_found_err'          => 'トークンが見つかりません。',
        'token_expired_err'            => 'トークンの期限が切れました。',
        'error_bg_message'             => 'このフォームは回答の受付を終了しました'
    ];
}
