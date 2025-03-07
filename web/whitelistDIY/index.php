<?php
   ob_start();
   session_start();
?>
<html lang = "fr">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
</head>
<body>
   <h2>Connexion</h2> 
   <?php
     // j'ai mangé le css :/
	  if(!isset($_COOKIE['admin'])) {
		setcookie('admin', '0');
	  }
      $msg = '';
      $users = ["admin"=>"b07d8ef4ae981710cced35a794d57680","babar"=>"4c80bf3b518e18d4eba83d5647537d9e"];
      $ip_whitelist = ['88.123.245.203'];
	  $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	  
	  if ($_COOKIE['admin']=='1' && in_array($ipaddress,$ip_whitelist)){
	    $msg = "Bien joué, voici le flag :<br>HIT{CaPARt&dUN3B0nN€1D}";
	  } else {
      if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
         $user=$_POST['username'];
         

          if (array_key_exists($user, $users)){
              if ( ($users[$_POST['username']]==md5($_POST['password'])) && in_array($ipaddress,$ip_whitelist) ){
                $_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                $_SESSION['username'] = $_POST['username'];
				setcookie('admin', '1');
                $msg = "Bien joué, voici le flag :<br>HIT{CaPARt&dUN3B0nN€1D}";
              }
              else {
                $msg = "Mauvais mot de passe ou IP non whitelist";
              }
          }
          else {
              $msg = "Mauvais nom d'utilisateur";
          }
        }
      }
   ?>

   <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <div>
         <label for="username">Username:</label>
         <input type="text" name="username" id="name">
      </div>
      <div>
         <label for="password">Password:</label>
         <input type="password" name="password" id="password">
      </div>
      <h4 style="color:red;"><?php echo $msg; ?></h4>
      <section>
         <button type="submit" name="login">Login</button>
      </section>
   </form>
</body>
</html>