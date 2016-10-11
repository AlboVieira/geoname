<?php
require_once "../bootstrap.php";


$geo = new \GeoNames\Manager\GeoNames();

$geo->getStatesWithCities();