<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\Response;
use app\models\Request;

class RequestController extends Controller
{
    public $modelClass = Request::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => ['http://your-allowed-domain.com'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age' => 86400,
            ],
        ];
        return $behaviors;
    }

    public function actionCreate()
    {
        $request = new Request();
        $request->load(Yii::$app->request->post(), '');
        if ($request->save()) {
            return $request;
        }

        return $request->getErrors();
    }

    public function actionUpdate($id)
    {
        $request = Request::findOne($id);
        $params = json_decode(Yii::$app->request->getRawBody());

        if ($request) {
            $request->status = $params->status;
            $request->comment = $params->comment;
            $request->save();
            return $request;
        }

        return $request->getErrors();
    }

    public function actionIndex()
    {
        $query = Request::find();
        $status = Yii::$app->request->get('status');
        $created_at = Yii::$app->request->get('created_at');

        if ($status) {
            $query->andWhere(['status' => $status]);
        }
        if ($created_at) {
            $query->andWhere(['>=', 'created_at', $created_at]);
        }

        return $query->all();
    }
}
