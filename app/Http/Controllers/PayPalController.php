<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{
    /** 
     * NOTE BY STEVEN
     * to get the PayPal Credential please used Rest API with Curl/PostMan to get the token first.
     * then get the business account API credentials
     * 
     */
    public function payment() {
        $data = [];
        // define object price 100$ dollar
        // maximum test is just 1499$ USD dollar, cannot exceed then limit
        $data['items'] = [
            [
                'name' => 'Steven Yeo Item',
                'price' => 1500,
                'desc' => 'Testing Paypal Prototype',
                'qty' => 1
            ]
        ];

        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Item Testing";
        // route for success
        $data['return_url'] = route('payment.success');
        // route for cancel
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = 1500;

        $provider = new ExpressCheckout;

        // $response = $provider->setExpressCheckout($data);

        $response = $provider->setExpressCheckout($data, true);

        // paypal link url default from paypal page
        return redirect($response['paypal_link']);
    }

    public function cancel() {
        dd('Your payment is canceled. You can create cancel page here.');
    }

    public function success(Request $request) {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            dd('Payment Success');
        } else {
            dd('Payment Error');
        }

        
    }
    
}
