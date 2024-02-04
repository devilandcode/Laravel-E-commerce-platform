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
                'id' => $this->region->id,   /** @phpstan-ignore-line */
                'name' => $this->region->name,   /** @phpstan-ignore-line */
            ] : [],
            'title' => $this->title,   /** @phpstan-ignore-line */
            'content' => $this->content,   /** @phpstan-ignore-line */
            'price' => $this->price,   /** @phpstan-ignore-line */
            'address' => $this->address,   /** @phpstan-ignore-line */
            'date' => [
                'published' => $this->published_at,   /** @phpstan-ignore-line */
                'expires' => $this->expires_at,   /** @phpstan-ignore-line */
            ],
            'values' => array_map(function (Attribute $attribute) {   /** @phpstan-ignore-line */
                return [
                    'name' => $attribute->name,   /** @phpstan-ignore-line */
                    'value' => $this->getValue($attribute->id),   /** @phpstan-ignore-line */
                ];
            }, $this->category->allAttributes()),   /** @phpstan-ignore-line */
            'photos' => array_map(function (Photo $photo) {   /** @phpstan-ignore-line */
                return $photo->file;
            }, $this->photos->toArray()),   /** @phpstan-ignore-line */
        ];
    }
}
