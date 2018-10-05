<?php

use App\Services\GoogleMapAPI;

require __DIR__ . '/../vendor/autoload.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Synergist.io Challenge</title>

	<style>
		table {
			margin-bottom: 20px;
			border: 1px solid #aaa
		}

		table th {
			text-align: left;
		}
	</style>
</head>
<body>
	<?php
	// if address sent
	if($_GET && $_GET['address']) {
		$googleMapAPI = new GoogleMapAPI();
		$addresses    = $googleMapAPI->setAddress( $_GET['address'] )->find();
		?>

		<?php if(is_array( $addresses )): ?>
			<h3>We found <?php print count( $addresses ) ?> record(s)</h3>
			<?php
			foreach($addresses as $address):
				?>
				<table>
					<tr>
						<th>Formatted Address:</th>
						<td><?php print $address->formatted_address ?></td>
					</tr>
					<?php
					foreach($address->address_components as $component):
						?>
						<tr>
							<th><?php print ucfirst( $component->types[0] ) ?>:</th>
							<td><?php print $component->long_name ?></td>
						</tr>
					<?php
					endforeach;
					?>
				</table>
			<?php
			endforeach;
			?>
			<h3>Raw data is:</h3>
			<pre><?php var_dump( $addresses ); ?></pre>
		<?php else: ?>
		<h3>We couldn't find any result</h3>
		<h5><?php print $addresses ?></h5>
		<?php endif; ?>
		<?php
	} else {
		?>
		<form action="" method="get">
			<input type='text' name='address' placeholder='Enter address here'>
			<input type='submit' value='Get'>
		</form>
	<?php } ?>
</body>
</html>
