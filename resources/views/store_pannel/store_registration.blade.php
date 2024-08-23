<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>store registration</title>
</head>
<body>
<div class="store_registration_outer">
    <div class="store_registration_inner">
        <form action="{{route('store_registration')}}" method="post">
            @csrf
            <li id="store_name">STORE REGISTRATION </li>
            @foreach ($errors->all() as $err)
              <li id="errors">{{$err}}</li>
            @endforeach
            <label for="email">STORE NAME</label>
            <input type="text" required name="store_name" id="name"><br><br>

            <label for="email">OWNER MOBILE_NUMBER</label>
            <input type="text" required name="mobile" id="mobile"><br><br>
            
            <label for="email">STORE EMAIL</label>
            <input type="email" required name="email" id="email"><br><br>

            <label for="password">STORE PASSWORD</label>
            <input required type="password" name="password" id="Password"><br><br>
@php
    $store_id=rand(000000,999999)
@endphp
            <input type="text" required name="store_id" value="{{$store_id}}" hidden><br><br>


            <input type="submit" name="submit" id="store_submit" value="STORE_REGISTRATION"><br><br>
        </form>
    </div>
</div>
</body>
<style>
 *{
    margin: 0;
    padding: 0;
 }
 .store_registration_outer{
        display: flex;
        flex-direction: column;
        align-content: center;
        justify-content: center;
        width: 100vw;
        height: 100vh;
        background-color:whitesmoke; 
    }
    .store_registration_inner{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-content: center;
        align-items: center;
    }
#mobile{
    margin-left: 15px;
  padding-right: 29px;
}

    #store_name{
        margin-left: 57px;
        margin-bottom: 52px;
        font-size: 4vh;
        list-style: none;
    }

#name{
    margin-left: 114px;
    padding-right: 29px;
}

    #email{
        margin-left: 111px;
        padding-right: 29px;
    }

    #Password{
        margin-left: 76px;
        padding-right: 29px;
    }

    #store_submit{
             font-size: 16px;
       margin-left: 105px;
       margin-top: 20px;
       padding: 2px;
         padding-right: 2px;
         padding-bottom: 2px;
         padding-left: 2px;
       padding-left: 12px;
       padding-right: 12px;
       padding-bottom: 4px;
       border-radius:9px; 
    }

form{
    margin-top: -50px;
    margin-left: -70px;
}

#store_submit:hover{
    cursor: pointer;
    color: red;
   
}

#errors{
    padding-bottom: 33px;
  margin-top: -24px;
  color: red;
  font-style: ;
  font-weight: bold;
  font-size: 21px;
}
</style>
</html>