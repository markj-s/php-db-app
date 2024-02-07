<?php

/**
 * Configuration for database connection
 *
 */

$host       = "host";
$username   = "admin";
$password   = "testTesT91827364";
$dbname     = "test";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
