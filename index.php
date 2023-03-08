<?php 
  require_once('connection.php');

  $name = '';
  $email = '';
  $message = '';
  $error = '';
  $message = '';
  
  if(count($_POST)) {
    
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
    
    if(!$email) {
      $error .= "Email cannot be left blank.";
    } elseif(!strpos($email, '@') || !strpos($email, '.')) {
      $error .= "Enter a valid email.";
    }

    if(!$error) {
      $sql = "INSERT INTO `db-contactus`.`tbl_contactus` (`name`, `email`, `message`) VALUES (?, ?, ?); ";

      $stmt = $conn->prepare($sql);

      //bind the parameter value
      $stmt->bind_param('sss', $name, $email, $message);

      // Execute the query
      if($stmt->execute()) {
        $message = "Your contact us query received successfully. We will reply ASAP.";
        $name = '';
        $email = '';
        $error = '';
      } else {
        $message = "An error occured. Please try again. ".$stmt->error;
      }
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP MySQL Contact Us Form</title>
    
</head>
<body>
    <!-- Container for demo purpose -->
<div class="container my-24 px-6 mx-auto">
    <!-- Section: Design Block -->
    <section class="mb-32 text-gray-800">
       <div class="flex flex-wrap">
        <div class="grow-0 shrink-0 basis-auto mb-6 md:mb-0 w-full md:w-6/12 px-3 lg:px-6">
          <h2 class="text-3xl font-bold mb-6">Contact us</h2>
          <p class="text-gray-500 mb-6">
            Send us a contact query. We will respond as soon as possible.
          </p>
          <p>
            Create a contact us form using PHP MySQL using MySQLi extension.
          </p>
          <p class="text-gray-500 mb-2">Programmer Blog</p>
          <p class="text-gray-500 mb-2"><a style="color: #00F;" href="http://programmerblog.net">http://programmerblog.net</a></p>
          <p class="text-gray-500 mb-2">info@xyz-example.com</p>
        </div>
        <div class="grow-0 shrink-0 basis-auto mb-12 md:mb-0 w-full md:w-6/12 px-3 lg:px-6">
          <?php if($error) { ?>
            <div role="alert" class="mb-3">
              <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                Error!
              </div>
              <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                <p><?=$error; ?></p>
              </div>
          </div>
          <?php } elseif($message) { ?>
              <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3 mb-3" role="alert">
              <p class="font-bold">Thank you</p>
              <p class="text-sm"><?=$message; ?></p>
            </div>
          <?php } ?>
          <div>
            <form name="form1" method="post">
              <div class="form-group mb-6">
                <input type="text" class="form-control block
                  w-full
                  px-3
                  py-1.5
                  text-base
                  font-normal
                  text-gray-700
                  bg-white bg-clip-padding
                  border border-solid border-gray-300
                  rounded
                  transition
                  ease-in-out
                  m-0
                  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="name" id="name"
                  placeholder="Name" value="<?=$name ?>">
              </div>
              <div class="form-group mb-6">
                <input type="email" name="email" class="form-control block
                  w-full
                  px-3
                  py-1.5
                  text-base
                  font-normal
                  text-gray-700
                  bg-white bg-clip-padding
                  border border-solid border-gray-300
                  rounded
                  transition
                  ease-in-out
                  m-0
                  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="email"
                  placeholder="Email address" value="<?=$email ?>">
              </div>
              <div class="form-group mb-6">
                <textarea class="
                  form-control
                  block
                  w-full
                  px-3
                  py-1.5
                  text-base
                  font-normal
                  text-gray-700
                  bg-white bg-clip-padding
                  border border-solid border-gray-300
                  rounded
                  transition
                  ease-in-out
                  m-0
                  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                " id="message" rows="3" name="message" placeholder="Message"><?=$message; ?></textarea>
              </div>
              <button type="submit" class="
                w-full
                px-6
                py-2.5
                bg-blue-600
                text-white
                font-medium
                text-xs
                leading-tight
                uppercase
                rounded
                shadow-md
                hover:bg-blue-700 hover:shadow-lg
                focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                active:bg-blue-800 active:shadow-lg
                transition
                duration-150
                ease-in-out">Send</button>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- Section: Design Block -->
  
  </div>
  <!-- Container for demo purpose -->
  <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
