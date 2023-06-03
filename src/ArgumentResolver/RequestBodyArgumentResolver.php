<?php

declare(strict_types=1);

namespace App\ArgumentResolver;

use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use App\Exception\RequestBodyConvertException;
use Symfony\Component\HttpFoundation\Request;
use App\Exception\ValidationException;
use App\RequestDTO\NewMovieRequest;
use Throwable;

readonly class RequestBodyArgumentResolver implements ValueResolverInterface
{
    public function __construct(
        private SerializerInterface $serializer,
        private ValidatorInterface  $validator
    ) {
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        if ($argument->getType() === NewMovieRequest::class) {
            try {
                $object = $this->serializer->deserialize(
                    $request->getContent(),
                    $argument->getType(),
                    JsonEncoder::FORMAT
                );

            } catch (Throwable) {
                throw new RequestBodyConvertException();
            }

            $errors = $this->validator->validate($object);

            if (count($errors) > 0)
                throw new ValidationException($errors);

            return [$object];
        }

        return [];
    }
}
