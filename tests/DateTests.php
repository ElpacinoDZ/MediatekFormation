<?php

namespace App\Tests\Entity;

use App\Entity\Formation;
use DateTime;
use PHPUnit\Framework\TestCase;

class DateTests extends TestCase
{
    public function testGetPublishedAtString()
    {
        // Création d'une instance de l'entité Formation
        $formation = new Formation();
        
        // Définition de la date de parution
        $date = new DateTime('2025-03-15 14:09:35');
        $formation->setPublishedAt($date);

        // Format attendu de la chaîne de caractères pour la date
        $expectedFormat = '2024-01-04 17:00:12';

        // Assertion : vérifier si getPublishedAtString retourne la bonne chaîne de caractères
        $this->assertEquals($expectedFormat, $formation->getPublishedAtString());
    }
}