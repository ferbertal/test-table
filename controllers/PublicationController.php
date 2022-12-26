<?php

namespace app\controllers;

use app\models\search\PublicationSearch;
use yii\web\Controller;

class PublicationController extends Controller
{
    /**
     * Lists all Publication models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PublicationSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
