#!/usr/bin/env php
<?php

require_once('lib/ExecutionUnit/autoload.php');

$repoBasePath = 'exampleRepo';
$mainPath = realpath(dirname(__FILE__));

$repoPath =  $mainPath.DIRECTORY_SEPARATOR.$repoBasePath;

$version = new ExecutionUnit\Processing\Version($repoPath);

$list = $version->getVersionList();

echo " Version list: \n\r";

var_export($list);

$firstVersion = '0.0.1';
$lastVersion = '0.5.0';

$diffVersion = $version->getDiff($firstVersion, $lastVersion);

echo "\n\r Parametrs Diff version: ", $firstVersion, "->", $lastVersion, "\n\r";
var_export($diffVersion);

$lastVersion = $version->getDiff();

echo "\n\r Full Diff version: \n\r";
var_export($lastVersion);

echo "\n\r";
