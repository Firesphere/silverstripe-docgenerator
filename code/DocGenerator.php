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
    protected $documentation_modules = array();

    /**
     * After the request, generate the docs.
     *
     * @inheritdoc
     */
    public static function flush()
    {
        if (Config::inst()->get('DocGenerator', 'enabled') === true) {
            $modules = Config::inst()->get('DocGenerator', 'documentation_modules');
            foreach ($modules as $module => $location) {
                exec(Director::baseFolder() . "/vendor/apigen/apigen/bin/apigen generate -q -s " . Director::baseFolder() . "/$module -d " . Director::baseFolder() . "/$location/$module --exclude=*tests* --todo ");
            }
        }
    }

}
