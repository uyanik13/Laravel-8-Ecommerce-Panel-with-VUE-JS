<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h3 >Ürün sayfasından yeni bir mail aldınız</h3>
<br><br>
<b>İsim </b>: {{$data['order_name']}}<br>
<b> Email</b>: {{$data['email']}}<br>
<b>Telefon Numarası </b>: {{$data['order_phone']}}<br>
<b>Ürün</b> : {{$data['order_product']}}
<br><br>
<b>Mesajı </b>: {{$data['order_note']}}<br>

</body>
</html>
