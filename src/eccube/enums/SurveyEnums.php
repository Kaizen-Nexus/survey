<?php
class SurveyEnums{

    //For Survey Type
    const SURVEY_TARGET_USER = 1;         // 'dtb_user' -> API USER/PUBLIC USER
    const SURVEY_TARGET_ISSUER = 2;       // 'dtb_issue_form' -> Member/ISSUE
    const SURVEY_TARGET_CUSTOMER = 3;     // 'dtb_customer' -> Member/Mypage
    const SURVEY_TARGET_MEMBERSTORE = 4; // 'dtb_memberstore' -> Member/ShopMypage
    const SURVEY_TARGET_STAMP = 5;        // stamprally

    //For Survey Target User
    const ALL = 0;
    const INDIVIDUAL = 1;
    const SURVEYEARNPOINT = 1;
    const PRESET_NAME = 'name';
    const PRESET_PHONE_NUMBER = 'tel';
    const PRESET_EMAIL = 'email';
    const PRESET_POSTAL_CODE = 'postcode';

    private static function onName($arg) {
        $surName = $arg['sur_name'] ?? '';
        $firstName = $arg['first_name'] ?? '';
        return $surName . $firstName;
    }
    private static function onPhoneNumber($arg) {
        $phone = preg_replace('/^\+81[-\s]?/', '', $arg['phone_number']);
        return $phone??'';
    }
    private static function onEmail($arg) {
        return $arg[self::PRESET_EMAIL] ?? '';
    }
    private static function onPostalCode($arg) {
        $zip_code = $arg['zip_code'] ?? '';
        return $zip_code;
    }
    private static $presetActions = [
        self::PRESET_NAME          => [__CLASS__, 'onName'],
        self::PRESET_PHONE_NUMBER  => [__CLASS__, 'onPhoneNumber'],
        self::PRESET_EMAIL         => [__CLASS__, 'onEmail'],
        self::PRESET_POSTAL_CODE   => [__CLASS__, 'onPostalCode']
    ];

    public static function executePresetAction($key, $userData) {
        if (isset(self::$presetActions[$key]) && is_callable(self::$presetActions[$key])) {
            $action = self::$presetActions[$key];
            return call_user_func($action, $userData);
        }
        throw new InvalidArgumentException("Invalid action key: $key");
    }
}
