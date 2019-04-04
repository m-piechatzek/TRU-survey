<?php

  if (!isset($_SERVER['HTTPS'])) {

    $url = 'https://' . $_SERVER['HTTP_HOST'] .

           $_SERVER['REQUEST_URI'];  // start with /...

    header("Location: " . $url);  // Redirect - 302

    exit;                         // should be before any output

  }                               // 

?>
<!DOCTYPE html>
<html>
<head>
    <title>TRU Survey</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
    body {
        background-image: url(om.jpg);
        background-repeat: no-repeat;
        background-size: cover;
    }
    #line {
        border-right: solid black 1px;
    }

    #signin > h2 {
        text-align: right;
    }

    .container-background {
        background-color: rgba(255, 255, 255, .8);
        margin-top: 3%;
        padding: 10px;
    }

    #logo {
        /*justify-content: center;*/
    }

/*    .backgroundimg {
        z-index: -999;
    }*/
</style>

</head>
<body>
    <div class="container container-background">
    <img src="logo.png" class="mx-auto d-block" alt="Responsive image">

        <div class="row">
        <div class="col-md-3"></div>        
           <div id='signin' class='col-md-3'>
            <h2>Sign In</h2>
            <br>
            <form method='post' action='controller.php'>
                <div class="form-group">  
                    <input type='hidden' name='page' value='StartPage'></input>
                    <input type='hidden' name='command' value='SignIn'></input>
                    <label class=''>Username</label> 
                    <input class="form-control" type='text' name='username' placeholder='Username' required></input>
                     <?php if (!empty($error_msg_username)) echo $error_msg_username; ?>
                    <br>
                    <label class=''>Password</label> 
                    <input  class="form-control" type='password' name='password' placeholder='Password' required></input>
                     <?php if (!empty($error_msg_password)) echo $error_msg_password; ?>
                    <br>
                    <button class="btn btn-primary" type='submit' value='Submit'>Login</button>
                    <button class="btn btn-secondary" type='reset' value='Reset'>Reset</button>
                    <button class="btn btn-secondary" id='cancel-signin' type='reset' value='Cancel'>Cancel</button>
                </div>
            </form>
        </div>
        <div id="line"></div>
        <div id='join' class='col-md-3'>
            <h2>Join</h2>
            <br>
            <form method='post' action='controller.php'>
                <div class="form-group">  
                    <input type='hidden' name='page' value='StartPage'></input>
                    <input type='hidden' name='command' value='Join'></input>
                    
                    <label class=''>Username</label> 
                    <input  class="form-control" type='text' name='username' placeholder='Username' required></input>
                    <?php if (!empty($error_msg_username)) echo $error_msg_username; ?>
                    <br>
                    <label class=''>Password</label> 
                    <input  class="form-control" type='password' name='password' placeholder='Password' required></input>
                    <?php if (!empty($error_msg_password)) echo $error_msg_password; ?>
                    <br>
                    <label class=''>Email</label> 
                    <input  class="form-control" type='text' name='email' placeholder='Email' required></input>
                    <?php if (!empty($error_msg_email)) echo $error_msg_email; ?>
                    <br>
                    <button class="btn btn-primary" type='submit' value='Submit'>Join</button>
                    <button class="btn btn-secondary" type='reset' value='Reset'>Reset</button>
                    <button class="btn btn-secondary" id='cancel-join' type='reset' value='Cancel'>Cancel</button>
                </div>
            </form>
            <div class="col-md-3"></div>  
        </div>
    </div>
</div>

</body>
</html>