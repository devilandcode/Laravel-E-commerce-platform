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
