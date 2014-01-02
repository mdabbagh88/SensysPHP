<?php

include 'sentiment.class.php';

$sentiment = new Sentiment();

$examples = array(
	1 => 'Weather today is rubbish',
	2 => 'This cake looks amazing',
	3 => 'His skills are mediocre',
	4 => 'He is very talented',
	5 => 'She is seemingly very agressive',
	6 => 'Marie was enthusiastic about the upcoming trip. Her brother was also passionate about her leaving - he would finally have the house for himself.',
	7 => 'To be or not to be?',
    8 => 'What The Hell !',
    9 => 'Bitch',
);

		foreach ($examples as $key => $value) {

			echo '<div class="example">';
			echo "<h2>Example $key</h2>";
			echo "<blockquote>$value</blockquote>";
			echo "Scores: <br />";
			$scores = $sentiment->score($value);

			echo "<ul>";
			foreach ($scores as $class => $score) {
				$string = "$class -- <i>$score</i>";
				if ($class == $sentiment->categorise($value)) {
					$string = "<b class=\"$class\">$string</b>";
				}
				echo "<ol>$string</ol>";
			}
			echo "</ul>";
			echo '</div>';
		}
		
		echo "Process Completed";
?>