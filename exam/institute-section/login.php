<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicon -->
  <link href="../assets/images/favicon.png" rel="icon" type="image/png">
  <title>Institute | Login</title>
  <meta name="description" content="Institute Login">
  <link rel="stylesheet" href="../assets/css/uikit.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link href="http://www.unpkg.com/tailwindcss%402.2.19/dist/tailwind.min.css" rel="stylesheet">

  <style>
    body {
      margin: 0;
      padding: 0;
      justify-content: center;
      align-items: center;

    }

    input,
    .bootstrap-select.btn-group button {
      background-color: #f3f4f6 !important;
      height: 44px !important;
      box-shadow: none !important;
    }
  </style>

</head>

<body>

  <div id="wrapper" class="flex flex-col justify-center h-screen">
    <!-- Content-->
    <div>

      <div class="lg:p-12 max-w-xl lg:my-0 my-12 mx-auto p-6 space-y-">
        <form action="" method="post" id="login_form" class="lg:p-10 p-6 space-y-3 relative bg-white shadow-xl rounded-md">
          <h1 class="lg:text-2xl text-xl font-semibold mb-6">Institute Login</h1>
          <hr>

          <div id="error_box">

          </div>
          <div>
            <label class="mb-0" for="username"> Username </label>
            <input type="text" id="username" name="username" placeholder="Username" class="bg-gray-100 h-12 mt-2 px-3 rounded-md w-full" value="<?php if (isset($_COOKIE["eusername1"])) {
                                                                                                                                                  echo $_COOKIE["eusername1"];
                                                                                                                                                } ?>">
          </div>
          <div>
            <label class="mb-0" for="password"> Password </label>
            <input type="password" id="password" name="password" placeholder="******" class="bg-gray-100 h-12 mt-2 px-3 rounded-md w-full" value="<?php if (isset($_COOKIE["epass1"])) {
                                                                                                                                                    echo $_COOKIE["epass1"];
                                                                                                                                                  } ?>">
          </div>
  
          <div class="checkbox mt-8">
            <input type="checkbox" id="chekcbox1" name="rem_me" <?php if (isset($_COOKIE["eusername1"])) {
                                                    echo "checked";
                                                  } ?>>
            <label for="chekcbox1"><span class="checkbox-icon"></span>Remember me</label>
          </div>
          <div>
            <button type="submit" id="login" name="login" class="bg-blue-600 font-semibold p-2.5 mt-5 rounded-md text-center text-white w-full">
              Login</button>
          </div>
          <div class="flex items-center space-x-2 justify-center">

          </div>

        </form>

      </div>

    </div>

    <!-- Footer -->


  </div>



  <!-- Javascript
================================================== -->
 
  <script src="validate/login.js"></script>
  <?php include("js.php"); ?>


</body>



</html>