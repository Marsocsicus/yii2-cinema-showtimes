<?php

namespace frontend\controllers;

use common\models\FilmSession;

class FilmSessionController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $filmsSession = FilmSession::getFilmsSession();

        return $this->render('index', [
            'filmsSession' => $filmsSession,
        ]);
    }

}
