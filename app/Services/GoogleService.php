<?php

namespace App\Services;

use Google_Client;
use Google_Service_Gmail;
use Google_Service_Gmail_Message;
use Swift_Message;
use Google_Service_Books;

/**
 * Class GoogleService
 *
 * @package App\Services
 */
class GoogleService
{

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * @var string
     */
    protected $authConfigFile;

    /**
     * @var Google_Client
     */
    protected $client;

    /**
     * GoogleService constructor.
     * @param string $authConfigFile
     * @param string $apiKey
     */
    function __construct($authConfigFile, $apiKey)
    {
        $this->authConfigFile = $authConfigFile;
        $this->apiKey         = $apiKey;

        $this->client = new Google_Client();
        $this->client->setAuthConfig($authConfigFile);
        $this->client->setApplicationName('google.muratyaman.co.uk');
        $this->client->setDeveloperKey($this->apiKey);
    }

    function findFreeBooks()
    {
        $service = new Google_Service_Books($this->client);
        $optParams = array('filter' => 'free-ebooks');
        $results = $service->volumes->listVolumes('Henry David Thoreau', $optParams);

        $titles = [];
        foreach ($results as $item) {
            $titles[] = $item['volumeInfo']['title'];
        }

        return $titles;
    }

    /**
     * @param string|array $scopes see class GoogleScope
     * @param string $redirectUri
     * @return string
     */
    function createAuthUrl($scopes, $redirectUri = null)
    {
        $this->client->setScopes($scopes);

        if ($redirectUri) {
            $redirectUri = url($redirectUri);
            $this->client->setRedirectUri($redirectUri);
        }

        $url = $this->client->createAuthUrl();

        return $url;
    }

    /**
     * @param string $authCode
     * @return array
     */
    function fetchAccessToken($authCode)
    {
        $token = $this->client->fetchAccessTokenWithAuthCode($authCode);
        $this->client->setAccessToken($token);

        return $token;
    }

    /**
     * @return array
     */
    function getAccessToken()
    {
        $token = $this->client->getAccessToken();

        return $token;
    }

    /**
     * @param array $token
     * @return bool
     */
    function isAccessTokenExpired($token)
    {
        $this->client->setAccessToken($token);
        $result = $this->client->isAccessTokenExpired();

        return $result;
    }

    function getEmailList($token)
    {
        $this->client->setAccessToken($token);

        $gmail   = new Google_Service_Gmail($this->client);
        $userId  = 'me';
        $options = [];
        $result  = $gmail->users_messages->listUsersMessages($userId, $options);

        return $result;
    }

    function sendEmail($token, Swift_Message $mail)
    {
        $result = [];
        $this->client->setAccessToken($token);

        $gmail = new Google_Service_Gmail($this->client);

        $mime = $mail->toString();
        $msg  = base64url_encode($mime);

        $message = new Google_Service_Gmail_Message();
        $message->setRaw($msg);

        $response = $gmail->users_messages->send('me', $message);
        $result['response']   = $response;
        $result['message_id'] = $response->getId();

        return $result;
    }

}