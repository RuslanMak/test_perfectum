<?php

echo "<a href='../'>home</a>" . '<br>';

foreach($courses as $course) {
	$course = (array)$course;
	echo $course['ccy'] . ': ' . $course['buy'] . '/' . $course['sale'] . ' - ' . $course['date'] . '<br>';
}
