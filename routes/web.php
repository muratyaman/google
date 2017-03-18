<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Services\GoogleService\GoogleScope;
use Swift_Message;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/oauth2init', function () {
    $googleService = app('services.google');
    $scopes = [
        GoogleScope::GMAIL_VIEW_EMAILS_AND_SETTINGS,
        GoogleScope::GMAIL_DRAFT_AND_SEND,
        GoogleScope::CALENDAR_MANAGE,
        GoogleScope::CALENDAR_VIEW,
    ];
    $url  = $googleService->createAuthUrl($scopes);//, '/oauth2callback');
    $data = [
        'google_auth_url' => $url,
    ];
    return view('oauth2init', $data);
});

Route::get('/oauth2callback', function () {
    $request = request();

    $data = [
        'info' => $request,
    ];

    $code = request('code');
    if ($code) {
        $googleService = app('services.google');
        $token = $googleService->fetchAccessToken($code);
        $tokenStr = json_encode($token);
        logger('token');
        logger($tokenStr);
        //$data['info']['token'] = $tokenStr;
        $qry = http_build_query(['token' => $tokenStr]);
        return redirect('/oauth2use?' . $qry);
    }

    return view('oauth2callback', $data);
});

Route::get('/oauth2use', function () {
    $request = request();

    $data = [
        'info' => [],//$request,
    ];

    $token = request('token');
    if ($token) {
        $token = json_decode($token, $assoc = true);
        $googleService = app('services.google');
        $expired = $googleService->isAccessTokenExpired($token);
        if ($expired) {
            $data['info']['token-expired'] = 'expired';
        } else {

            //create MIME message using SwiftMailer
            $mail = Swift_Message::newInstance()
                ->setTo(array('muratyaman@gmail.com'))
                ->setSubject('testing gmail api ' . date('Ymd His'))
                ->setBody('long message here please ' . date('His') . ' thanks');
            $result = $googleService->sendEmail($token, $mail);
            $data['info']['message'] = json_encode($result);
        }
    }

    return view('oauth2use', $data);
});