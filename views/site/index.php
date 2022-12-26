<?php

/**
 * @var yii\web\View $this
 * @var $dataProvider
 */


use app\components\PoligonDTO;
use yii\grid\GridView;

$this->title = 'The table!';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"><?php echo $this->title ?></h1>
    </div>

    <div class="body-content">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns'      => [
                [
                    'label' => 'ВРЕМЯ',
                    'value' => function (PoligonDTO $poligonDTO) {
                        if (empty($poligonDTO->start_time)) {
                            return '';
                        }

                        return $poligonDTO->start_time;
                    },
                ],
                [
                    'label' => 'РЕЙС',
                    'value' => function (PoligonDTO $poligonDTO) {
                        if (empty($poligonDTO->route)) {
                            return '';
                        }

                        return $poligonDTO->route['title'];
                    },
                ],
                [
                    'label' => 'ПЕРЕВОЗЧИК',
                    'value' => function (PoligonDTO $poligonDTO) {
                        if (empty($poligonDTO->contractor)) {
                            return '';
                        }

                        return $poligonDTO->contractor['title'];
                    },
                ],
                [
                    'label' => 'ПЛАТФОРМА',
                    'value' => function (PoligonDTO $poligonDTO) {
                        if (empty($poligonDTO->platform)) {
                            return '';
                        }

                        return $poligonDTO->platform;
                    },
                ],
                [
                    'label' => 'СОСТОЯНИЕ',
                    'value' => function (PoligonDTO $poligonDTO) {
                        if (empty($poligonDTO->status)) {
                            return '';
                        }

                        return $poligonDTO->status;
                    },
                ],
            ],
        ]); ?>

    </div>
</div>
