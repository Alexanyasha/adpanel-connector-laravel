<?php

namespace DesignCoda\AdpanelConnector;

class AdpanelConnector
{    
    // public static function sendError($e)
    // {
    //     $api_url = env('MONLOGS_API_URL');
    //     $api_key = env('MONLOGS_API_KEY');
        
    //     if(! $api_key || $api_key == '') {
    //         info("Error. Log wasn't sent to Monlogs. Enter API key");
    //         return;
    //     }
        
    //     if(! $api_url || $api_url == '') {
    //         info("Error. Log wasn't sent to Monlogs. Enter API URL");
    //         return;
    //     }
        
    //     $data = [
    //         'message' => $e->getMessage(),
    //         'file' => $e->getFile(),
    //         'line' => $e->getLine(),
    //         'trace' => $e->getTraceAsString(),
    //         'user_id' => auth()->id(),
    //         'url' => request()->url(),
    //         'site' => request()->getHttpHost(),
    //         'api_key' => $api_key,
    //     ];
        
    //     if($e instanceof NotFoundHttpException) {
    //         if($data['message'] == '') {
    //             $data['message'] = $data['url'] . ' not found';
    //         }
            
    //         $data['referrer'] = $data['url'];
    //     }
        
    //     $data_string = json_encode($data);
    //     $auth_username = "test";
    //     $auth_password = "test";

    //     $ch = curl_init($api_url);
    //     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_USERPWD, "{$auth_username}:{$auth_password}");
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, [
    //             'Content-Type: application/json',
    //             'Accept : application/json',
    //             'Content-Length: ' . strlen($data_string),
    //         ]
    //     );
        
    //     try {
    //         $result = curl_exec($ch);
    //         $api_response = json_decode($result);
            
    //         if(isset($api_response->result) && $api_response->result == 'success') {
    //             info('Log was sent to Monlogs');
    //             logger(print_r($api_response, true));
    //         } else {
    //             info("Error. Log wasn't sent to Monlogs");
    //             logger(print_r($api_response, true));
    //             if(curl_errno($ch)){
    //                 logger('Curl error: ' . curl_error($ch));
    //             }
    //         }
    //     } catch(\Exception $e) {
    //         info("Error. Log wasn't sent to Monlogs. Curl error");
    //     }
        
    //     curl_close($ch);
    // }
}
