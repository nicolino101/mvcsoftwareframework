<div class="leftside">

<h1><?php echo $this->title; ?></h1>

<h3><?php echo $this->userid; ?></h3>

<?php
// simple use: 
// $this->result[0]->getFirstname();
// $this->result[0]->getAddress()->getCity();

\User\View\ViewHelper::showAssociations($this);
?>

</div>
