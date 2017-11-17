<?php

namespace TK\UtilisateurBundle\Entity ;

use Doctrine\ORM\Mapping as ORM;

/**
 * Grade
 *
 * @ORM\Table(name="grade", uniqueConstraints={@ORM\UniqueConstraint(name="lib_grade_UNIQUE", columns={"lib_grade"})})
 * @ORM\Entity
 */
class Grade
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_grade", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGrade;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_grade", type="string", length=45, nullable=true)
     */
    private $libGrade;



    /**
     * Get idGrade
     *
     * @return integer
     */
    public function getIdGrade()
    {
        return $this->idGrade;
    }

    /**
     * Set libGrade
     *
     * @param string $libGrade
     *
     * @return Grade
     */
    public function setLibGrade($libGrade)
    {
        $this->libGrade = $libGrade;

        return $this;
    }

    /**
     * Get libGrade
     *
     * @return string
     */
    public function getLibGrade()
    {
        return $this->libGrade;
    }
}
