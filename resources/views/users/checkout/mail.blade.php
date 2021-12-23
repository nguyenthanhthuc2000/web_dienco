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
<div>
    <p>Hi {{ $name }}</p>
    {!! $content !!}
    @if($reduce > 0)
    <p>Thành tiền: {{number_format($total,0,',','.')}} vnđ</p>
    <p>Giảm giá: {{number_format($reduce,0,',','.')}} vnđ</p>
    <p>Tổng thanh toán: {{number_format($total - $reduce,0,',','.')}} vnđ</p>
    @else
    <p>Tổng: {{number_format($total,0,',','.')}} vnđ</p>
    @endif
    <p>Mã hóa đơn: {{$order}}</p>
    <p>Địa chỉ nhận hàng: {{$address}}</p>
    <p>Nếu có vấn đề gì về hóa đơn của bạn, vui lòng liên hệ 033.3333.333 để được giải đáp</p>
    <p>Trân trọng cảm ơn!</p>
</div>
</body>
</html>
