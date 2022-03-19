<?php

declare(strict_types=1);

namespace App\Exception\User;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;



class UserNotFoundException extends NotFoundHttpException
{
    private CONST MESSAGE = "El usuario con email %s no se ha encontrado. ";

    public static function fromEmail(string $email): self
    {
        throw new self(\sprintf(self::MESSAGE, $email));
    }
}