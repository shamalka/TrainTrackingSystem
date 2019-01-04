<?php

$conn = mysqli_connect("localhost", "root", "", "train");

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}
