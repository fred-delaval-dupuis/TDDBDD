<?php
/**
 * Created by PhpStorm.
 * User: Etudiant0
 * Date: 19/07/2018
 * Time: 12:40
 */

namespace App\Entity;


class Atom
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $symbol;

    /**
     * Atom constructor.
     * @param string $name
     * @param string $symbol
     */
    public function __construct(string $name, string $symbol)
    {
        $this->name = $name;
        if (\strlen($symbol) > 2) {
            throw new \LengthException(sprintf(
                'Le symbole %s n\'est pas valide',
                $symbol
            ));
        }
        $this->symbol = $symbol;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }
}