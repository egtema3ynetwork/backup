<?php

/**
 * A simple Facebook PHP example.
 *
 * - This is not a "Facebook SDK".
 * - This example uses Curl, Hash, JSON, Session extensions.
 * - This does not use the JavaScript SDK, nor the cookie set by it.
 * - This works with Canvas, Page Tabs with IFrames, the Registration Plugin
 *   and with any other flow which uses the signed_request.
 *
 * @author Naitik Shah <n@daaku.org>
 */
function idx($array, $key, $default = null) {
    return array_key_exists($key, $array) ? $array[$key] : $default;
}

class FacebookApiException extends Exception {

    public function __construct($response, $curlErrorNo) {
        $this->response = $response;
        $this->curlErrorNo = $curlErrorNo;
    }

}

function LoadFromFacebook($url) {
    global $outdata;
    try {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: graph.facebook.com'));
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    } catch (Exception $ex) {
        $outdata[] = "error = " . $ex->getMessage();
        return null;
    }
}

class Facebook {

    public function __construct($opts) {
        $this->appId = $opts['appId'];
        $this->secret = $opts['secret'];
        $this->accessToken = idx($opts, 'accessToken');
        $this->userId = idx($opts, 'userId');
        $this->signedRequest = idx($opts, 'signedRequest', array());
        $this->maxSignedRequestAge = idx($opts, 'maxSignedRequestAge', 86400);
        $this->redirect_uri = $opts['redirect_uri'];
    }

    public function loadSignedRequest($signedRequest) {
        list($signature, $payload) = explode('.', $signedRequest, 2);
        $data = json_decode(self::base64UrlDecode($payload), true);
        if (isset($data['issued_at']) &&
                $data['issued_at'] > time() - $this->maxSignedRequestAge &&
                self::base64UrlDecode($signature) ==
                hash_hmac('sha256', $payload, $this->secret, $raw = true)) {
            $this->signedRequest = $data;
            $this->userId = idx($data, 'user_id');
            $this->accessToken = idx($data, 'oauth_token');
        }
    }

    public function api($path, $params = null, $method = 'GET', $domain = 'graph') {
        if (!$params)
            $params = array();
        $params['method'] = $method;
        if (!array_key_exists('access_token', $params) && $this->accessToken)
            $params['access_token'] = $this->accessToken;
        $ch = curl_init();
        
        curl_setopt_array($ch, array(
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_BINARYTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_HTTPHEADER => array('Host: graph.facebook.com'),
            CURLOPT_POSTFIELDS => http_build_query($params, null, '&'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_URL => "https://$domain.facebook.com$path",
            CURLOPT_USERAGENT => 'nshah-0.1',
        ));
        $result = curl_exec($ch);
        $decoded = json_decode($result, true);
        $curlErrorNo = curl_errno($ch);
        curl_close($ch);

        //if ($curlErrorNo !== 0 || (is_array($decoded) && isset($decoded['error'])))
           // throw new FacebookApiException($decoded, $curlErrorNo);
        return $decoded;
    }

    public static function base64UrlDecode($input) {
        return base64_decode(strtr($input, '-_', '+/'));
    }

}



/*
  $fb = FB();
  $registration_plugin_url =
  'http://www.facebook.com/plugins/registration.php?' .
  http_build_query(array(
  'client_id' => $fb->appId,
  'redirect_uri' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'fields' => 'name,email'));
  ?>
  <pre><?php print_r($fb); ?></pre>
  <?php if (!$fb->userId) { ?>
  <h3>Registration</h3>
  <iframe src="<?php echo $registration_plugin_url; ?>"
  scrolling="auto"
  frameborder="no"
  style="border:none"
  allowTransparency="true"
  width="600"
  height="330">
  </iframe>
  <?php } else { ?>
  <h3>API Call</h3>
  <pre><?php echo "welcome : ".$fb->api('/me')->name; ?></pre>
  <?php } ?> */
?>