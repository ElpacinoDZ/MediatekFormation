<?php
namespace App\tests;

use App\Entity\Formation;
use PHPUnit\Framework\TestCase;
use DateTime;

class DateTest extends TestCase {

    public function testGetPublishedAt() {
        $formation = new Formation();
        $formation->setPublishedAt(new \DateTime("2023-09-25 "));
        $this->assertEquals("25/09/2023", $formation->getPublishedAtString());
    }
}
