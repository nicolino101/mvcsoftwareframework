<html>

<head>

<?php echo $this->jsFiles; ?>

<?php echo $this->cssFiles; ?>

</head>

<body>

<div class="leftside">

<h1><?php echo $this->title; ?></h1>

<h3><?php echo $this->userid; ?></h3>

<?php
// simple use: 
// $this->result[0]->getFirstname();
// $this->result[0]->getAddress()->getCity();

// this uses the view helper
\User\View\ViewHelper::showAssociations($this);
?>

</div>

</body>
</html>