<?php

/**
 * Class DocGenerator
 *
 * There's not much more to it than that, when you're using APIGen
 */
class DocGenerator extends Object implements Flushable
{
    /**
     * @var bool
     */
    protected $enabled = false;

    /**
     * @var array
     */
    protected $document_modules = array();

    /**
     * After the request, generate the docs.
     *
     * @inheritdoc
     */
    public static function flush()
    {
        if (Config::inst()->get('DocGenerator', 'enabled') === true) {
            $modules = Config::inst()->get('DocGenerator', 'document_modules');
            foreach ($modules as $module => $location) {
                /** @var Director $director */
                $director = Injector::inst()->get('Director');
                exec($director->baseFolder() . "/vendor/apigen/apigen/bin/apigen generate -q -s " . $director->baseFolder() . "/$module -d " . $director->baseFolder() . "/$location/$module --exclude=*tests* --todo ");
            }
        }
    }

}
