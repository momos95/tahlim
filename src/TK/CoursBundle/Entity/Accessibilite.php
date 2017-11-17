<?php

namespace TK\CoursBundle\Entity ;

use Doctrine\ORM\Mapping as ORM;

/**
 * Accessibilite
 *
 * @ORM\Table(name="accessibilite", uniqueConstraints={@ORM\UniqueConstraint(name="lib_accessibilite_UNIQUE", columns={"lib_accessibilite"})})
 * @ORM\Entity
 */
class Accessibilite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_accessibilite", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAccessibilite;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_accessibilite", type="string", length=45, nullable=true)
     */
    private $libAccessibilite;



    /**
     * Get idAccessibilite
     *
     * @return integer
     */
    public function getIdAccessibilite()
    {
        return $this->idAccessibilite;
    }

    /**
     * Set libAccessibilite
     *
     * @param string $libAccessibilite
     *
     * @return Accessibilite
     */
    public function setLibAccessibilite($libAccessibilite)
    {
        $this->libAccessibilite = $libAccessibilite;

        return $this;
    }

    /**
     * Get libAccessibilite
     *
     * @return string
     */
    public function getLibAccessibilite()
    {
        return $this->libAccessibilite;
    }
}
