<?php

namespace trylife\atk;

use GuzzleHttp\Client;
use yii\base\Component;

class Atk extends Component
{
    /** @var string wechat mini program */
    const APP_TYPE_WXMP = 'wxmp';

    public $atkBaseUrl;
    public $appType;
    public $appId;

    /** @var Token cache result */
    protected $token;

    public function token($refreshCache = false): ?Token
    {
        if ($refreshCache == true || $this->token === null) {
            $this->token = $this->remoteGet();
        }
        return $this->token;
    }

    protected function remoteGet(): ?Token
    {
        $client = new Client();
        $res = $client->request('GET', $this->reqUrl(), [
            'auth' => ['user', 'pass']
        ]);

        if ($res->getStatusCode() != 200) {
            return null;
        }

        $body = $res->getBody()->getContents();
        $j = json_decode($body, true);

        $token = new Token();
        $token->appType = $j['token']['app_type'];
        $token->appId = $j['token']['app_id'];
        $token->accessToken = $j['token']['access_token'];
        $token->expiresIn = $j['token']['expires_in'];

        return $token;
    }

    protected function reqUrl(): string
    {
        return implode("/", [
            $this->atkBaseUrl,
            'app',
            $this->appType,
            $this->appId,
            'token'
        ]);
    }
}