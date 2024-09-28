<?php

namespace App\Http\Services\Payment;

use Zarinpal\Zarinpal;
use Illuminate\Http\Request;
use Zarinpal\Clients\GuzzleClient;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Client\RequestException;

class PaymentZarinPal
{

    // function request($onlinePayment, $amount)
    // {

    //     $merchantID = Config::get('payment.zarinpal.merchantID');;
    //     $sandbox = true;
    //     $zarinGate = false; // OR true
    //     $zarinGatePSP = ''; // Leave this parameter blank if you don't need a custom PSP zaringate.
    //     $client = new GuzzleClient($sandbox);
    //     $lang = 'fa'; // OR en
    //     $zarinpal = new Zarinpal($merchantID, $client, $lang, $sandbox, $zarinGate, $zarinGatePSP);

    //     $payment = [
    //         'callback_url' => route('payment.call-back'), // Required
    //         'amount' => $amount * 10,                    // Required
    //         'description' => 'خرید از وب سایت',   // Required
    //     ];

    //     try {
    //         $response = $zarinpal->request($payment);
    //         $code = $response['data']['code'];
    //         $message = $zarinpal->getCodeMessage($code);
    //         if ($code === 100) {
    //             $authority = $response['data']['authority'];
    //             $onlinePayment->update([
    //                 "bank_first_response" => $response
    //             ]);
    //             return $zarinpal->redirect($authority);
    //         }
    //         return "Error, Code: $code, Message: $message";
    //     } catch (RequestException $exception) {
    //         // handle exception
    //     }
    // }

    function request($onlinePayment, $amount)
    {
        $merchantID = Config::get('payment.zarinpal.merchantID');
        $sandbox = true;
        $zarinGate = false; // OR true
        $zarinGatePSP = ''; // Leave this parameter blank if you don't need a custom PSP zaringate.
        $client = new GuzzleClient($sandbox);
        $lang = 'fa'; // OR en
        $zarinpal = new Zarinpal($merchantID, $client, $lang, $sandbox, $zarinGate, $zarinGatePSP);

        $payment = [
            'callback_url' => route('payment.call-back'), // Required
            'amount' => $amount,                    // Required
            'description' => 'by somting from digikala',   // Required
        ];
        try {
            $response = $zarinpal->request($payment);
            $code = $response['data']['code'];
            $message = $zarinpal->getCodeMessage($code);
            if ($code === 100) {
                $authority = $response['data']['authority'];
                $onlinePayment->update([
                    "bank_first_response" => $response
                ]);
                return $zarinpal->redirect($authority);
            }
            return "Error, Code: $code, Message: $message";
        } catch (RequestException $exception) {
            // handle exception
        }
    }


    function verify($onlinePayment, $amount, Request $request, Zarinpal $zarinpal)
    {
        $payment = [
            'authority' => $request->input('Authority'), // $_GET['Authority']
            'amount' => $amount
        ];
        if ($request->input('Status') !== 'OK')
            abort(406);
        try {
            $response = $zarinpal->verify($payment);
            $code = $response['data']['code'];
            $message = $zarinpal->getCodeMessage($code);
            if ($code === 100) {
                $refId = $response['data']['ref_id'];
                $onlinePayment->update(["bank_second_response" => $response]);
                return "Payment was successful, RefID: $refId, Message: $message";
            }
            return "Error, Code: $code, Message: $message";
        } catch (RequestException $exception) {
            // handle exception
        }
    }

}
