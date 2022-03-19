<?php

declare(strict_types=1);

namespace App\Repository;


use App\Entity\User;
use App\Exception\User\UserNotFoundException;


class UserRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return User::class;
    }

    /**
     * @param string $email
     * @return \App\Entity\User
     * Metodo Tell Dont Ask-> Retornar un usuario por email o fallar. Pero no preguntar dentro de la misma.
     */
    public function findOneByEmailOrFail(string $email): User
    {
        if(null === $user = $this->objectRepository->findOneBy(['email' => $email]))
        {
            throw UserNotFoundException::fromEmail($email);
        }
        return $user;
    }

    /**
     * @param \App\Entity\User $user
     * @throws \Doctrine\ORM\Exception\ORMException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(User $user): void
    {
        $this->saveEntity($user);
    }

    /**
     * @param \App\Entity\User $user
     * @throws \Doctrine\ORM\Exception\ORMException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(User $user): void
    {
        $this->removeEntity($user);
    }
}