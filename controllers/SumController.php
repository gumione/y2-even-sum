<?php
declare(strict_types=1);

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\Response;
use yii\web\UnprocessableEntityHttpException;
use yii\filters\Cors;
use app\dto\NumberCollectionDto;
use app\services\interfaces\SumCalculatorInterface;
use OpenApi\Annotations as OA;

class SumController extends Controller
{
    private SumCalculatorInterface $calculator;

    public function __construct(
        string $id,
        \yii\base\Module $module,
        SumCalculatorInterface $calculator,
        array $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->calculator = $calculator;
    }

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = [
            'class' => Cors::class,
            'cors'  => [
                'Origin'                         => ['*'],
                'Access-Control-Request-Method'  => ['POST', 'OPTIONS'],
                'Access-Control-Allow-Credentials' => false,
            ],
        ];

        return $behaviors;
    }

    public function verbs(): array
    {
        return [
            'index' => ['POST', 'OPTIONS'],
        ];
    }

    /**
     * @OA\Post(
     *   path="/sum-even",
     *   summary="Calculate sum of even numbers",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/NumberCollectionDto")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(property="sum", type="integer")
     *     )
     *   ),
     *   @OA\Response(response=422, description="Validation error")
     * )
     *
     * @return array{sum:int}
     * @throws UnprocessableEntityHttpException
     */
    public function actionIndex(): array
    {
        $dto = new NumberCollectionDto();
        $dto->load(Yii::$app->request->getBodyParams(), '');

        if (!$dto->validate()) {
            throw new UnprocessableEntityHttpException(
                json_encode($dto->getErrors(), JSON_UNESCAPED_UNICODE)
            );
        }

        $sum = $this->calculator->calculate($dto->numbers);
        return ['sum' => $sum];
    }
}
