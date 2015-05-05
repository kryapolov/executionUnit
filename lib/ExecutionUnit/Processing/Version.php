<?php

namespace ExecutionUnit\Processing;

/**
 * Class Version
 *
 * @author	Konstantin Ryapolov <kryapolov@yandex.ru>
 * @package ExecutionUnit\Processing
 */
class Version extends BaseVersion
{

    /**
     * {@inheritdoc}
     */
    public function getVersionList()
    {
        $versionList = array();
        foreach (glob($this->basePath) as $dirname) {

            if (!is_file($dirname)) {
                $toc = explode("/", $dirname);

                $version = end($toc);
                $versionList[] = $version;
            }
        }

        $this->versions = $versionList;


        return $versionList;
    }


}