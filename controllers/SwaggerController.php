<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii2mod\swagger\SwaggerUIRenderer;
use yii2mod\swagger\OpenAPIRenderer;
use yii\web\ErrorAction;

/**
 * @SWG\Swagger(
 *     basePath="/",
 *     security={ {"Bearer":{}} },
 *     produces={"application/json"},
 *     consumes={"application/x-www-form-urlencoded"},
 *     @SWG\Info(version="1.0", title="API"),
 * )
 */
class SwaggerController extends Controller
{
    public function actions(): array
    {
        return [
            'docs' => [
                'class' => SwaggerUIRenderer::class,
                'restUrl' => Url::to(['swagger/json-schema']),
            ],
            'json-schema' => [
                'class' => OpenAPIRenderer::class,
                // Тhe list of directories that contains the swagger annotations.
                'scanDir' => [
                    Yii::getAlias('@app/controllers'),
                    Yii::getAlias('@app/modules'),
                ],
            ],
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }
}
