<?php
declare(strict_types=1);

namespace app\dto;

use yii\base\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *   schema="NumberCollectionDto",
 *   required={"numbers"},
 *   @OA\Property(
 *     property="numbers",
 *     type="array",
 *     @OA\Items(type="integer")
 *   )
 * )
 */
class NumberCollectionDto extends Model
{
    /** @var int[] */
    public ?array $numbers = null;

    public function rules(): array
    {
        return [
            ['numbers', 'required'],
            ['numbers', 'each', 'rule' => ['integer']],
        ];
    }
}
