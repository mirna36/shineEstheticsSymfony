<?php

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');
        for($i = 0; $i <5; $i++){
            $user = new user();
            $user->setEmail($faker->unique(true)->email);
            $user->setPassword($this->encoder->encodePassword($user, '123'));
            $user->setNom($faker->unique(true)->lastName);
            $user->setPrenom($faker->unique(true)->firstName);
            $user->setTelephone($faker->unique(true)->numberBetween(0,99));


            $manager->persist($user);
        }

        $manager->flush();
    }
}
