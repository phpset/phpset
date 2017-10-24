<?php


namespace App\Base;

use Injectable\Factories\LeagueFactory;
use PdoModel\PdoModel;

/**
 * @property \App\Vids\VidsModel vids
 */
class ModelLocator
{
    private $modelsContainer;

    public function __construct(\PDO $connection, $models)
    {
        $this->modelsContainer = LeagueFactory::fromConfig($models, [$connection]);
    }

    /**
     * @return PdoModel
     */
    public function __get($name)
    {
        if ($this->modelsContainer->has($name)) {
            return $this->modelsContainer->get($name);
        }
        return null;
    }
}