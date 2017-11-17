<?php

namespace TK\UtilisateurBundle\Entity ;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pays
 *
 * @ORM\Table(name="pays")
 * @ORM\Entity
 */
class Pays
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_pays", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPays;

    /**
     * @var integer
     *
     * @ORM\Column(name="code", type="integer", nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="alpha2", type="string", length=2, nullable=false)
     */
    private $alpha2;

    /**
     * @var string
     *
     * @ORM\Column(name="alpha3", type="string", length=3, nullable=false)
     */
    private $alpha3;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_en", type="string", length=45, nullable=false)
     */
    private $libEn;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_fr", type="string", length=45, nullable=false)
     */
    private $libFr;



    /**
     * Get idPays
     *
     * @return integer
     */
    public function getIdPays()
    {
        return $this->idPays;
    }

    /**
     * Set code
     *
     * @param integer $code
     *
     * @return Pays
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set alpha2
     *
     * @param string $alpha2
     *
     * @return Pays
     */
    public function setAlpha2($alpha2)
    {
        $this->alpha2 = $alpha2;

        return $this;
    }

    /**
     * Get alpha2
     *
     * @return string
     */
    public function getAlpha2()
    {
        return $this->alpha2;
    }

    /**
     * Set alpha3
     *
     * @param string $alpha3
     *
     * @return Pays
     */
    public function setAlpha3($alpha3)
    {
        $this->alpha3 = $alpha3;

        return $this;
    }

    /**
     * Get alpha3
     *
     * @return string
     */
    public function getAlpha3()
    {
        return $this->alpha3;
    }

    /**
     * Set libEn
     *
     * @param string $libEn
     *
     * @return Pays
     */
    public function setLibEn($libEn)
    {
        $this->libEn = $libEn;

        return $this;
    }

    /**
     * Get libEn
     *
     * @return string
     */
    public function getLibEn()
    {
        return $this->libEn;
    }

    /**
     * Set libFr
     *
     * @param string $libFr
     *
     * @return Pays
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
}
