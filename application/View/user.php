<html>

<head>

<?php echo $this->jsFiles; ?>

<?php echo $this->cssFiles; ?>

</head>

<body>

<h1><?php echo $this->escape($this->title); ?></h1>

<h3><?php echo $this->escape($this->test); ?></h3>

<?php
foreach($this->result as $row)
{
	echo '<p>';
	echo $this->escape($row->getTalentnum());
	echo '<br />';
	echo $this->escape($row->getFname());
	echo '<br />';
	echo $this->escape($row->getLname());
	echo '</p>';
}
?>

<div class="widget" id="w1">
<?php echo $this->w1->render('w1'); ?>
</div>

</body>
</html>
