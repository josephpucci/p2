<?php require 'simple_html_dom.php'; ?>

<!DOCTYPE html>
<html>
	<head>

		<title>Memorable and Secure Password Generator</title>
		<meta charset='utf-8'>
		<link href="css/p2.css" type="text/css" rel="stylesheet"/>
			
	</head>
	<body>
		<div class='wrapper'>
			<h1>Memorable and Secure Password Generator</h1>
			<h3>There is an interesting finding on the evolution of computer passwords over the last 20 years. This finding is summarized in the below xkcd Webcomic. </h3>
			<h3>Please use the form below to generate your very own memorable - and secure - password!</h3>
			<div class="password">
			<p id='password'>
	<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);


	$words = array();

	$source = file_get_html('http://www.paulnoll.com/Books/Clear-English/words-01-02-hundred.html');
	foreach($source->find ('li') as $word)
		array_push($words, $word->innertext);


		 
		$num = $_POST['number_of_words'];
		$pw = "";
		
		if($num > 0)
		for ($i=0; $i < $num; $i++) {
			$wordranindex = array_rand($words,1);
			$pw .= $words[$wordranindex];
		}
		
		if (isset($_POST['incl_number']) && $_POST['incl_number'] == 'on')
			$pw .= mt_rand(0,9);
		
		if (isset($_POST['incl_specchar']) && $_POST['incl_specchar'] == 'on')
			$specialchar = array(".","-","+","=","_","!","@","$","#","*","%","<",">","[","]","{","}");
			$charranindex = array_rand($specialchar,1);
			$pw .= $specialchar[$charranindex];
		
		echo $pw;


	 ?>
			
			
			
			</p>
			</div>
			<form method="POST" action="index.php">
				<p class='options'>
				
					<label for='number_of_words'>Total Words</label>
					<input maxlength=1 type='text' name='number_of_words' id='number_of_words' value=''> 
					<br>
						
					<input type='checkbox' name='incl_number' id='incl_number' > 
					<label for='incl_number'>Include number?</label>
					<br>
					<input type='checkbox' name='incl_specchar' id='incl_specchar' > 
					<label for='incl_specchar'>Include special character?</label>
				</p>
			
				<input type='submit' class='submitbtn' value='Generate!'>
						
			</form>
			
			<p class='info'>
				
				<br/>
				<a href='http://xkcd.com/936/' target="_blank">
					<img class='comic' src='http://imgs.xkcd.com/comics/password_strength.png' alt='xkcd style passwords'>
				</a>
				<br>
			</p>
				
		</div>
		
		
	</body>
</html>
