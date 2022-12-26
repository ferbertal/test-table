<?php

namespace app\components;

use yii\base\BaseObject;

class PoligonDTO extends BaseObject
{
    public ?string $start_time = null;
    public ?array $route = null;
    public ?array $contractor = null;
    public ?string $platform = null;
    public ?string $status = null;

    /**
     * @param array $source
     * @return void
     */
    public final function loadSource(array $source): void
    {
        foreach ($source as $property => $value) {
            if (!$this->hasProperty($property)) {
                continue;
            }

            $this->{$property} = $value;
        }
    }
}