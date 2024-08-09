<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>registration</title>
</head>

<body>
    <div class="outerdiv">
        <div class="innerdiv">

            <form action="{{route('registration')}}" method="post">
                @csrf
                <h1>REGISTER HERE</h1>
                @foreach ($errors->all() as $err)
                <li id="error">{{$err}}</li>
                @endforeach
                <input value="{{rand(0000,9999)}}" name="account_id" type="hidden">
                <label for="name">Name </label>
                <input type="text" name="name"  required><br>
                <label for="email">Email </label>
                <input type="text" name="email" required><br>
                <label for="number">Phone</label>
                <input type="text" name="number" required><br>
                <label for="password">Password</label>
                <input type="password" name="password" required><br>
                <input type="submit" name="submit" id="btn" value="Register">
            </form>
            <a href="/"><button>login</button></a>
        </div>
    </div>
</body>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.outerdiv {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100vw;
    height: 100vh;
    
    background-color: #f9fcfb;
}

.innerdiv{
    display: flex;
    padding: 54px;
    /* border: 1px solid red; */
    background-color: #f3f5d5; /* Corrected color value */
    flex-direction: column;
}

form {
    display: flex;
    flex-direction: column;
    width: 25vw;
}

label, input {
    margin-bottom: 10px;
}
#btn,button {
        width: 150px;
        height: 30px;
        margin-left: 30%;
        margin-top: 30px;
        border-radius: 3px;
    }
h1{
    padding-left: 60px;
    margin-bottom: 30px;
    margin-top: -31px;
}

#error{
    color:red;
}

#btn{
cursor: pointer;
}
button{
    cursor: pointer;
}
</style>
</html>
