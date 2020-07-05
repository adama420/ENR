<?php

namespace App\DataFixtures;

use App\Entity\Alarm;
use App\Entity\Device;
use App\Entity\Maintenance;
use App\Entity\Notice;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder){
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $user = new User();
        $user->setEmail('edilkaminenr@gmail.com')
            ->setPassword($this->passwordEncoder->encodePassword($user, 'Edilka62138'))
            ->setFirstName('ENR')
            ->setLastName('Admin')
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);



        for($d = 0; $d < 30; $d++){
            $device = new Device();
            $device->setName($faker->city)
                ->setReference($faker->ean13)
                ->setIllustration($faker->imageUrl($width = 250, $height = 250, 'abstract'));

            $manager->persist($device);

            for($a = 0; $a < 11; $a++){
                $alarm = new Alarm();
                $alarm->setTitle($faker->text($maxNbChars = 200))
                    ->setSlug($faker->slug)
                    ->setDescription($faker->text($maxNbChars = 60))
                    ->setImage($faker->imageUrl($width = 250, $height = 250, 'business'))
                    ->setSubtitle($faker->words($nb = 3, $asText = true))
                    ->setExplanation($faker->text($maxNbChars = 500))
                    ->setBulletList($faker->words($nb = 5, $asText = true))
                    ->setDevice($device);

                $manager->persist($alarm);
            }

            for ($m = 0; $m < 11; $m++){
                $maintenance = new Maintenance();
                $maintenance->setNameStep($faker->word)
                            ->setTitle($faker->text($maxNbChars = 15))
                            ->setExplanation($faker->text($maxNbChars = 500))
                            ->setImage($faker->imageUrl($width = 250, $height = 250, 'technics'))
                            ->setBulletList($faker->words($nb = 5, $asText = true))
                            ->setDevice($device);

                $manager->persist($maintenance);
            }

            for ($n = 0; $n < 1; $n++){
                $notice = new Notice();
                $notice->setPdfFile($faker->fileExtension)
                        ->setDevice($device);

                $manager->persist($notice);
            }
        }

        $manager->flush();
    }
}
