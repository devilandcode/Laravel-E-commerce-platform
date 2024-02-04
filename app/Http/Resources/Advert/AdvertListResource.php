<?php

namespace App\Http\Resources\Advert;

use App\Models\Adverts\Advert\Photo;
use App\Models\Adverts\Category;
use App\Models\Region;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertListResource extends JsonResource
{
    /**
     * @property int $id
     * @property string $title
     * @property int $price
     * @property string $address
     * @property Carbon $published_at
     *
     * @property User $user
     * @property Region $region
     * @property Category $category
     * @property Photo[]|Collection $photos
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id, /** @phpstan-ignore-line */
            'user' => [
                'name' => $this->user->name, /** @phpstan-ignore-line */
                'phone' => $this->user->phone, /** @phpstan-ignore-line */
            ],
            'category' => [
                'id' => $this->category->id, /** @phpstan-ignore-line */
                'name' => $this->category->name, /** @phpstan-ignore-line */
            ],
            'region' => $this->region ? [ /** @phpstan-ignore-line */
                'id' => $this->region->id, /** @phpstan-ignore-line */
                'name' => $this->region->name, /** @phpstan-ignore-line */
            ] : [],
            'title' => $this->title,  /** @phpstan-ignore-line */
            'price' => $this->price,  /** @phpstan-ignore-line */
            'date' => $this->published_at,  /** @phpstan-ignore-line */
            'photo' => $this->photos->first(),  /** @phpstan-ignore-line */
        ];
    }
}

/**
 * @OA\Definition(
 *     definition="AdvertList",
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
 *     @OA\Property(property="price", type="integer"),
 *     @OA\Property(property="date", type="date"),
 *     @OA\Property(property="photo", type="string"),
 * )
 */
