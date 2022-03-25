<?php


namespace App\DataFixtures\Processor;


use App\Entity\StudentEntity;
use Fidry\AliceDataFixtures\ProcessorInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserProcessor implements ProcessorInterface
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {

    }

    public function preProcess(string $id, object $object): void
    {
        if (false === $object instanceof StudentEntity) {
            return;
        }

        /** @var StudentEntity $object */
        $object->setPassword($this->passwordHasher->hashPassword($object, $object->getPassword()));
    }

    public function postProcess(string $id, object $object): void
    {
        // TODO: Implement postProcess() method.
    }
}