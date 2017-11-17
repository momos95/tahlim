<?php

namespace TK\CoursBundle\Entity ;

use Doctrine\ORM\Mapping as ORM;

/**
 * Format
 *
 * @ORM\Table(name="format", uniqueConstraints={@ORM\UniqueConstraint(name="lib_format_UNIQUE", columns={"lib_format"})})
 * @ORM\Entity
 */
class Format
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_format", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFormat;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_format", type="string", length=45, nullable=true)
     */
    private $libFormat;



    /**
     * Get idFormat
     *
     * @return integer
     */
    public function getIdFormat()
    {
        return $this->idFormat;
    }

    /**
     * Set libFormat
     *
     * @param string $libFormat
     *
     * @return Format
     */
    public function setLibFormat($libFormat)
    {
        $this->libFormat = $libFormat;

        return $this;
    }

    /**
     * Get libFormat
     *
     * @return string
     */
    public function getLibFormat()
    {
        return $this->libFormat;
    }
}
