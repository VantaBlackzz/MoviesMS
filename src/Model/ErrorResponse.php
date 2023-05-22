<?php

declare(strict_types=1);

namespace App\Model;

use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

class ErrorResponse
{
    public function __construct(
        private readonly string $message,
        private readonly mixed $details = null
    ) {
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @OA\Property(type="object", oneOf={
     *     @OA\Schema(ref=@Model(type=ErrorDebugDetails::class)),
     *     @OA\Schema(ref=@Model(type=ErrorValidationDetails::class))
     * })
     */
    public function getDetails(): mixed
    {
        return $this->details;
    }
}
