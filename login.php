<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IOT HW4</title>
    <link rel="stylesheet" href="css/login.css">
    <!-- JQuery -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
    <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
    <script>

    </script>
    <?php
      session_start();
      if($_SESSION['username'] != null)
        header("Location: /index.php?add='大坑情人橋'&username='7105029033'");
    ?>
</head>
<body>
    <hgroup>
        <h1>物聯網應用與資料分析</h1>
    </hgroup>
    <form action="">
        <div class="group">
            <input id="username" type="text"><span class="highlight"></span><span class="bar"></span>
            <label>username</label>
        </div>
        <div class="group">
            <input id="password" type="text"><span class="highlight"></span><span class="bar"></span>
            <label>password</label>
        </div>
        <button type="button" onclick="login()" class="button buttonBlue">Login
          <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
        </button>
    </form>
    <footer>
        <h2>測試帳號/密碼：Test</h2>
    </footer>
</body>
<script>

  function login(){
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    // if(username.value == 'Test' && password.value == 'Test')
    // {
    //   location.href="./index.html";
    //   // location.replace("./gmap2016.html");
    // }
    $.ajax({
      type: 'POST',
      url: 'user.php',
      data: {
        username : username,
        password : password
      },
      success: success,
      dataType: 'json'
    });
  }

  function success(data){
    console.log(data)
    if (data === null){
        alert("帳號或密碼錯誤！")
    }else{
        var user = data[0];
        localStorage.setItem("username",user["username"]);
    }
    checkLoginState()
  }

  function checkLoginState(){
    var user = localStorage.getItem("username");
    if (user === null){
      console.log("not login")
    }else{
      console.log(user)
      window.location.href = "index.html";
    }
  }
</script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</html>
