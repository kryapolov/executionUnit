<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
spl_autoload_register(
    function($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                'executionunit\\configs\\config' => '/Configs/Config.php',
                'executionunit\\execution' => '/Execution.php',
                'executionunit\\layers\\simple' => '/Layers/Simple.php',
                'executionunit\\processing\\baseversion' => '/Processing/BaseVersion.php',
                'executionunit\\processing\\logic' => '/Processing/Logic.php',
                'executionunit\\processing\\version' => '/Processing/Version.php'
            );
        }
        $cn = strtolower($class);
        if (isset($classes[$cn])) {
            require __DIR__ . $classes[$cn];
        }
    }
);
// @codeCoverageIgnoreEnd
