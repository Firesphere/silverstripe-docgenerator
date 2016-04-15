<?php

/**
 * Class DocGenerator
 *
 * There's not much more to it than that, when you're using APIGen
 */
class DocGenerator implements Flushable
{

    /**
     * After the request, generate the docs.
     * @inheritdoc
     */
    public static function flush()
    {
        if(Config::inst()->get('DataObjectAnnotator', 'generate_documentation') === true) {
            $modules = Config::inst()->get('DataObjectAnnotator', 'documentation_modules');
            foreach($modules as $module => $location) {
                exec(Director::baseFolder() . "/vendor/apigen/apigen/bin/apigen generate -q -s " . Director::baseFolder() . "/$module -d " . Director::baseFolder() . "/$location/$module --exclude=*tests* --todo ");
            }
        }
    }

}