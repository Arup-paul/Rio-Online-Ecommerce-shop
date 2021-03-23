<!doctype html>
<html lang="en">
<head>
    <title>Register</title>
</head>
<body>
<table>
    <tr>
        <td>Dear {{$name}}</td>
    </tr>


    <tr>
        <td>&nbsp;</td>
    </tr>

    <tr>
        <td>Please click below link activate your account</td>
    </tr>


    <tr>
        <td><a href="{{url('confirm/'.$code)}}"></a>Confirm Account</td>
    </tr>

    <tr>
        <td>&nbsp;</td>
    </tr>



    <tr>
        <td>Thanks & Regards</td>
    </tr>

    <tr>
        <td>
            Rio Ecommerce
        </td>
    </tr>



</table>

</body>
</html>
