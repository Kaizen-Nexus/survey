<?php
require_once KAIZEN_SURVEY_PATH. 'constants/SurveyConstants.php';

trait SurveyTokenTrait
{

    private function base64url_encode($payload) {
        return rtrim(strtr(base64_encode($payload), '+/', '-_'), '=');
    }

    private function encryptToken($data) {
        $key = ORG_CODE_ENCRYPTION_KEY;
        $data['ts'] = time();
        $payload = json_encode($data);
        $nonce = random_bytes(\SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_NPUBBYTES);
        $ciphertext = sodium_crypto_aead_chacha20poly1305_ietf_encrypt(
            $payload,
            '',
            $nonce,
            $key
        );
        $token = $this->base64url_encode($nonce . $ciphertext);
        return $token;
    }
    // Decrypt
    private function base64url_decode($data) {
        $b64 = strtr($data, '-_', '+/');
        $pad = strlen($b64) % 4;
        if ($pad) {
            $b64 .= str_repeat('=', 4 - $pad);
        }
        return base64_decode($b64);
    }
    private function decryptToken($token)
    {
        if (empty($token)) {
            throw new Exception("ED01: Missing token");
        }
        $raw = $this->base64url_decode($token);
        $nonceLen = \SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_NPUBBYTES;
        if (strlen($raw) <= $nonceLen) {
            throw new Exception("ED02: Invalid token");
        }

        $nonce = substr($raw, 0, $nonceLen);
        $ciphertext = substr($raw, $nonceLen);

        $key = ORG_CODE_ENCRYPTION_KEY;

        $plaintext = sodium_crypto_aead_chacha20poly1305_ietf_decrypt(
            $ciphertext,
            '',
            $nonce,
            $key
        );

        if ($plaintext === false) {
            throw new Exception("ED03: Wrong token or tampered");
        }

        $payload = json_decode($plaintext, true);
        return $payload;
    }
    private $defaultDecryptCheckers = ['orgCode', 'userId', 'targetType'];
    private function checkapiTokenInitSession($decryptCheckers =null, $callback = null)
    {
        $decryptCheckers = $decryptCheckers ?? $this->defaultDecryptCheckers;
        // Bypass by survey_token while answering from list screen for start,then confirm ant other modes
        if (!isset($_GET['token']) && !isset($_POST['survey_token'])) {
            $msg = SurveyConstants::SURVEY_ERRORS['auth_err'];
            $this->handleErrorThrow($msg);
        }
        $token = $_GET['token'];
        $tknData = $this->getValidatedTokenData($token, $decryptCheckers);
        if($tknData) {
            $this->surveyToken = $this->setSurveyToken($tknData['surveyId']);
            if (is_callable($callback)) {
                call_user_func($callback, false, $tknData['surveyId']);
            }
        }
    }

    private function getValidatedTokenData($token = null, $valueKeys =null, $maxExpMseconds = null)
    {
        // Use sess->apiAuthToken for Mobile,Member users, GET->token for public user
        $token = $token ?? $_SESSION['apiAuthToken'] ?? $_GET['token'];
         if (empty($token)) {
            $msg = SurveyConstants::SURVEY_ERRORS['token_not_found_err'];
            $this->handleErrorThrow($msg);
        }
        $valueKeys = $valueKeys ?? $this->defaultDecryptCheckers;

        try{
            $tokenData = $this->decryptToken($token);
            // add ts to use expiration if need
            if($maxExpMseconds != null) {
                array_push($valueKeys,'ts');
                if (time() - $tokenData['ts'] > $maxExpMseconds) {
                    $msg = SurveyConstants::SURVEY_ERRORS['token_expired_err'];
                    $this->handleErrorThrow($msg);
                }
            }
            return $tokenData;
        }catch(Exception $e) {
            $this->handleErrorThrow($e->getMessage());
        }
    }
    private function handleErrorThrow($errorMsg)
    {
        // Get the Accept header value
        $acceptHeader = $_SERVER['HTTP_ACCEPT'] ?? '';
        // Check if application/json is included in the header
        if (strpos($acceptHeader, 'application/json') !== false) {
            throw new Exception($errorMsg);
            exit;
        } else {
            $this->throwErrorAlert($errorMsg);
        }
    }
    public function setSurveyToken($surveyId) {
        $surveyToken = $this->encryptToken(['surveyId'=> $surveyId]);
        $_SESSION['survey_token'] = $surveyToken;
        return $surveyToken;
    }
    public function getValidatedSurveyId($token, $mode) {
        if($mode == 'complete' && $token != $_SESSION['survey_token']) {
            $msg = SurveyConstants::SURVEY_ERRORS['start_begin_err'];
            $this->handleErrorThrow($msg);
        }
        $ttl = 60 * 60; // 1hour
        ['surveyId' => $surveyId] = $this->getValidatedTokenData($token,null, $ttl);
        return $surveyId;
    }
}
