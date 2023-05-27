<?php

declare(strict_types=1);

namespace App\ArgumentResolver;

use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use App\Exception\RequestBodyConvertException;
use Symfony\Component\HttpFoundation\Request;
use App\RequestDTO\NewMovieRequest;
use Throwable;

class RequestBodyArgumentResolver implements ValueResolverInterface
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly ValidatorInterface $validator
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

                $errors = $this->validator->validate($object);

                if (count($errors) > 0) {
                    $messages = [];
                    foreach ($errors as $error) {
                        $messages[] = $error->getPropertyPath() . ': ' . $error->getMessage();
                    }
                    throw new BadRequestHttpException(implode(PHP_EOL, $messages));
                }

                yield $object;
            } catch (Throwable $throwable) {
                throw new RequestBodyConvertException($throwable);
            }
        }

        return [];
    }
}
