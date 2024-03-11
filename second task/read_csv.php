<?php
if ($_FILES['csvFile']['size'] > 0) {
	$fileName = $_FILES['csvFile']['name'];
	$fileTmpName = $_FILES['csvFile']['tmp_name'];

	$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
	if ($fileType != 'csv') {
		echo 'Выбранный файл не является CSV файлом!';
	} else {
		$csvData = file_get_contents($fileTmpName);
		$lines = explode("\n", $csvData);
		echo '<div class="table-responsive">';
		echo '<table class="table table-striped table-bordered">';
		foreach ($lines as $line) {
			if (!empty(trim($line))) {
				echo '<tr>';
				$data = explode(";", $line);
				foreach ($data as $value) {
					echo "<td>$value</td>";
				}
				echo '</tr>';
			}
		}
		echo '</table>';
		echo '</div>';
	}
}

