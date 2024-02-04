<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * @property int $id
     * @property string $name
     * @property string $last_name
     * @property string $email
     * @property string $phone
     * @property bool $phone_verified
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,   /** @phpstan-ignore-line */
            'email' => $this->email,  /** @phpstan-ignore-line */
            'phone' => [
                'number' => $this->phone,   /** @phpstan-ignore-line */
                'verified' => $this->phone_verified,  /** @phpstan-ignore-line */
            ],
            'name' => [
                'first' => $this->name,  /** @phpstan-ignore-line */
                'last' => $this->last_name,   /** @phpstan-ignore-line */
            ],
        ];
    }
}

/**
 * @OA\Definition(
 *     definition="Profile",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="email", type="string"),
 *     @OA\Property(property="phone", type="object",
 *         @OA\Property(property="number", type="string"),
 *         @OA\Property(property="verified", type="boolean"),
 *     ),
 *     @OA\Property(property="name", type="object",
 *         @OA\Property(property="first", type="string"),
 *         @OA\Property(property="last", type="string"),
 *     ),
 * )
 */
