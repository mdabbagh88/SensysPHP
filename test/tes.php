<?php

include ("library/sentiment.class.php");
include ("configuration/connect.php");
$no = 1;

$sentiment = new Sentiment();

$sql = "select content from datastore";

$query = mysql_query($sql);

while($row = mysql_fetch_array($query))
{
            echo "<h2>Example $no</h2>";
            echo "<blackquote>$row[content]</blockquote>";
            echo "Scores: <br>";
            $scores = $sentiment->score($row['content']);
            echo "<ul>";
            foreach($scores as $class => $score){
                if($class == $sentiment -> categorise($key)){
                    $string = "<b class=\"$class\">$string</b>";
                }
                echo "<ol>$string</ol>";
            }
            mysql_query("update datastore set class='$class' where content='$row[content]'");
            echo "</ul>";
            echo "<hr>";
            $no++;
            flush();
}
?>;