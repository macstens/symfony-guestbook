<?php

namespace App\DataFixtures;

use App\Entity\Guestbook;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GuestbookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            [
                'Marcel',
                'Freitag',
                'test@tester.com',
                'Lorem ipsum dolor sit amet'
            ], 
            [
                'Stefan',
                'Gillert',
                'test@tester.com',
                'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut l'
            ], 
            [
                'Alexander',
                'Donnini',
                'test@tester.com',
                'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod '
            ], 
            [
                'Herbert',
                'Kaminski',
                'test@tester.com',
                'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy'
            ], 
            [
                'Johannes',
                'Butterbrot',
                'test@tester.com',
                'Lorem ipsum dolor sit amet, consetetur sadipscing elitr'
            ], 
            [
                'Karl',
                'Kaufmann',
                'test@tester.com',
                'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor'
            ], 
            [
                'Ernst',
                'Element',
                'test@tester.com',
                'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, tempor invidunt ut l'
            ], 
            [
                'Bernd',
                'Backstein',
                'test@tester.com',
                'Lorem ipsum dolor sit amet, sed diam nonumy eirmod tempor invidunt ut l'
            ], 
            [
                'Oliver',
                'Schneemann',
                'test@tester.com',
                'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam volu'
            ], 
            [
                'Josephine',
                'Bäcker',
                'test@tester.com',
                'Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut l'
            ], 
        ];

        foreach($data as $date) {
            $guestbook = new Guestbook();
            $guestbook->setFirstname($date[0]);
            $guestbook->setLastname($date[1]);
            $guestbook->setEmail($date[2]);
            $guestbook->setContent($date[3]);
            $manager->persist($guestbook);
        }

        $manager->flush();
    }
}
