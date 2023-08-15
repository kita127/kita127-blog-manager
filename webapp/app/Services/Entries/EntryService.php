<?php

namespace App\Services\Entries;

use DOMDocument;
use Illuminate\Http\Client\HttpClientException;

class EntryService
{
    public function getEntries(): array
    {
        [
            'userId' => $userId,
            'apiKey' => $apiKey,
            'apiUri' => $nextUrl,
        ] = $this->getEnv();

        $entries = [];
        $basicAuth = $this->getBasicAuth($userId, $apiKey);
        while ($nextUrl) {
            $endpoint = $nextUrl;
            $response = $this->requestHatena($endpoint, $basicAuth);
            $nextUrl = $this->getNextUrl($response);
            $entries = array_merge($entries, $this->fetchEntries($response));
        }

        return $entries;

    }

    public function getEntry(string $entryId): array
    {
        [
            'userId' => $userId,
            'apiKey' => $apiKey,
            'apiUri' => $apiUri,
        ] = $this->getEnv();
        $basicAuth = $this->getBasicAuth($userId, $apiKey);
        $response = $this->requestHatena($apiUri . '/' . $entryId, $basicAuth);
        $result = $this->fetchEntry($response);
        $result['entryId'] = $entryId;
        return $result;
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
        return $nextUrl;
    }

    public function fetchEntries(string $xml): array
    {
        $dom = new DOMDocument();
        $dom->loadXML($xml);

        $entries = $dom->getElementsByTagName('entry');

        $result = [];
        foreach ($entries as $entry) {
            $tmp = [];
            $children = $entry->childNodes;
            foreach ($children as $child) {
                $name = $child->nodeName;
                $value = $child->nodeValue;

                if ($name === 'link') {
                    // エントリーIDを取得
                    $attrs = $child->attributes;
                    if ($attrs->count() >= 2) {
                        $one = $attrs->item(0);
                        $two = $attrs->item(1);
                        if (
                            $one->nodeName === 'rel'
                            && $one->nodeValue === 'edit'
                            && $two->nodeName === 'href'
                        ) {
                            $entryIdFull = $two->nodeValue;
                            $entryId = last(explode('/', $entryIdFull));
                            $tmp['entryId'] = $entryId;
                        }
                    }

                } else if ($name === 'title') {
                    // タイトル取得
                    $tmp['title'] = $value;
                }
            }
            $result[] = $tmp;

        }

        return $result;
    }

    private function requestHatena(string $uri, string $basicAuth): string
    {
        // < GET通信編 >
        $headers = [
            "Content-type: application/xml",
            "Authorization: Basic " . base64_encode($basicAuth),
        ];

        // 1. curlの処理を始めるためのコネクションを開く
        $get_curl = curl_init();

        $get_http_url = $uri;

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

    private function getEnv(): array
    {
        $userId = env('USER_ID');
        $apiKey = env('API_KEY');
        $apiUri = env('API_URI');

        if (!$userId || !$apiKey || !$apiUri) {
            throw new HttpClientException('envが設定されていません.');
        }

        return [
            'userId' => $userId,
            'apiKey' => $apiKey,
            'apiUri' => $apiUri,
        ];
    }

    private function getBasicAuth(string $userId, string $apiKey): string
    {
        return $userId . ':' . $apiKey;

    }

    private function fetchEntry(string $contents): array
    {
        $dom = new DOMDocument();
        $dom->loadXML($contents);
        $titles = $dom->getElementsByTagName('title');
        $contents = $dom->getElementsByTagName('content');
        return [
            'title' => $titles->item(0)->nodeValue,
            'contents' => $contents->item(0)->nodeValue,
        ];

    }
}