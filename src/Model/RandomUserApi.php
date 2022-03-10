<?php

declare(strict_types=1);

namespace App\Model;

use App\Entity\RandomUser;
use Doctrine\ORM\EntityManagerInterface;

class RandomUserApi
{
    public const API_URL = 'https://randomuser.me/api/';
    public const API_PARAM_SEED = 'dvore';
    public const API_PARAM_RESULT = 50;
    public const API_PARAM_NAT = 'FR';

    private $entityManager;

    private $results = 50;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }


    public function CreateUser(object $userData): self
    {
        $checkUser = $this->checkUser($userData->email);

        if ($checkUser) {
            return $this;
        }

        $user = new RandomUser();
        $user->setGender($userData->gender);
        $user->setFirstName($userData->name->first);
        $user->setLastName($userData->name->last);
        $user->setEmail($userData->email);
        $user->setLocationState($userData->location->state);
        $user->setLocationTimeOffset($userData->location->timezone->offset);
        $user->setLocationCordinates(get_object_vars($userData->location->coordinates));
        $user->setDobDate(new \DateTime($userData->dob->date));
        $user->setPhone($userData->phone);
        $user->setRegistredDate(new \DateTime($userData->registered->date));

        // missing one from description
        $user->setAge($userData->registered->age);

        $this->entityManager->persist($user);

        return $this;
    }

    public function generateRandomUser(?int $result = 50): self
    {
        $this->results = $result;
        $randomUsers = $this->getRandomUserFromApi();

        foreach ($randomUsers as $user) {
            $this->CreateUser($user);
        }
        $this->entityManager->flush();

        return $this;
    }

    private function checkUser(string $email): bool
    {
        $repository = $this
            ->entityManager
            ->getRepository(RandomUser::class);

        $user = $repository->findBy(['email' => $email]);

        return (bool)$user;
    }

    private function getRandomUserFromApi(): ?array
    {
        $json = file_get_contents($this->buildUrl());
        $jsonResult =  json_decode($json);

        return $jsonResult->results ?? null;
    }

    private function buildUrl(): string
    {
        $data = ['seed'=>self::API_PARAM_SEED,
            'results'=>$this->results,
            'nat'=>self::API_PARAM_NAT];

        $queryString =  http_build_query($data);
        return self::API_URL.'?'.$queryString;
    }
}
