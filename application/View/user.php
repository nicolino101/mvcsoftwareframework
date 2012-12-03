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
	echo $this->escape($row->getUserid());
	echo '<br />';
	echo $this->escape($row->getFirstname()).' '.$this->escape($row->getLastname());
	echo '<br />';
	echo $this->escape($row->getCreated());
	echo '</p>';
}
?>

<div class="widget" id="w1">
<?php echo $this->w1->render('w1'); ?>
</div>

</body>
</html>
