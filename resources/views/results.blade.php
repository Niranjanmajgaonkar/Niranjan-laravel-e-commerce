<div class="resultouter">
<div class="resultinner">

    @if (session('success'))
    <div class="alert-success">
        <marquee behavior="flow"  scrollamount=14 direction="left">{{ session('success') }}</marquee>

    </div>
    <div class="resut_btn">
        <a href="/home"><button>Continue Shopping</button></a>
    </div>
    @endif
    
    @if (session('error'))
    <div class="alert-success">
        {{ session('error') }}
    </div>
    <div class="resut_btn">
        <a href="/home"><button>Continue Shopping</button></a>
    </div>
    @endif

</div>
    
</div>
    
    <style>
    html{
        background-color:yellow; 

    }

    .resultouter{
display: flex;
justify-content: center;
align-items: center;
height: 100vh;
width: 100vw;
font-weight: 900;
font-size: 31px;


}
    .resultinner{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .alert-success{
        border-top: 2px solid black;
    border-right: 2px solid black;
    padding-right: 8px;
    }

    .resut_btn button{
        padding-left: 27px;
    margin-top: 20px;
    font-size: 22px;
    padding-top: 5px;
    padding-right: 27px;
    padding-bottom: 10px;
    background-color: rgb(42, 85, 229);
    color: white;
    margin-bottom: 1vh;
list-style: none;
text-decoration: none;
    border-radius: 8px;
    }

    .resut_btn button:hover{
        cursor: pointer;
        background-color:red; 
    }
</style>