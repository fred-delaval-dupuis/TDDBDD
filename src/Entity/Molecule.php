<?php
/**
 * Created by PhpStorm.
 * User: Etudiant0
 * Date: 19/07/2018
 * Time: 14:41
 */

namespace App\Entity;


class Molecule
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var Atom[]
     */
    private $atoms;

    /**
     * @var string
     */
    private $name;

    /**
     * Molecule constructor.
     * @param string $type
     */
    public function __construct(string $type)
    {
        $this->type = $type;
        $this->atoms = [];
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return Atom[]
     */
    public function getAtoms(): array
    {
        return $this->atoms;
    }

    public function addAtom(Atom $atom): self
    {
        $this->atoms[] = $atom;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        if (null === $this->name) {
            $this->merge();
        }

        return $this->name;
    }

    public function merge(): void
    {
        if (\count($this->atoms) < 2) {
            throw new \LogicException('Une molécule doit contenir au moins 2 atomes');
        }

        $this->name = '';

        foreach ($this->atoms as $atom) {
            $this->name .= $atom->getSymbol();
        }
    }
}