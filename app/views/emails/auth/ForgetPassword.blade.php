<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Password Request</title>
    <style>
        .body{

            color:#000000;
            font-family: 'Adobe Caslon Pro', Adobe Caslon Pro;
            font-size:18px;
            line-height:1;
            padding: 20px 20px;
            padding:3px;
        }
        .content{
            background-color:white;
            box-sizing:border-box;
            -moz-box-sizing:border-box; /* Firefox */

            width:100%;
            border:1px solid black;

        }
        .nav{
            background-color:#8AB8E6;
            padding:10px;
            color:white;
        }
        .main{
            margin-top:5px;
            padding-left:10px;

        }
        .btn
        {
            border:1e solid blue;
            text-decoration:none;
            color:white;
            padding-left:8px;
            padding-right:10px;
            background-color:#A1C65B;


        }
        .btn:hover{
            background-color:#C43C35;

        }
        .row{
            border:5ex solid lightgrey;
            margin-left:10%;
            width:75%;

        }

    </style>
</head>
<body class="body" style="color:#000000;font-family: 'Adobe Caslon Pro', Adobe Caslon Pro;font-size:18px;line-height:1;padding: 20px 20px;padding:3px;">
<div class="row" style="border:5ex solid lightgrey;margin-left:10%;width:75%;">
    <img src="" style="width:150px;height:50px"/>
    <div class="content" style="background-color:white;box-sizing:border-box;-moz-box-sizing:border-box; width:100%;
            border:1px solid black;">
        <div class="nav" style=" background-color:#8AB8E6;padding:10px;color:white;">
            Reset Password
        </div>
        <div class="main" style="margin-top:5px;padding-left:10px;font-family: 'Adobe Caslon Pro', Adobe Caslon Pro;font-size:18px;">
            Dear: {{ucfirst($displayName)}}<br>
            UserName:{{$username}}<br>

            <p style="text-align:paragrah;font-family: 'Adobe Caslon Pro', Adobe Caslon Pro;font-size:18px;">
                You have requested to have your password reset for your account<br>
                If you don't want to reset your password please ignore this mail <br><br>
                Please click this button to reset your password
                <span onmouseover="style.backgroundColor='red'"> <a href='{{$link}}' class="btn"  style="border:1e solid blue;text-decoration:none;color:white;padding-left:8px;padding-right:10px;background-color:#A1C65B;">
                        Reset</a>
                </span>
                <br>
                <br>
            </p>
        </div>
    </div>
</div>
</body>
</html>



