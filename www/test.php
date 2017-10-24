<?php

	$feedback = '';
	
	if (isset($_POST['submit'])) {
		
		$forma = $_POST['forma'];
		$EmriFemijes = $_POST['emriFemijes'];
		$EmriLodres = $_POST['emriLodres'];
		$Email = $_POST['email'];
		$Adresa = $_POST['adresa'];
		$Telefoni = $_POST['nrTelefonit'];

		require 'PHPMailer/PHPMailerAutoload.php';
		include('PHPMailer/class.phpmailer.php');

		if($forma == "Bëje vet")
		{
			$kategoria = $_POST['Kategoria'];
			$Radio = $_POST['radio'];
			$Message = $_POST['message'];
			$dimensionet = $_POST['Dimensionet'];
	
	
			$mail = new PHPMailer;
			$mail->isSMTP();                                   // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                            // Enable SMTP authentication
			$mail->Username = 'florimi772@gmail.com';       // SMTP username
			$mail->Password = 'Florimi14100'; // SMTP password
			$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                 // TCP port to connect to
	
	
			$mail->setFrom($Email, 'Porosit loder');
			$mail->addReplyTo($Email, 'From');
			$mail->addAddress('florim14hamiti@gmail.com');          //$email);   // Add a recipient
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');
	
			$mail->isHTML(true);  // Set email format to HTML
	
			$bodyContent = 'Lloji i porosisë: '.$forma.'<br>Emri i femijës: '.$EmriFemijes.'<br>Emri i lodrës: '.$EmriLodres;
			$bodyContent .='<br>Lloji i lodrës: '.$kategoria.'<br>Paraqitet në galerinë tonë: '.$Radio.'<br>Dimensionet: '.$dimensionet;
			$bodyContent .='<br>Adresa: '.$Adresa.'<br>Numri i telefonit: '.$Telefoni.'<br><br>Mesazhi: '.$Message;
	
			$mail->Subject = "Pososit nje loder!";
			$mail->Body = $bodyContent;
	
			$uploadOk = 1;
			$imageFileType = pathinfo($_FILES["uploadFoto"]["name"],PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["uploadFoto"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$uploadOk = 0;
				}
			}
	
			// Check file size
			if ($_FILES["uploadFoto"]["size"] > 500000) {
				$feedback = "Sorry, your file is too large.";
				$uploadOk = 0;
			}
	
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				$feedback = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
	
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$feedback = "Sorry, your file was not uploaded.";
			} else {
				$mail->AddAttachment( $_FILES['uploadFoto']['tmp_name'], $_FILES['uploadFoto']['name'] );
				if(!$mail->send()) {
					$feedback = "E-mail nuk eshte derguar!";
				} else {
					$feedback = "E-mail eshte derguar, do ju pergjigjemi se shpejti";
				}
			}
		}
		else if($forma == "Gjysmë të gatshme")
		{
			$mail = new PHPMailer;
			$mail->isSMTP();                                   // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                            // Enable SMTP authentication
			$mail->Username = 'florimi772@gmail.com';       // SMTP username
			$mail->Password = 'Florimi14100'; // SMTP password
			$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                 // TCP port to connect to
	
	
			$mail->setFrom($Email, 'Porosit loder');
			$mail->addReplyTo($Email, 'From');
			$mail->addAddress('florim14hamiti@gmail.com');          //$email);   // Add a recipient
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');
	
			$mail->isHTML(true);  // Set email format to HTML
	
			$bodyContent = 'Lloji i porosisë: '.$forma.'<br>Emri i femijës: '.$EmriFemijes.'<br>Emri i lodrës: '.$EmriLodres;
			$bodyContent .='<br>Adresa: '.$Adresa.'<br>Numri i telefonit: '.$Telefoni;
	
			$mail->Subject = "Pososit nje loder!";
			$mail->Body = $bodyContent;
	
			$uploadOk = 1;
			$imageFileType = pathinfo($_FILES["uploadFoto"]["name"],PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["uploadFoto"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$uploadOk = 0;
				}
			}
	
			// Check file size
			if ($_FILES["uploadFoto"]["size"] > 500000) {
				$feedback = "Sorry, your file is too large.";
				$uploadOk = 0;
			}
	
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				$feedback = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
	
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$feedback = "Më fal, foto-ja juaj nuk është ngarkuar.";
			} else {
				$mail->AddAttachment( $_FILES['uploadFoto']['tmp_name'], $_FILES['uploadFoto']['name'] );
				if(!$mail->send()) {
					$feedback = "E-mail nuk eshte derguar!";
				} else {
					$feedback = "E-mail eshte derguar, do ju pergjigjemi se shpejti";
				}
			}
		}
    }
?>