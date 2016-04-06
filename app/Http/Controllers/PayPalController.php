<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paypal;
use App\Http\Requests;

class PayPalController extends Controller{

    protected $_apiContext;

    public function __construct(){
        $this->_apiContext = PayPal::ApiContext(env('PAYPAL_ID'), env('PAYPAL_SECRET'));

        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));
    }

    public function index(){
        return view('api.paypal')->withStatus('1');
    }

    public function getCheckout(){
        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');

        $amount = PayPal::Amount();
        $amount->setCurrency('USD');
        $amount->setTotal(4);

        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('Laravel Demo!!');

        $redirectUrls = PayPal::RedirectUrls();
        $redirectUrls->setReturnUrl(action('PayPalController@getDone'));
        $redirectUrls->setCancelUrl(action('PayPalController@getCancel'));

        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;

        return redirect($redirectUrl);
    }

    public function getDone(Request $request){
        $id = $request->get('paymentId');
        $token = $request->get('token');
        $payer_id = $request->get('PayerID');

        $payment = PayPal::getById($id, $this->_apiContext);

        $paymentExecution = PayPal::PaymentExecution();

        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        //Clear Cart, Send Notification and start delivery process..

        return view('api.paypal')->withStatus(0);
    }

    public function getCancel(){
        return view('api.paypal')->withStatus(2);
    }
}
