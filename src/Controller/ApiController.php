<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\RandomUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/randomUser", name="randomUser")
     */
    public function importUser(
        KernelInterface $kernel,
        Request $request
    ): Response {
        try {
            $application = new Application($kernel);
            $application->setAutoExit(false);

            $input = new ArrayInput([
                'command' => 'app:create-random-user',
                'results' => $request->get('results') ?? 50
            ]);
            $output = new NullOutput();
            $application->run($input, $output);

            return $this->json('random users imported');
        } catch (\Exception $exception) {
            return $this->json('failed import check log', 500);
        }
    }

    /**
     * @Route("/api/get", name="get_all_users")
     */
    public function getUsers(
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer
    ): JsonResponse {
        $repository = $entityManager->getRepository(RandomUser::class);
        $randomUsers = $repository->findAll();

        $data = $serializer->serialize($randomUsers, JsonEncoder::FORMAT);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
