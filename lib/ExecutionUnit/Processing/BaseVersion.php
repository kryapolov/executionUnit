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
     * Check and return versions list
     *
     * @return array
     */
    private function _getVersions()
    {
        if (count($this->versions)) {
            return $this->versions;
        }

        return $this->getVersionList();
    }

    /**
     * Return current basePath
     *
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * Get Last of Version
     *
     * @return string
     */
    public function getLastVersion()
    {
        $versions = $this->_getVersions();

        return array_pop($versions);
    }

    /**
     * Get Last of Version
     *
     * @return string
     */
    public function getFirstVersion()
    {
        $versions = $this->_getVersions();

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

        return $this->_calculateStages(
            $this->_getVersions(),
            $this->getNameVersion($startVersion),
            $this->getNameVersion($endVersion)
        );
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
            $stepName =  $this->getNameVersion($step);

            if (
                (version_compare($startVersion, $stepName, '>') || version_compare($targetVersion, $stepName, '>='))
                && $stepName != $startVersion
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

    /**
     * Transform name to semver
     * see http://semver.org/spec/v2.0.0.html
     *
     * @param mixed $version
     *
     * @return string
     */
    abstract public function getNameVersion($version);


}