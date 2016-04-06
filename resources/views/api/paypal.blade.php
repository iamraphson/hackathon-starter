@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="main-container">

            <div class="page-header">
                <h2><i style="color: #1B4A7D" class="fa fa-paypal"></i>PayPal API</h2>
            </div>

            <div class="btn-group btn-group-justified">
                <a href="https://developer.paypal.com/docs/integration/direct/make-your-first-call/" target="_blank" class="btn btn-primary">
                    <i class="fa fa-check-square-o"></i> Quickstart
                </a>
                <a href="https://developer.paypal.com/docs/api/" target="_blank" class="btn btn-primary">
                    <i class="fa fa-code"></i> API Reference
                </a>
                <a href="https://devtools-paypal.com/hateoas/index.html/" target="_blank" class="btn btn-primary">
                    <i class="fa fa-gear"></i> API Playground
                </a>
            </div>

            <h3><i class="fa fa-money"></i> Sample Payment</h3>


            @if($status == 2)
                 <h3>Payment got canceled!</h3>
            @elseif($status == 0)
                 <h3>Payment got executed successfully!</h3>
            @else
                <div>
                    <p>Redirects to PayPal and allows authorizing the sample payment.</p>
                    <a href="{{ url('api/paypal/checkout') }}">
                        <button class="btn btn-primary">Authorize payment</button>
                    </a>
                </div>
            @endif

            <br>
        </div>
    </div>
@endsection
