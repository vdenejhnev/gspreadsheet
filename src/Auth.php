<?php

namespace GSpreadSheet;

class Auth {
    public static function getToken($serviceAccountJSON) {
        $key = json_decode(file_get_contents($serviceAccountJSON), true);
        $now = time();
        $header = json_encode(['alg' => 'RS256', 'typ' => 'JWT']);
        $claimSet = json_encode([
            'iss' => $key['client_email'],
            'scope' => 'https://www.googleapis.com/auth/spreadsheets',
            'aud' => 'https://oauth2.googleapis.com/token',
            'exp' => $now + 3600,
            'iat' => $now
        ]);
    
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlClaimSet = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($claimSet));
    
        $signature = '';
        openssl_sign($base64UrlHeader . '.' . $base64UrlClaimSet, $signature, $key['private_key'], OPENSSL_ALGO_SHA256);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
    
        $jwt = $base64UrlHeader . '.' . $base64UrlClaimSet . '.' . $base64UrlSignature;
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://oauth2.googleapis.com/token');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $jwt
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        $responseData = json_decode($response, true);
        return $responseData['access_token'];
    }
}