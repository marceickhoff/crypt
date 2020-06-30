<?php
define('CRYPT_METHOD', 'AES-256-CBC');

function encrypt($string, $key, $iv) {
	$key = hash('sha256', $key);
	$iv = substr(hash('sha256', $iv), 0, 16);
	$output = openssl_encrypt($string, CRYPT_METHOD, $key, 0, $iv);
	$output = base64_encode($output);
	return $output;
}

function decrypt($string, $key, $iv) {
	$key = hash('sha256', $key);
	$iv = substr(hash('sha256', $iv), 0, 16);
	$output = openssl_decrypt(base64_decode($string), CRYPT_METHOD, $key, 0, $iv);
	return $output;
}

function generateRandomString($length) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

$result = '';
$result_copy = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['encrypt'])) {
		$result = encrypt($_POST['text'], $_POST['key'], $_POST['iv']);
		$result_copy = 'ENCSTR: '.$result."\nIV:     ".$_POST['iv'];
	}
	elseif (isset($_POST['decrypt'])) {
		$result = decrypt($_POST['text'], $_POST['key'], $_POST['iv']);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Crypt</title>
	<style type="text/css">
		* {
			box-sizing: border-box;
		}

		body {
			margin: 0;
			padding: 0;
			font-family: Inconsolata, monospace;
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			font-size: 1rem;
		}

		.content {
			top: 50%;
			left: 50%;
			transform: translateX(-50%) translateY(-50%);
			position: relative;
			text-align: center;
			width: 50%;
		}

		input[type=text], input[type=password], textarea {
			width: 100%;
			text-align: center;
			font: inherit;
			resize: vertical;
		}

		input[type=submit] {
			font: inherit;
			width: 50%;
			border: none;
			display: block;
			float: left;
			color: white;
			cursor: pointer;
		}

		.button-encrypt {
			background-color: darkred;
		}

		.button-encrypt:hover {
			background-color: red;
		}

		.button-decrypt {
			background-color: darkgreen;
		}

		.button-decrypt:hover {
			background-color: green;
		}

		label {
			margin-top: 30px;
			font-weight: bold;
			display: block;
		}

		input, textarea {
			padding: 10px 5px;
			margin: 10px 0;
			font-weight: normal !important;
		}
	</style>
</head>
<body>
<div class="content">
	<form method="post">
		<label>Text<br><input type="text" name="text" placeholder="Text"></label>Random String: <?=generateRandomString(16)?><br>
		<label>Key<br><input type="password" name="key" placeholder="Key"></label><br>
			<label>Initialization Vector<br><input type="text" name="iv" placeholder="IV" value="<?=generateRandomString(32)?>"></label><br>
		<input class="button-encrypt" type="submit" name="encrypt" value="Encrypt"><input class="button-decrypt" type="submit" name="decrypt" value="Decrypt">
	</form>
	<label>Result<br><input class="result" type="text" value="<?= $result ?>" placeholder="Result"></label>
	<label>Result to copy<br><textarea class="result"><?= $result_copy ?></textarea></label>
</div>
</body>
</html>
