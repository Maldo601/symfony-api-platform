<?php


namespace App\Exception\User;


use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

# 409
class UserAlreadyExistException extends ConflictHttpException
{
    private const MESSAGE = 'El usuario con el email %s ya existe!';

    public static function fromEmail(string $email): self
    {
        throw new self(\sprintf(self::MESSAGE, $email));
    }
}