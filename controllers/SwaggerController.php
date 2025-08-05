<?php
declare(strict_types=1);

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * @OA\Info(title="Even Sum API", version="1.0.0")
 *
 * @OA\PathItem(path="/swagger")
 */
class SwaggerController extends Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class'   => 'light\swagger\SwaggerAction',
                'restUrl' => Url::to(['swagger/json'], true),
            ],
            'json' => [
                'class'   => 'light\swagger\SwaggerApiAction',
                'scanDir' => [
                    Yii::getAlias('@app/controllers'),
                    Yii::getAlias('@app/dto'),
                ],
            ],
        ];
    }
}
