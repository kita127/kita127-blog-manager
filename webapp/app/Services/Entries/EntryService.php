<?php

namespace App\Services\Entries;

use DOMDocument;
use Illuminate\Http\Client\HttpClientException;

class EntryService
{
    public function getEntries(): string
    {
        // < GET通信編 >

        $userId = env('USER_ID');
        $apiKey = env('API_KEY');
        $endpoint = env('API_URI');

        if (!$userId || !$apiKey || !$endpoint) {
            throw new HttpClientException('envが設定されていません.');
        }

        $basicAuth = base64_encode($userId . ':' . $apiKey);

        $headers = [
            "Content-type: application/xml",
            "Authorization: Basic " . $basicAuth,
        ];

        // 1. curlの処理を始めるためのコネクションを開く
        $get_curl = curl_init();

        $get_http_url = $endpoint;

        // 2. HTTP通信のRequest-設定情報をSetする
        curl_setopt($get_curl, CURLOPT_URL, $get_http_url); // url-setting
        curl_setopt($get_curl, CURLOPT_CUSTOMREQUEST, "GET"); // メソッド指定 Ver. GET
        curl_setopt($get_curl, CURLOPT_HTTPHEADER, $headers); // HTTP-HeaderをSetting
        //        curl_setopt($get_curl, CURLOPT_SSL_VERIFYPEER, false); // サーバ証明書の検証は行わない。
        //        curl_setopt($get_curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($get_curl, CURLOPT_RETURNTRANSFER, true); // レスポンスを文字列で受け取る

        // 3. curl(HTTP通信)を実行する => レスポンスを変数に入れる
        $get_response = curl_exec($get_curl);

        // 4. HTTP通信の情報を得る
        $get_http_info = curl_getinfo($get_curl);

        // 5. curlの処理を終了 => コネクションを切断
        curl_close($get_curl);

        return $get_response;

    }

    public function getNextUrl(string $contents): string
    {
        $xmlString = $contents;
        $dom = new DOMDocument();
        $dom->loadXML($xmlString);

        $links = $dom->getElementsByTagName('link');

        $nextUrl = '';
        foreach ($links as $link) {
            $attrs = $link->attributes;

            // next は属性が２つ以上あるはず
            if ($attrs->count() < 2) {
                continue;
            }
            $one = $attrs->item(0);
            $two = $attrs->item(1);

            if (
                $one->nodeName === 'rel'
                && $one->nodeValue === 'next'
                && $two->nodeName === 'href'
            ) {
                $nextUrl = $two->nodeValue;
                break;
            }
        }


        // if ($links->length > 0) {
        //     $elementValue = $links->item($id);
        // }

        return $nextUrl;
    }
}