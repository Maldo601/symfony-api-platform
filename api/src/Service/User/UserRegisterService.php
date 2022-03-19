<?php


namespace App\Service\User;


use App\Entity\User;
use App\Exception\User\UserAlreadyExistException;
use App\Repository\UserRepository;
use App\Service\Password\EncoderService;
use App\Service\Request\RequestService;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class UserRegisterService
{
    private UserRepository $userRepository;
    private EncoderService $encoderService;
    /**
     * UserRegisterService constructor.
     */
    public function __construct(UserRepository $userRepository, EncoderService $encoderService)
    {
        $this->userRepository = $userRepository;
        $this->encoderService = $encoderService;
    }

    public function createUser(Request $request): User
    {
        $name = RequestService::getField($request, 'name');
        $email = RequestService::getField($request, 'email');
        $password = RequestService::getField($request, 'password');

        $user = new User($name, $email);
        # Al llamar a metodo Tell Dont Ask, comprovamos ya que la length sea la correcta.
        $user->setPassword($this->encoderService->generateEncodedPassword($user, $password));

        try
        {
            $this->userRepository->save($user);
        }
        catch(Exception $exception)
        {
            throw UserAlreadyExistException::fromEmail($email);
        }

        return $user;
    }
}