<html>
<body>

<h1><?php echo $title; ?></h1>

<h3><?php echo $test; ?></h3>

<?php
foreach($result as $row)
{
	echo '<p>';
	echo htmlentities($row->getTalentnum(), ENT_QUOTES);
	echo '<br />';
	echo $row->getFname();
	echo '<br />';
	echo $row->getLname();
	echo '</p>';
}
?>

</body>
</html>
