<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="outerdiv">
        <div class="innerdiv">
            <li><a href="#">#</a></li>
            <li><a href="#">#</a></li>
            <li><a href="#">#</a></li>
            <li><a href="#">#</a></li>
            <li><a href="#">#</a></li>
        </div>
    </div>
</body>
<style>
    *{
        padding: 0;
        margin: 0;
    }
.outerdiv{
    display: flex;
    width: 15vw;
    height: 100vh;
    background-color: rgb(42, 85, 229);
}

.innerdiv{
    width: 15vw;
    height: 100vh;
}
a{
    text-decoration: none;
}

li{
    list-style: none;

}
</style>
</html>