<?php namespace Codecycler\ImportShopaholic;

use Codecycler\ImportShopaholic\Classes\Event\BeforeImport;
use Lovata\Toolbox\Classes\Helper\AbstractImportModel;
use System\Classes\PluginBase;
use Event;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }

    public function boot()
    {
        Event::listen(AbstractImportModel::EVENT_BEFORE_IMPORT, BeforeImport::class, 5);
    }
}
