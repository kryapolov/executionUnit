<?php

namespace ExecutionUnit\Processing;

/**
 * Class Version
 *
 * @author    Konstantin Ryapolov <kryapolov@yandex.ru>
 * @package   ExecutionUnit\Processing
 */
class Version extends BaseVersion
{
    const VERSION_DELIMITER = '_';
    const NAMESPACE_PREFIX = '';
    const NAMESPACE_SEPARATOR = '\\';

    public $list;
    /**
     *
     * {@inheritdoc}
     */
    public function getVersionList()
    {
        $versionList = array();
        foreach (glob($this->getBasePath().DIRECTORY_SEPARATOR.'*') as $dirname) {

            if (!is_file($dirname)) {
                $toc = explode("/", $dirname);

                $version = end($toc);
                $versionList[] = $version;
            }
        }

        $this->versions = $versionList;
        $this->_loadVersionDescription($versionList);

        return $versionList;
    }

    /*
     *
     * {@inheritdoc}
     */
    public function getNameVersion($name)
    {
        $nativeForm = str_replace($this::VERSION_DELIMITER, '.', $name);
        $semverForm = $nativeForm;

        if ($nativeForm[0] == 'v') {
            $semverForm = substr($nativeForm, 1);
        }

        return $semverForm;
    }

    /**
     * Part AL, load logic mapping
     *
     * @param $versionList
     */
    private function _loadVersionDescription($versionList)
    {

        $list = array();

        foreach ($this->versions as $version) {
            $currentDir = $this->getBasePath().DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR.'*.php';

            foreach (glob($currentDir) as $resource) {
                $namespace = $version;
                $key = strtolower($namespace.$this::NAMESPACE_SEPARATOR.basename($resource, '.php'));
                $list[$key] = $resource;
            }
        }

        $this->list = $list;

        spl_autoload_register(array($this, '_loader'));

    }

    /**
     * Part AL, load logic implement
     *
     * @param $class
     */
    public function _loader($class)
    {

        $classes = $this->list;
        $cn = strtolower($class);

        if (isset($classes[$cn])) {
            require $classes[$cn];
        }

    }



}