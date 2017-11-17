<?php

namespace TK\AbonnementBundle\Entity ;

use Doctrine\ORM\Mapping as ORM;

/**
 * EtatAbonnement
 *
 * @ORM\Table(name="etat_abonnement", uniqueConstraints={@ORM\UniqueConstraint(name="lib_etat_UNIQUE", columns={"lib_etat_fr"})})
 * @ORM\Entity
 */
class EtatAbonnement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_etat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEtat;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_etat_fr", type="string", length=45, nullable=true)
     */
    private $libEtatFr;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_etat_en", type="string", length=45, nullable=false)
     */
    private $libEtatEn;



    /**
     * Get idEtat
     *
     * @return integer
     */
    public function getIdEtat()
    {
        return $this->idEtat;
    }

    /**
     * Set libEtatFr
     *
     * @param string $libEtatFr
     *
     * @return EtatAbonnement
     */
    public function setLibEtatFr($libEtatFr)
    {
        $this->libEtatFr = $libEtatFr;

        return $this;
    }

    /**
     * Get libEtatFr
     *
     * @return string
     */
    public function getLibEtatFr()
    {
        return $this->libEtatFr;
    }

    /**
     * Set libEtatEn
     *
     * @param string $libEtatEn
     *
     * @return EtatAbonnement
     */
    public function setLibEtatEn($libEtatEn)
    {
        $this->libEtatEn = $libEtatEn;

        return $this;
    }

    /**
     * Get libEtatEn
     *
     * @return string
     */
    public function getLibEtatEn()
    {
        return $this->libEtatEn;
    }
}
