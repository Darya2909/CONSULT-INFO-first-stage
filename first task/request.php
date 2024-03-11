<?php

$name = $_POST['name'];
$email = $_POST['email'];
$text = $_POST['text'];

$allowedFormats = array('png', 'jpg');
$uploadDir = 'C:/OSPanel/domains/' . time();
$uploadFile = $uploadDir . basename($_FILES['fileInput']['name']);
$extension = pathinfo($_FILES['fileInput']['name'], PATHINFO_EXTENSION);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	echo "Неправильный email<br>";
}
elseif($_FILES['fileInput']['size'] === 0){
	$data = "Name: $name\nEmail: $email\nText: $text\n";
	$textFilePath = "$uploadDir" . "$email.txt";
	file_put_contents($textFilePath, $data, FILE_APPEND | LOCK_EX);
	echo "<p>Данные успешно получены: $name, $email</p><br>";
	exit();
}


if ($_FILES['fileInput']['size'] > 0 && !in_array($extension, $allowedFormats)){
	echo "Неверный формат файла. Разрешённые форматы: .jpg, .png<br>";

}
elseif($_FILES['fileInput']['size'] > 0 && !move_uploaded_file($_FILES['fileInput']['tmp_name'], $uploadFile)){
	echo "Ошибка при загрузке файла<br>";
}
elseif(filter_var($email, FILTER_VALIDATE_EMAIL)){
	$data = "Name: $name\nEmail: $email\nText: $text\nFile Path:$uploadFile";
	$textFilePath = "$uploadDir" . "$email.txt";
	file_put_contents($textFilePath, $data, FILE_APPEND | LOCK_EX);
	echo "Данные успешно получены: $name, $email<br>";
}
