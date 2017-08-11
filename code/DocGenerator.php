<?php

/**
 * Class DocGenerator.
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
     * {@inheritdoc}
     */
    public static function flush()
    {
        if ((Config::inst()->get(self::class, 'enabled') === true) && (Config::inst()->get(self::class, 'multi_module_enabled') === true)) {
            self::processMulti();
        } elseif (Config::inst()->get(self::class, 'enabled') === true) {
            self::processSingle();
        }
    }

    /**
     * Generate docs for folder/module.
     */
    private static function processSingle()
    {
        $director = Injector::inst()->get(Director::class);
        $modules = Config::inst()->get(self::class, 'document_modules');
        foreach ($modules as $module => $location) {
            exec($director->baseFolder().'/vendor/apigen/apigen/bin/apigen generate -q -s '.$director->baseFolder()."/$module -d ".$director->baseFolder()."/$location/$module --exclude=*tests* --todo ");
            DB::alteration_message('(Re)generated docs in '.$director->baseFolder().'/'.$location.'/'.$module.' for '.$module, 'good');
        }
    }

    /**
     * Generate single docs from multiple folders/modules.
     */
    private static function processMulti()
    {
        $director = Injector::inst()->get(Director::class);
        $modulesArray = Config::inst()->get(self::class, 'multi_modules');
        $destination = Config::inst()->get(self::class, 'multi_module_destination');
        $destinationPath = $director->baseFolder().'/'.$destination;
        $modules = [];
        foreach ($modulesArray as $key => $value) {
            $modules[] = ' -s '.$director->baseFolder().'/'.$value;
            DB::alteration_message('(Re)generating docs for module: '.$value, 'good');
        }
        $modulesString = implode(' ', $modules);
        $command = $director->baseFolder().'/vendor/apigen/apigen/bin/apigen generate -q '.$modulesString.' -d '.$destinationPath.' --exclude=*tests* --todo --deprecated';
        exec($command);
        DB::alteration_message('(Re)generated docs destination: '.$destinationPath, 'good');
    }
}
