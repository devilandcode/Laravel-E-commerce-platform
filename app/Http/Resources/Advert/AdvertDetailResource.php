<?php

namespace App\Http\Resources\Advert;

use App\Models\Adverts\Advert\Photo;
use App\Models\Adverts\Advert\Value;
use App\Models\Adverts\Attribute;
use App\Models\Adverts\Category;
use App\Models\Region;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertDetailResource extends JsonResource
{
    /**
     * @property int $id
     * @property string $title
     * @property string $content
     * @property int $price
     * @property string $address
     * @property Carbon $published_at
     * @property Carbon $expires_at
     *
     * @property User $user
     * @property Region $region
     * @property Category $category
     * @property Value[] $values
     * @property Photo[]|Collection $photos
     *
     * @method  mixed getValue($id)
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,   /** @phpstan-ignore-line */
            'user' => [
                'name' => $this->user->name,   /** @phpstan-ignore-line */
                'phone' => $this->user->phone,   /** @phpstan-ignore-line */
            ],
            'category' => [
                'id' => $this->category->id,   /** @phpstan-ignore-line */
                'name' => $this->category->name,   /** @phpstan-ignore-line */
            ],
            'region' => $this->region ? [   /** @phpstan-ignore-line */
                'id' => $this->region->id,
                'name' => $this->region->name,
            ] : [],
            'title' => $this->title,   /** @phpstan-ignore-line */
            'content' => $this->content,   /** @phpstan-ignore-line */
            'price' => $this->price,   /** @phpstan-ignore-line */
            'address' => $this->address,   /** @phpstan-ignore-line */
            'date' => [
                'published' => $this->published_at,   /** @phpstan-ignore-line */
                'expires' => $this->expires_at,   /** @phpstan-ignore-line */
            ],
            'values' => array_map(function (Attribute $attribute) {
                return [
                    'name' => $attribute->name,
                    'value' => $this->getValue($attribute->id),   /** @phpstan-ignore-line */
                ];
            }, $this->category->allAttributes()),   /** @phpstan-ignore-line */
            'photos' => array_map(function (Photo $photo) {   
                return $photo->file;
            }, $this->photos->toArray()),   /** @phpstan-ignore-line */
        ];
    }
}

/**
 * @OA\Definition(
 *     definition="AdvertDetail",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="user", type="object",
 *         @OA\Property(property="name", type="string"),
 *         @OA\Property(property="phone", type="string"),
 *     ),
 *     @OA\Property(property="category", type="object",
 *         @OA\Property(property="id", type="integer"),
 *         @OA\Property(property="name", type="string"),
 *     ),
 *     @OA\Property(property="region", type="object",
 *         @OA\Property(property="id", type="integer"),
 *         @OA\Property(property="name", type="string"),
 *     ),
 *     @OA\Property(property="title", type="string"),
 *     @OA\Property(property="content", type="string"),
 *     @OA\Property(property="price", type="integer"),
 *     @OA\Property(property="address", type="string"),
 *     @OA\Property(property="date", type="object",
 *         @OA\Property(property="published", type="date"),
 *         @OA\Property(property="expires", type="date"),
 *     ),
 *     @OA\Property(property="values", type="array", @OA\Items(ref="#/definitions/AdvertValue")),
 *     @OA\Property(property="photos", type="array", @OA\Items(type="string")),
 * )
 *
 * @OA\Definition(
 *     definition="AdvertValue",
 *     type="object",
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="value", type="string"),
 * )
 */
