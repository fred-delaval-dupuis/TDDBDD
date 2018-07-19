<?php
/**
 * Created by PhpStorm.
 * User: Etudiant0
 * Date: 19/07/2018
 * Time: 12:31
 */

namespace App\Tests\Entity;


use App\Entity\Atom;
use PHPUnit\Framework\TestCase;

class AtomTest extends TestCase
{
    public function testAtomCanBeCreated(): void
    {
        $atom = new Atom('Carbon', 'C');
        $this->assertInstanceOf(Atom::class, $atom);
    }

    public function testAtomHasAName(): void
    {
        $atom = new Atom('Carbon', 'C');
        $this->assertEquals('Carbon', $atom->getName());

        $atom = new Atom('Oxygen', 'O');
        $this->assertEquals('Oxygen', $atom->getName());
    }

    public function testAtomHasASymbol(): void
    {
        $atom = new Atom('Carbon', 'C');
        $this->assertEquals('C', $atom->getSymbol());

        $atom = new Atom('Oxygen', 'O');
        $this->assertEquals('O', $atom->getSymbol());
    }

    public function testAtomCannotHaveSymbolMoreThanTwoCharacters(): void
    {
        $this->expectException(\LengthException::class);
        $atom = new Atom('Carbon', 'Car');
    }

    public function testAtomCannotBeCreatedWithoutNameAndSymbol(): void
    {
        $this->expectException(\ArgumentCountError::class);
        $atom = new Atom();
    }
}
