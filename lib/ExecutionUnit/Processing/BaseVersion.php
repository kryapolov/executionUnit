<?php

namespace ExecutionUnit\Processing;


/**
 * Class Versions
 *
 * @author	Konstantin Ryapolov <kryapolov@yandex.ru>
 * @package ExecutionUnit\Processing
 */
abstract class BaseVersion {


    /**
     * List of available versions
     *
     * @var array
     */
    protected $versions;

    /**
     * @var string
     */
    protected $basePath;

    /**
     * @param string $basePath path to repo
     */
    public function __construct($basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * Get Last of Version
     *
     * @return string
     */
    public function getLastVersion()
    {
        $versions = $this->getVersionList();

        return array_pop($versions);
    }

    /**
     * Get Last of Version
     *
     * @return string
     */
    public function getFirstVersion()
    {
        $versions = $this->getVersionList();

        return array_shift($versions);
    }

    /**
     * Get the difference between the two versions
     *
     * @param bool $startVersion
     * @param bool $endVersion
     *
     * @return array
     */
    public function getDiff($startVersion = false, $endVersion = false)
    {

        if (!$startVersion) {
            $startVersion = $this->getFirstVersion();
        }

        if (!$endVersion) {
            $endVersion = $this->getLastVersion();
        }

        return $this->_calculateStages($this->versions, $startVersion, $endVersion);
    }

    /**
     * Calculate correct stage of changes witch last stage
     *
     * @param array  $versions      List Version
     * @param string $startVersion  Start version
     * @param string $targetVersion Target version
     *
     * @return array
     */
    private function _calculateStages($versions, $startVersion, $targetVersion)
    {

        $steps = array();
        foreach ($versions as $step) {
            if (
                (version_compare($startVersion, $step, '>') || version_compare($targetVersion, $step, '>='))
                && $step != $startVersion
            ) {
                $steps[] = $step;
            }

        }

        return $steps;
    }

    /**
     * Returns all list of versions
     *
     * @return array
     */
    abstract public function getVersionList();


}