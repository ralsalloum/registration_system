<?php

namespace App\Service;

use App\AutoMapping;
use App\Entity\StudentEntity;
use App\Manager\StudentManager;
use App\Request\StudentRegisterRequest;
use App\Response\StudentRegisterResponse;

class StudentService
{
    public function __construct(private AutoMapping $autoMapping, private StudentManager $studentManager)
    {

    }

    public function registerNewStudent(StudentRegisterRequest $registerRequest): StudentRegisterResponse
    {
        $newStudentResult = $this->studentManager->registerNewStudent($registerRequest);

        return $this->autoMapping->map(StudentEntity::class, StudentRegisterResponse::class, $newStudentResult);
    }
}
