<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="idCard.css">
    <title>ID Card</title>
<style>
    *{
    margin: 00px;
    padding: 00px;
    box-sizing: content-box;
}

.container {
    height: 100vh;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #e6ebe0;
    flex-direction: row;
    flex-flow: wrap;

}

.font{
    height: 375px;
    width: 474px;
    position: relative;
    border-radius: 10px;
}

.top{
    height: 30%;
    width: 100%;
    background-color: #8338ec;
    position: relative;
    z-index: 5;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}

.bottom{
    height: 70%;
    width: 100%;
    background-color: white;
    position: absolute;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
}
.bottom p{
    position: relative;
    top: 60px;
    text-align: center;
    text-transform: capitalize;
    font-weight: bold;
    font-size: 20px;
    text-emphasis: spacing;
}
.bottom .desi{
    font-size:12px;
    color: grey;
    font-weight: normal;
}
.bottom .no{
    font-size: 15px;
    font-weight: normal;
}
.barcode img
{
    height: 65px;
    width: 65px;
    text-align: center;
    margin: 5px;
}
.barcode{
    text-align: center;
    position: relative;
    top: 70px;
}


.qr img{
    height: 80px;
    width: 100%;
    margin: 20px;
    background-color: white;
}
.Details {
    color: white;
    text-align: center;
    padding: 10px;
    font-size: 25px;
}


.details-info{
    color: white;
    text-align: left;
    padding: 5px;
    line-height: 20px;
    font-size: 16px;
    text-align: center;
    margin-top: 20px;
    line-height: 22px;
}

.logo {
    height: 40px;
    width: 150px;
    padding: 40px;
}

.logo img{
    height: 100%;
    width: 100%;
    color: white ;

}
.padding{
    padding-right: 20px;
}
.top{
    display: flex;
    flex-direction: row;
}
.top .card1{
    width:50%;
    height:30px;
}

.card1 img {
    width: 90%;
    padding: 17% 10% 10% 10%;
    height: 61px;
}

.middle{
    padding:4%;
    background-color:#000;
    color:#fff;
    display: flex;
    flex-direction: row;
}

@media screen and (max-width:400px)
{
    .container{
        height: 130vh;
    }
    .container .front{
        margin-top: 50px;
    }
}
@media screen and (max-width:600px)
{
    .container{
        height: 130vh;
    }
    .container .front{
        margin-top: 50px;
    }

}
</style>
</head>
<body>
        <div class="container">
                <div class="font">
                    <div class="top">
                        <div class="card1">
                            <img src="{{asset('assets/images/GAMMA-logo.jpg')}}">
                        </div>
                        <div class="card1" style="padding-right: 5%;">
                            <img src="{{asset('assets/images/site_logos/'.$settings->site_logo)}}">
                        </div>
                    </div>
                    <div class="middle">
                        <div class="card2" style="padding-right:20px;">
                            <p>GAMMA ASIAN MMA CHAMPIONSHIP 2021</p>
                        </div>
                        <div class="card2">
                            <h6>29-31 OCTOBER&nbsp;2021</h6><br>
                            <h6>BANGALORE</h6>
                        </div>
                    </div>
                    <div class="bottom">
                        <p>{{$user->first_name}}&nbsp;{{$user->last_name}}</p>
                        <div class="barcode">
                            <img src="{{asset('assets/images/user_images/'.$user->user_image)}}">
                        </div>
                        <br>
                        <p class="no" style="padding-top:10px;"><b>{{strtoupper($role->name)}}</b></p>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
