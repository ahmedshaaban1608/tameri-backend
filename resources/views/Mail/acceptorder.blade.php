<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    ul{
      list-style-type: none;
    }
    ul li{
      margin-bottom: 15px
    }
    .view{
      text-align:center!important;
    }
   .viewBtn{
  border-radius: 20px!important;
  padding: 20px 50px!important;
  background: darkcyan!important;
  color: white!important;
  font-weight:bold!important;
  text-decoration: none!important;
  margin-top:20px!important;
}
  </style>
</head>
<body>
<h2>Congrats, {{$formData['tourist_name']}}</h2>
<h4>Order Details</h4>
<hr>
<ul>
  <li><strong>Tourguide Name: </strong>{{$formData['tourguide_name']}}</li>
  <li><strong>Destination: </strong>{{$formData['city']}}</li>
  <li><strong>Start Date: </strong>{{$formData['startDate']}}</li>
  <li><strong>End Date: </strong>{{$formData['endDate']}}</li>
  <li><strong>totalPrice: </strong>{{$formData['totalPrice']}} USD</li>
  <li><strong>Additional Notes: </strong>{{$formData['comment']}}</li>
</ul>
<br>
<div class="view">
<p >Please visit your profile to complete the booking process</p>
<br>
<a href="{{ env('FRONTEND_URL') }}/profile" class="viewBtn">complete the order</a>

</div>
<div style="margin-top:30px">
<span>Ta-meri Team</span>
</div>
</body>
</html>