<?php

namespace App\Manager;

use App\AutoMapping;
use App\Entity\StudentEntity;
use App\Repository\StudentRepository;
use App\Request\StudentRegisterRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class StudentManager
{
    public function __construct(private AutoMapping $autoMapping, private EntityManagerInterface $entityManager, private StudentRepository $studentRepository,
                                private UserPasswordHasherInterface $passwordHasher)
    {

    }

    public function registerNewStudent(StudentRegisterRequest $studentRegisterRequest): StudentEntity
    {
        $registeredStudent = $this->autoMapping->map(StudentRegisterRequest::class, StudentEntity::class, $studentRegisterRequest);

        $user = new StudentEntity($studentRegisterRequest->getEmail());

        $registeredStudent->setPassword($this->passwordHasher->hashPassword($user, $studentRegisterRequest->getPassword()));

        $registeredStudent->setRoles(["ROLE_STUDENT"]);

        $this->entityManager->persist($registeredStudent);
        $this->entityManager->flush();

        return $registeredStudent;
    }

    public function getStudentByUserId(int $studentUserId): ?StudentEntity
    {
        return $this->studentRepository->find($studentUserId);
    }
}
