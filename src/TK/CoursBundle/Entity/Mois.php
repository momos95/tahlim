<?php

namespace TK\CoursBundle\Entity ;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mois
 *
 * @ORM\Table(name="mois", uniqueConstraints={@ORM\UniqueConstraint(name="lib_fr_UNIQUE", columns={"lib_fr"}), @ORM\UniqueConstraint(name="lib_ang_UNIQUE", columns={"lib_ang"})})
 * @ORM\Entity
 */
class Mois
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_mois", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMois;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_fr", type="string", length=45, nullable=true)
     */
    private $libFr;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_ang", type="string", length=45, nullable=true)
     */
    private $libAng;



    /**
     * Get idMois
     *
     * @return integer
     */
    public function getIdMois()
    {
        return $this->idMois;
    }

    /**
     * Set libFr
     *
     * @param string $libFr
     *
     * @return Mois
     */
    public function setLibFr($libFr)
    {
        $this->libFr = $libFr;

        return $this;
    }

    /**
     * Get libFr
     *
     * @return string
     */
    public function getLibFr()
    {
        return $this->libFr;
    }

    /**
     * Set libAng
     *
     * @param string $libAng
     *
     * @return Mois
     */
    public function setLibAng($libAng)
    {
        $this->libAng = $libAng;

        return $this;
    }

    /**
     * Get libAng
     *
     * @return string
     */
    public function getLibAng()
    {
        return $this->libAng;
    }
}
