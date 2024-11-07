<?php

namespace GSpreadSheet;

class Sheet {
    private $token;
    private $spreadsheetId;

    public function __construct($serviceAccountJSON, $spreadsheetId) {
        $this->token = Auth::getToken($serviceAccountJSON);
        $this->spreadsheetId = $spreadsheetId;
    }

    private function request($method, $endpoint, $range = null, $data = null) {      
        if ($range != null) {
            $range = '/' . $range;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://sheets.googleapis.com/v4/spreadsheets/{$this->spreadsheetId}/values{$range}" . $endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->token,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        switch($method) {
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, true);
                break;
            case 'PUT':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                break;
            default:
                break;
        }

        if ($data != null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        return json_decode($response, true);
    }

    public function append($range, $values) {   
        return $this->request(
            'POST', 
            ':append?valueInputOption=RAW', 
            $range, 
            [
                'values' => [$values]
            ]
        );
    }

    public function get($range) {
        return $this->request(
            'GET', 
            '?majorDimension=ROWS', 
            $range
        )['values'];
    }

    public function update($range, $values) {
        return $this->request(
            'PUT', 
            '?valueInputOption=RAW', 
            $range, 
            [
                'values' => [$values]
            ]
        );
    }

    public function clear($range) {
        return $this->request(
            'POST', 
            ':clear',
            $range
        );
    }
}

?>