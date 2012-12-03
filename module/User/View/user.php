<div class="leftside">

<h1><?php echo $this->title; ?></h1>

<h3><?php echo $this->userid; ?></h3>

<?php
foreach($this->result as $row)
{
	if(is_object($row))
	{  
		echo '<table>';
		foreach(new ArrayIterator((array)$row) as $key=>$val)
		{
			if(!is_object($val))
			{
				echo '<tr>';
				echo '<td>'.str_replace('*', '', $key).'</td>';
				echo '<td class="value">'.$this->escape($val).'</td>';
	            echo '</td>';
	            echo '</tr>';
			}
		}
		echo '</table>';
	}
}
?>

</div>
