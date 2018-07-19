<?php
/**
 * Created by PhpStorm.
 * User: Etudiant0
 * Date: 19/07/2018
 * Time: 14:34
 */

namespace App\Test\Entity;

use App\Entity\Atom;
use App\Entity\Molecule;
use PHPUnit\Framework\TestCase;

/**
 * $molecule = new Molecule('glucide');
 * $molecule->addAtom(new Atom('Carbon', 'C')
 *          ->addAtom(new Atom('Oxygen', 'O'));
 * $molecule->getAtoms(); // retourne un tableau d'atomes
 * $molecule->merge(); // Fusionne au moins 2 atomes
 * $molecule->getName(); // renvoie CO
 * $molecule->getType(); // Retourne glucide
 *
 */
class MoleculeTest extends TestCase
{
    public function testMoleculeCanBeInstantiated(): void
    {
        $this->assertInstanceOf(
            Molecule::class,
            new Molecule('glucide')
        );
    }

    public function testAtomCanBeAddedInMolecule(): void
    {
        $atom = $this->createMock(Atom::class);
        $molecule = new Molecule('glucide');

        $this->assertSame($molecule, $molecule->addAtom($atom));
        $this->assertContainsOnlyInstancesOf(Atom::class, $molecule->getAtoms());
    }

    public function testMoleculeCannotContainOnlyOneAtom(): void
    {
        $this->expectException(\LogicException::class);

        $atom = $this
            ->getMockBuilder(Atom::class)
            ->disableOriginalConstructor()
            ->setMethods(['getSymbol'])
            ->getMock()
        ;

        $atom
            ->method('getSymbol')
            ->willReturn('C')
        ;

        $molecule = new Molecule('glucide');
        $molecule->addAtom($atom);
        $molecule->getName();
    }

    public function testMoleculeCanBeMerged(): void
    {
        $carbon = $this->createConfiguredMock(Atom::class, [
            'getSymbol' => 'C'
        ]);
        $oxygen = $this->createConfiguredMock(Atom::class, [
            'getSymbol' => 'O'
        ]);

        $molecule = new Molecule('glucide');
        $molecule->addAtom($carbon);
        $molecule->addAtom($oxygen);

        $this->assertEquals('CO', $molecule->getName());
    }

    public function testCanRetrieveMoleculeType(): void
    {
        $molecule = new Molecule('glucide');
        $this->assertEquals('glucide', $molecule->getType());
    }
}