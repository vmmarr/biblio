<?php

namespace app\controllers;

use app\models\Generos;
use Yii;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class GenerosController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $filas = (new Query())
            ->from('generos')
            ->orderBy('id')
            ->all();
        
        return $this->render('index', [
            'filas' => $filas,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findGenero($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Generos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findGenero($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findGenero($id);
        $model->delete();
        Yii::$app->session->setFlash('success', 'Fila borrada con éxito.');
        return $this->redirect(['index']);
    }

    protected function findGenero($id)
    {
        if (($genero = Generos::findOne($id)) === null) {
            throw new NotFoundHttpException('No se ha encontrado el género.');
        }

        return $genero;
    }
}
