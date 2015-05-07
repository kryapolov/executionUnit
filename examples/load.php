#!/usr/bin/env php
<?php

require_once('lib/ExecutionUnit/autoload.php');

$repoBasePath = 'exampleRepo';
$mainPath = realpath(dirname(__FILE__));

$repoPath =  $mainPath.DIRECTORY_SEPARATOR.$repoBasePath;

$version = new ExecutionUnit\Processing\Version($repoPath);

$list = $version->getVersionList();

$nameClass = 'v0_0_1\primer';
$class1 = new $nameClass;

echo "main Id: ", $class1->getId(), "\n\r";

$nameClass = 'v0_1_0\primer';
$class2 = new $nameClass;

echo "main Id: ", $class2->getId(), "\n\r";

echo "\n\r";
