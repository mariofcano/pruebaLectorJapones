<?php
$output = [];

$return_var = null;

exec('node -v', $output, $return_var);

echo '<pre>';

print_r($output);
echo '</pre>';
echo 'Return var: ' . $return_var;
?>
