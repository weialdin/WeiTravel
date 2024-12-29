@extends('layouts.app')

@section('content')
    <h2>Payment for Booking #{{ $packageBooking->id }}</h2>
    <button id="pay-button">Pay Now</button>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        var snapToken = "{{ session('snapToken') }}";
        document.getElementById('pay-button').onclick = function () {
            window.snap.pay(snapToken, {
                onSuccess: function(result){
                    window.location.href = '/admin/package_bookings/complete/' + {{ $packageBooking->id }};
                },
                onPending: function(result){
                    console.log('Transaction pending');
                },
                onError: function(result){
                    console.log('Transaction error');
                },
                onClose: function(){
                    console.log('Payment popup closed');
                }
            });
        };
    </script>
@endsection
