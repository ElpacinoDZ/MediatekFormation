<?php

namespace App\tests\Validations;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\Formation;
use DateTime;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FormationValidationTest extends KernelTestCase
{
    public function getFormation(): Formation{
        return (new Formation())
        ->setTitle("Titre de la formation")
        ->setPublishedAt(new \DateTime("2025-09-2"));
    }

    public function testValidationModificationFormations(): void
    {
        $formation = $this->getFormation()->setPublishedAt(new \DateTime("2025-09-2"));
        $this->assertErrors($formation, 1, "[ERREUR] 2025-09-2 est postérieure à aujourd'hui");
    }

    public function assertErrors(Formation $formation, int $nbErreursAttendues, string $message="") {
        self::bootKernel();
        $validator = self::getContainer()->get(ValidatorInterface::class);
        $error = $validator->validate($formation);
        $this->assertCount($nbErreursAttendues, $error, $message);
    }
}