<div class="forget_pass_outer">
    <div class="forget_pass_inner">
        <h1>forget Password Window</h1>

        @if(session('forget_error'))
        <li style="color: red">{{ session('forget_error') }}</li><br>
        @endif
    
        @foreach ($errors->all() as $item)
        <li style="color: red">{{ $item}}</li><br>
        @endforeach
        <form action="{{route('store_forget_password')}}" method="post">
            @csrf
            <label for="email">Email</label>
            <input type="email" name="email" required><br><br>
            
            <label for="mobile">Mobile</label>
            <input type="text" name="mobile" required><br><br>
            
            <label for="password">Enter New Password</label>
            <input type="password" name="password" required><br><br>
            
            <label for="password_confirmation">Enter Confirm New Password</label>
            <input type="password" name="password_confirmation" required><br><br>
            
            

            <input type="submit"value="Forget" name="submit"><br><br>
        </form>
    </div>
</div>

<style>
    .forget_pass_outer{
        display: flex;
    justify-content: center;
    align-items: center;
    width: 100vw;
    /* border: dashed; */
    height: 100vh;
    }
    .forget_pass_inner input{
        border-radius: 13px;
        border-radius: 13px;
    padding-left: 10px;
    margin-left: 32px;
    }
    .forget_pass_inner input[name="submit"]{
        color: red;
    font-size: 14px;
    padding: 5px 100px 5px 100px;

    margin-left:4.5vw; 
    margin-top:2vh; 
    }
    .forget_pass_inner h1{
        display: flex;
    justify-content: center;
    padding-bottom: 7px;
    }
    .forget_pass_inner{
        margin-top: -97px;
    border-top: 2px solid red;
    border: to;
    border-bottom: 2px solid red;
    }
</style>