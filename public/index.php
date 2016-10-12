
<?php
require_once "../bootstrap.php";


$geo = new \GeoNames\Manager\GeoNames();

$data = $geo->getStatesWithCities();
$geo->toJson($data);