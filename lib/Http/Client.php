<?php
namespace xtratio\Onpbx\Http;

use xtratio\Onpbx\Exception\AuthException;
use xtratio\Onpbx\Exception\CurlException;
use xtratio\Onpbx\Response\ApiJsonResponse;

/**
 * HTTP client
 */
class Client
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const API_BASE_PROTO = "https";
    const API_BASE = 'api.onlinepbx.ru/';

    protected $baseUrl;
    protected $authKey;
    protected $needNew;
    // received after authorization
    protected $secretKey;
    protected $secretKeyId;

    public function __construct($domain, $authKey, $needNew = false)
    {
        if ('/' != substr($domain, strlen($domain) - 1, 1)) {
            $domain .= '/';
        }
        
        $this->baseUrl = self::API_BASE.$domain;
        $this->authKey = $authKey;
        $this->needNew = $needNew;
    }
     
    /**
    * Авторизация, делает запрос авторизации и сохраняет секретные ключи в полях экземпляра класса для дальнейшего обмена
    */
    private function auth(){
		$data = array('auth_key'=>$this->authKey);
		if ($this->needNew){$data['new'] ='true';}
        
        try {
            $result = $this->sendHttpRequest("auth.json", self::METHOD_POST, $data);
            if($result["status"] != 1){
                throw new AuthException("Api authorization error", 1);
            }
            $this->secretKey = $result["data"]["key"];
            $this->secretKeyId = $result["data"]["key_id"];
        } catch (CurlException $e) {
            throw new AuthException("Api authorization request error", 2, $e);
        }
	}
    
    public function sendRequest($path, $post){    
        if(!isset( $this->secretKey) || !isset( $this->secretKeyId) || empty( $this->secretKey) || empty( $this->secretKeyId)){
            $this->auth();
        }
		
		if (is_array($post)){
			foreach ($post as $key => $val){
				if (is_string($key) && preg_match('/^@(.+)/', $val, $m)){
					$post[$key] = array('name'=>basename($m[1]), 'data'=>base64_encode(file_get_contents($m[1])));
				}
			}
		}
        
        $signUrl = $this->baseUrl . $path;
		$date = @date('r');
		$data = http_build_query($post);
		$content_type = 'application/x-www-form-urlencoded';
		$content_md5 = hash('md5', $data);
        $signData = self::METHOD_POST."\n{$content_md5}\n{$content_type}\n{$date}\n{$signUrl}\n";
		$signature = base64_encode(hash_hmac('sha1', $signData, $this->secretKey, false));
		$headers = array('Date: '.$date, 'Accept: application/json', 'Content-Type: '.$content_type, 'x-pbx-authentication: '.$this->secretKeyId.':'.$signature, 'Content-MD5: '.$content_md5);
		
        return $this->sendHttpRequest($path, self::METHOD_POST, $data, $headers);
	}

    /**
     * Make HTTP request
     *
     * @param string $url
     * @param string $method (default: 'GET')
     * @param array $parameters (default: array())
     * @param int $timeout
     * @return ApiJsonResponse
     */
    private function sendHttpRequest($path, $method, $parameters = array(), array $headers = array(), $timeout = 60)
    {
        $allowedMethods = array(self::METHOD_GET, self::METHOD_POST);
        if (!in_array($method, $allowedMethods)) {
            throw new InvalidArgumentException(sprintf(
                'Method "%s" is not valid. Allowed methods are %s',
                $method,
                implode(', ', $allowedMethods)
            ));
        }

        $url = self::API_BASE_PROTO."://".$this->baseUrl. $path;
        if (self::METHOD_GET === $method && sizeof($parameters)) {
            $url .= '?' . http_build_query($parameters);
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, (int) $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        
        if (self::METHOD_POST === $method) {
            
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, self::METHOD_POST);           
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        }
        
        if (sizeof($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $responseBody = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $errno = curl_errno($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($errno) {
            throw new CurlException($error, $errno);
        }

        return new ApiJsonResponse($statusCode, $responseBody);
    }
}
