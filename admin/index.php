<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ee032ea639.js" crossorigin="anonymous"></script>

    <title>Login</title>
</head>

<style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans:400,600,700');

html{
    height: 100%;
}
body {
    background: #282828;
    background-repeat: no-repeat;
    background-size: cover;
/* fallback for old browsers */
    margin: 0;
    font-family: 'Open Sans', sans-serif;
    font-size: 14px;
    height: 100vh;
}
a{
    color: #3c3b4d;
}
a:hover{
    text-decoration: none;
}
.form {
    max-width: calc(100vw - 40px);
    width: 420px;
    height: auto;
    background: rgba(255, 255, 255, 1);
    padding: 30px;
    box-sizing: border-box;
    position: relative;
    background-size: cover;
    background-repeat: no-repeat;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}
.form:before{
    content: "";
    background-color: rgba(255, 255, 255, 0.9);
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 0;
}
.form h2 {
    margin: 0;
    padding-bottom: 10px;
    color: #faa200;
    font-size: 22px;
    border-bottom: 3px solid #faa200;
    font-weight: 600;
    margin-bottom: 40px;
    text-align: center;
}
label{
    text-transform: uppercase;
    font-weight: 700;
}
input {
    width: 60%;
    padding: 10px;
    box-sizing: border-box;
    background: none;
    outline: none;
    resize: none;
    border: 0;
    font-family: 'Montserrat', sans-serif;
    border-bottom: 2px solid #faa200;
}
.form p:before {
    content: attr(type);
    display: block;
    margin: 10px 0 0;
    font-size: 13px;
    color: #faa200;
    float: left;
    width: 40%;
}
button {
    padding: 8px 12px;
    margin: 4px 0;
    font-family: 'Montserrat', sans-serif;
    border: 2px solid #78788c;
    background: #1e439b;
    color: #5a5a6e;
    cursor: pointer;
    transition: all .3s;
}
button:hover {
    background: #646171;
    color: #fff;
    border-color: #646171;
    box-shadow: 0px 0 5px 0 #646171;
}
.login-btn{margin-top: 50px;}

.relative{
    position: relative;
}
.relative i.fa{
    position: absolute;
    top: 10px;
    left: 0;
    width: 30px;
    color: #9b9aa3;
    text-align: center;
    border-radius: 0 4px 4px 0;
    transition: all 0.15s ease-in-out;
}
input:focus + .fa{
    color: #3e3b4e;
    transform: rotate(360deg);
}
.form-group{
    margin-bottom: 20px;
}
.form-control{
    font-size: 14px;
    padding-left: 40px;
    border: none;
    border-bottom: 1px solid #3c3b4d;
    border-radius: 0;
    background-color: transparent;
}
.form-control:focus{
    border-color: #1e439b;
    box-shadow: inset 0 0px 0px rgba(0,0,0,.075), 0 3px 4px -3px rgb(30, 102, 195);
    background-color: transparent;
}
.sign-up{
    margin-top: 30px;
    text-align: center;
    position: relative;
    margin-bottom: -15px;
}
.login-text{
    position: absolute;
    top: -11px;
    text-align: center;
    width: 30%;
    background-color: #fff;
    left: 50%;
    transform: translateX(-50%);
}
hr{
    margin-top: 1.25rem;
    margin-bottom: 1.25rem;
    border-top: 1px solid rgba(0, 0, 0, 0.4);
}
/* --- Animated Buttons --- */
.movebtn{
    background-color: #faa200;
    display:inline-block;
    width:100%;
    background-image: none;
    padding: 8px 10px;
    border-radius: 0;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
    transition: all 0.5s;
    -webkit-transition-timing-function: cubic-bezier(0.5, 1.65, 0.37, 0.66);
    transition-timing-function: cubic-bezier(0.5, 1.65, 0.37, 0.66);
}
.movebtnre {
    border: 2px solid #ff5501;
    box-shadow: inset 0 0 0 0 #ff5501;
    color:#ff5501;
}
.movebtnsu {
    /* border: 2px solid #3e3b4e; */
    color: #ffffff;
    background-color: #faa200;
}


.checkbox-wrapper-2 .ikxBAC {
    appearance: none;
    background-color: #dfe1e4;
    border-radius: 72px;
    border-style: none;
    flex-shrink: 0;
    height: 20px;
    margin: 0;
    position: relative;
    width: 30px;
    top: .4rem;
  }

  .checkbox-wrapper-2 .ikxBAC::before {
    bottom: -6px;
    content: "";
    left: -6px;
    position: absolute;
    right: -6px;
    top: -6px;
  }

  .checkbox-wrapper-2 .ikxBAC,
  .checkbox-wrapper-2 .ikxBAC::after {
    transition: all 100ms ease-out;
  }

  .checkbox-wrapper-2 .ikxBAC::after {
    background-color: #fff;
    border-radius: 50%;
    content: "";
    height: 14px;
    left: 3px;
    position: absolute;
    top: 3px;
    width: 14px;
  }

  .checkbox-wrapper-2 input[type=checkbox] {
    cursor: default;
  }

  .checkbox-wrapper-2 .ikxBAC:hover {
    background-color: #c9cbcd;
    transition-duration: 0s;
  }

  .checkbox-wrapper-2 .ikxBAC:checked {
    background-color: #6e79d6;
  }

  .checkbox-wrapper-2 .ikxBAC:checked::after {
    background-color: #fff;
    left: 13px;
  }

  .checkbox-wrapper-2 :focus:not(.focus-visible) {
    outline: 0;
  }

  .checkbox-wrapper-2 .ikxBAC:checked:hover {
    background-color: #535db3;
  }
    </style>
<body class="bg-secondary">
    <div class="container" style="box-shadow: 0 0 50px #343333; border-radius: 0 0 10px 10px;">
        <!-- <div class="row">
            <p class="text-center fw-bold text-warning fs-5">Login: </p>
        </div> -->
        <form action="login1.php" method="post" class="form-horizontal signin">
    

    <div class="form"  action="login1.php" method="post">
        <form class="form-horizontal signin">
            <div class="form-wrap" style="position: relative;">
              <h2>Login - Admin</h2>
              <div class="form-group">
                  <!-- <label for="email">Username:</label> -->
                  <div class="relative">
                      <input class="form-control" id="name" type="text" required="" autofocus="" title="" autocomplete="" placeholder="Username" name="username">
                      <i class="fa fa-user"></i>
                  </div>
              </div>
              
              <div class="form-group">
                  <!-- <label for="email">Password:</label> -->
                  <div class="relative">
                      <input class="form-control" type="password" required="" placeholder="Password" id="myinput" name="userpassword">
                      <!-- <input type="checkbox" name="" id="showhide" style="width: 10px;">
                      <span>Show Password</span> -->
                      


                      <i class="fa fa-key"></i>
                  </div>
                  <div class="checkbox-wrapper-2">
  <input type="checkbox" class="sc-gJwTLC ikxBAC" id="showhide">
  <span>Show Password</span>
</div>
              </div> 
                              
              <div class="login-btn">
                  <a href="#"><button class="movebtn movebtnsu" type="Submit">Login <i class="fa fa-fw fa-lock"></i></button></a>
                  
                  <div class="clearfix"></div>
             

            </div>
            
        </form>
    
      
    </div>













 



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        
$("#showhide").click(function(){
var pass = $("#myinput");
if (pass.attr("type") == "password") {
pass.attr("type", "text");
} else {
pass.attr("type", "password");
}
})
    </script>
</body>
</html>