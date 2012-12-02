<html>
<body>

<h1><?php echo $this->title; ?></h1>

<h3><?php echo $this->test; ?></h3>

<?php
foreach($this->result as $row)
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

<div style="border:1px solid black; width:450px;height:100px;">
<?php echo $this->w1->render('w1'); ?>
</p>

</body>
</html>
