<?php
	function idFromFirstOptions($html) {
		$id = '';

		do {		
			$html = substr($html, strpos($html, '<select'));
			$html = substr($html, strpos($html, '<option'));
			$html = substr($html, strpos($html, 'value='));
			$html = substr($html, strpos($html, '"') + 1);
			$option_value = substr($html, 0, strpos($html, '"'));

			$id .= $option_value . ' ';
		} while (strpos($html, '<select'));

		$id = trim($id);


		return $id;
	}
?>