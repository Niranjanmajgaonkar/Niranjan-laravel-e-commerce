<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>store login</title>
</head>
<body>
<div class="store_login_outer">
    <div class="store_login_inner">
        <form action="{{route('store_login')}}" method="post">
            @csrf
            <li id="store_name">STORE LOGIN </li>
                @foreach ($errors->all() as $err)
                <li id="errors">{{$err}}</li>
                @endforeach

           @isset($success)
           <li id="success">{{$success}}</li>
           @endisset
             
           @if (session('success'))
               <li style="color: green">{{session('success')}}</li><br>
           @endif
            <label for="email">Enter store EMAIL</label>
            <input required type="email" name="email" id="email"><br><br>
            
            <label for="password">Enter store PASSWORD</label>
            <input required type="password" name="password" id="Password"><br><br>
            <a href="/store/forget_password">Forget Password</a><br>

            <input type="submit" name="submit" id="store_submit" value="store_login"><br><br>

        </form>
        <a href="/store/registration"><button id="store_registration">store_Registration</button></a><br><br>
    </div>
</div>
</body>
<style>
 *{
    margin: 0;
    padding: 0;
 }
 .store_login_outer{
        display: flex;
        flex-direction: column;
        align-content: center;
        justify-content: center;
        width: 100vw;
        height: 100vh;
        background-color:wheat; 
    }
    .store_login_inner{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-content: center;
        align-items: center;
    }


    #store_name{
        margin-left: 100px;
        margin-bottom: 27px;
        font-size: 4vh;
        list-style: none;
    }



    #email{
        margin-left: 53px;
        padding-right: 42px;
    }

    #Password{
        margin-left: 19px;
        padding-right: 42px;
    }

    #store_submit{
             font-size: 16px;
       margin-left: 137px;
       margin-top: 20px;
       padding: 2px;
         padding-right: 2px;
         padding-bottom: 2px;
         padding-left: 2px;
       padding-left: 12px;
       padding-right: 12px;
       padding-bottom: 4px;
       border-radius: 9px;
    }

form{
    margin-top: -50px;
    margin-left: -70px;
}

#store_submit:hover{
    cursor: pointer;
    color: red;

}

#store_registration{
    font-size: 16px;
  padding-top: 3px;
  padding-bottom: 3px;
  padding-left: 23px;
  padding-right: 23px;
  margin-left: -90px;
  border-radius: 9px;
}
#errors{
    padding-bottom: 33px;
  margin-top: -24px;
  color: red;
  font-style: ;
  font-weight: bold;
  font-size: 21px;
}
#success{
    padding-bottom: 33px;
  margin-top: -24px;
  color: green;
  font-style: ;
  font-weight: bold;
  font-size: 21px;
}

#store_registration:hover{
color: red;
cursor: pointer;
}
</style>
</html>