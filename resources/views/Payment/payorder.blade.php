<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  @if($order->payment === 'pending')
<div class="container d-flex justify-content-center align-items-center mt-5 m-auto" style="max-width:600px">
  <div class="row mt-5 ">
    <h1 class="mb-3"> Welcome Ahmed</h1>
    <h4 class="mb-3"> make a payment to complete the booking process</h4>
    <table class="table table-striped">
<tbody>
      <tr>
        <th>Order Id</th>
        <td>{{$order->id}}</td>
      </tr>
      <tr>
        <th> Tourguide Name</th>
        <td>{{$tourguide->user['name']}}</td>
      </tr>
      <tr>
        <th>Destination</th>
        <td>{{$order->city}}</td>
      </tr>
      <tr>
        <th>Total Price</th>
        <td>{{$order->total}}</td>
      </tr>
    </tbody>
    </table>
  </div>

</div>


<div class="container d-flex justify-content-center align-items-center mt-5 m-auto">
<form action="{{ route('charge', $order->id) }}" method="POST">
@csrf
<input type="hidden" name="price" value="{{ $order->total }}">
<input type="hidden" name="id" value="{{ $order->id }}">


<script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="{{ env('STRIPE_KEY') }}"
data-amount="{{  $order->total }}00" data-name="Test stripe payment" data-description="test test test"
data-image="image" data-locale="auto" data-currency="usd" data-order = "{{$order->id}}"></script>
</form>
</div>
@else
<div class="container d-flex justify-content-center align-items-center mt-5 m-auto" style="max-width:600px">
  <div class="row mt-5 text-center">
  <h1 class="mb-3 mt-5"> Payment is already done</h1>
    <h4 class="mb-3">nothing to do here</h4>
    <a href="{{ env('FRONTEND_URL') }}/profile" class="btn btn-primary">Back to Profile</a>
</div>
</div>
@endif

</body>
</html>