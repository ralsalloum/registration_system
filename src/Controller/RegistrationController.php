<?php

namespace App\Controller;

use App\AutoMapping;
use App\Request\CourseRegisterByStudentRequest;
use App\Service\RegistrationService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use stdClass;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route(path: 'v1/courseregistration/')]
class RegistrationController extends BaseController
{
    public function __construct(SerializerInterface $serializer, private ValidatorInterface $validator, private AutoMapping $autoMapping, private RegistrationService $registrationService)
    {
        parent::__construct($serializer);
    }

    #[Route(path: 'register', name: 'courseRegistrationByStudent', methods: 'POST')]
    #[IsGranted('ROLE_STUDENT')]
    public function registerStudentInNewCourse(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $request = $this->autoMapping->map(stdClass::class, CourseRegisterByStudentRequest::class, (object)$data);

        $request->setStudentUserId($this->getUserId());

        $violations = $this->validator->validate($request);
        if(\count($violations) > 0) {
            $violationsString = (string) $violations;

            return new JsonResponse($violationsString, Response::HTTP_OK);
        }

        $response = $this->registrationService->registerStudentInNewCourse($request);

        return $this->response($response, self::CREATE);
    }
}
