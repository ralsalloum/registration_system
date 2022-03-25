<?php

namespace App\Controller;

use App\AutoMapping;
use App\Request\StudentRegisterRequest;
use App\Service\StudentService;
use stdClass;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route(path: 'v1/student/')]
class StudentController extends BaseController
{
    public function __construct(SerializerInterface $serializer, private ValidatorInterface $validator, private AutoMapping $autoMapping, private StudentService $studentService)
    {
        parent::__construct($serializer);
    }

    #[Route(path: 'register', name: 'registerNewStudent', methods: 'POST')]
    public function registerNewStudent(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $request = $this->autoMapping->map(stdClass::class, StudentRegisterRequest::class, (object)$data);

        $violations = $this->validator->validate($request);
        if(\count($violations) > 0) {
            $violationsString = (string) $violations;

            return new JsonResponse($violationsString, Response::HTTP_OK);
        }

        $response = $this->studentService->registerNewStudent($request);

        return $this->response($response, self::CREATE);
    }
}
