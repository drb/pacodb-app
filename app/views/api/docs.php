
<h2 class="tk-gesta title">API methods</h2>
<p class="wrapper">These API methods are all available for site admins with API access turned on (this is off by default).</p>

<?
if (isset($classes))
{
	// print out the table of contents
	foreach($classes as $class=>$data)
	{
		$class_name = $data['name'];
		$class_desc = $data['description'];
		$class_methods = $data['methods'];
		echo '<h2>' . $class_name . '</h2>';
		echo '<p>' . $class_desc . '</p>';
		echo '<ul>';
		foreach($class_methods as $method)
		{
			echo '<li><a href="#' . $class_name . '-' . $method['name'] . '">' . ucwords($method['name']) . '</a></li>';
		}
		echo '</ul>';

	}

	// detailed description of each method
	foreach($classes as $class=>$data)
	{
		$class_name = $data['name'];
		$class_methods = $data['methods'];

		foreach($class_methods as $method)
		{
			$method_name = $method['name'];
			$method_desc = $method['description'];
			$method_params = $method['params'];

			$param_list = '';;
			foreach($method_params as $param)
			{
				$param_list .= '<li>(' . strtolower($param['type']) . ') ' . $param['name'] . ' - ' . $param['description'] . '</li>';
			}

			echo '<hr/>';

			// anchor
			echo '<a name="' . $class_name . '-' . $method['name'] . '"></a>' . "\n";

			echo '<h3>' . ucwords($class_name) . ' - ' . $method['name'] . '</h3>';
			echo '<p>' . $method_desc . '</p>';

			echo '<table width="100%">';
			echo '<tr>';
			echo '<td width="50%">Method</td><td>' . $class_name . '.' . $method_name . '</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td width="50%">Parameters</td><td><ul>' . $param_list . '</ul></td>';
			echo '</tr>';
			echo '</table>';

		}
	}
}
?>