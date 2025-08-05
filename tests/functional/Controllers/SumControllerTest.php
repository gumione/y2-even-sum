<?php
declare(strict_types=1);

namespace tests\functional\Controllers;

use Yii;
use yii\base\Module;
use yii\web\UnprocessableEntityHttpException;
use app\controllers\SumController;
use app\services\EvenSumCalculator;
use PHPUnit\Framework\TestCase;

class SumControllerTest extends TestCase
{
    private SumController $ctrl;

    protected function setUp(): void
    {
        parent::setUp();
        $module = new Module('test', Yii::$app);
        $this->ctrl = new SumController('sum', $module, new EvenSumCalculator());
    }

    public function testSuccess(): void
    {
        Yii::$app->request->setBodyParams(['numbers' => [1, 2, 3, 4]]);
        $resp = $this->ctrl->actionIndex();
        $this->assertSame(['sum' => 6], $resp);
    }

    public function testValidationErrorEmpty(): void
    {
        Yii::$app->request->setBodyParams([]);
        $this->expectException(UnprocessableEntityHttpException::class);
        $this->ctrl->actionIndex();
    }

    public function testValidationErrorNonIntegers(): void
    {
        Yii::$app->request->setBodyParams(['numbers' => ['a', 'b']]);
        $this->expectException(UnprocessableEntityHttpException::class);
        $this->ctrl->actionIndex();
    }

    public function testNegativeNumbers(): void
    {
        Yii::$app->request->setBodyParams(['numbers' => [-2, -3, 4]]);
        $resp = $this->ctrl->actionIndex();
        $this->assertSame(['sum' => 2], $resp);
    }

    public function testCorsBehaviorIncludesOptions(): void
    {
        $verbs = $this->ctrl->verbs();
        $this->assertArrayHasKey('index', $verbs);
        $this->assertContains('OPTIONS', $verbs['index']);
    }

    public function testCorsFilterRegistered(): void
    {
        $behaviors = $this->ctrl->behaviors();
        $this->assertArrayHasKey('corsFilter', $behaviors);
        $this->assertArrayHasKey('class', $behaviors['corsFilter']);
        $this->assertStringContainsString('Cors', $behaviors['corsFilter']['class']);
    }
}
