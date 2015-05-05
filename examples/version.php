#!/usr/bin/env php
<?php

require_once('lib/ExecutionUnit/autoload.php');

$repoBasePath = 'exampleRepo';
$mainPath = realpath(dirname(__FILE__));

$repoPath =  $mainPath.DIRECTORY_SEPARATOR.$repoBasePath.DIRECTORY_SEPARATOR.'*';

$version = new ExecutionUnit\Processing\Version($repoPath);

$list = $version->getVersionList();

echo " Version list: \n\r";

var_export($list);

$diffVersion = $version->getDiff('0.0.1', '0.5.0');

echo "\n\r Parametrs Diff version: \n\r";
var_export($diffVersion);

$lastVersion = $version->getDiff();

echo "\n\r Full Diff version: \n\r";
var_export($lastVersion);

echo "\n\r";
