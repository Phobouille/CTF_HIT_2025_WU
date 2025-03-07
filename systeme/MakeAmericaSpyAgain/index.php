<?php ini_set('display_errors', 0); ?>
<html lang = "fr">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Intel Active Management Technology</title>
</head>
<body>
	<h2>Connexion</h2> 
	<?php
		$realm = 'Digest:048A0000000000000000000000000000';

		//I hate CSS
		$users = array('admin' => 'Ak59DDdjdf45$$$54$Alkd1!$a156p9o9qQSp!');


		if (empty($_SERVER['PHP_AUTH_DIGEST'])) {
			header('HTTP/1.1 401 Unauthorized');
			header('WWW-Authenticate: Digest realm="'.$realm.
				   '",qop="auth",nonce="'.uniqid().'",opaque="'.md5($realm).'"');

			die('Text to send if user hits Cancel button');
		}


		// analyze the PHP_AUTH_DIGEST variable
		if (!($data = http_digest_parse($_SERVER['PHP_AUTH_DIGEST'])) ||
			!isset($users[$data['username']]))
			die('Wrong Credentials!');


		// generate the valid response
		$A1 = md5($data['username'] . ':' . $realm . ':' . $users[$data['username']]);
		$A2 = md5($_SERVER['REQUEST_METHOD'].':'.$data['uri']);
		$valid_response = md5($A1.':'.$data['nonce'].':'.$data['nc'].':'.$data['cnonce'].':'.$data['qop'].':'.$A2);

		if (strncmp($valid_response, $data['response'], strlen($data['response'])) === 0) {
			echo 'Welcome to the Intel AMT admin panel.<br>Your are logged in as: ' . $data['username'];
			echo '<p>A little explaination : </p>';
			echo '<p>First of all, you should remember that Intel AMT provides the ability to remotely control the computer
				system even if it’s powered off (but connected to the electricity mains and network).</p>';
			echo '<p>Also, Intel AMT is completely independent of OS installed on the computer system. In fact, this
				technology allows to remotely delete or reinstall it.</p>';
			echo '<p>These are based on the following Intel AMT features:<br>-KVM (remote control of mouse keyboard and monitor), you can use this capability to remotely
perform any common physical actions (with mouse, keyboard) you do locally and usually when
you working with your PC. Which means, you can remotely load, execute any program to the target
system, read/write any file (using the common file explorer) etc.<br>-IDE-R (IDE Redirection), you can remotely change the boot device to some other virtual image for
example (so the system won’t boot your usual Operating System from your hard drive, but will boot
the image(virtual disk) from the source specified remotely)<br>-SOL (Serial over LAN), you can remotely power on/power off/reboot/reset and do other actions
with this feature. Also, it can be used to access BIOS setup for editing</p>';
			echo '<p>You managed to penetrate the system because of this beginner mistake : <br>if(strncmp(computed_response, user_response, response_length))</p>';
			echo '<p><br>Well done, you can use this flag : HIT{AB3g1nn€rM1stake}</p>';

		} else {
			die('Wrong Credentials!');
		}


		// function to parse the http auth header
		function http_digest_parse($txt)
		{
			// protect against missing data
			$needed_parts = array('nonce'=>0, 'nc'=>0, 'cnonce'=>0, 'qop'=>0, 'username'=>0, 'uri'=>0, 'response'=>0);
			$data = array();
			$keys = implode('|', array_keys($needed_parts));

			preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]*?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);
			
			foreach ($matches as $m) {
				$data[$m[1]] = $m[3] ? $m[3] : $m[4];
				unset($needed_parts[$m[1]]);
			}

			return $needed_parts ? false : $data;
		}
	?>
</body>
</html>