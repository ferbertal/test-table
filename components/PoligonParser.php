<?php

namespace app\components;

use yii\base\BaseObject;

class PoligonParser extends BaseObject
{
    /**
     * @param string $jsonBody
     * @return array
     */
    public static function parse(string $jsonBody): array
    {
        $poligonDTOs = [];
        $poligonsData = json_decode($jsonBody, true);
        foreach ($poligonsData as $poligonData) {
            $poligonDTO = new PoligonDTO();
            $poligonDTO->loadSource($poligonData);

            $poligonDTOs[] = $poligonDTO;
        }

        return $poligonDTOs;
    }
}