<?php namespace User\View;

use mvcs\View\ViewModel;

class ViewHelper extends ViewModel
{
	public static function showAssociations($view)
	{
		//the following is a way to show all of the associations in a dynamic fashion
		foreach($view->result as $row)
		{
			if(is_object($row))
			{
				echo '<table>';
				foreach(new \ArrayIterator((array)$row) as $key=>$val)
				{
					if(!is_object($val))
					{
						echo '<tr>';
						echo '<td valign="top">'.str_replace('*', '', $key).'</td>';
						echo '<td class="value">';
						if(is_array($val))
						{
							echo '<ul>';
							foreach($val as $k=>$v)
							{
								if(is_object($v))
								{
									foreach($v->getProperties($v) as $keys)
									{
										echo '<li>';
										echo $keys.': ';
										echo $view->escape($v->$keys);
										echo '</li>';
									}
								}
							}
							echo '</ul>';
						}
						elseif(null != $val)
						{
							echo $view->escape($val);
						}
						else
						{
							echo 'NULL';
						}
						echo '</td>';
						echo '</tr>';
					}
				}
				echo '</table>';
			}
		}
	}
}

