<?php

namespace TK\UtilisateurBundle\Entity ;

use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="genre", uniqueConstraints={@ORM\UniqueConstraint(name="lib_genre_UNIQUE", columns={"lib_genre"})})
 * @ORM\Entity
 */
class Genre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_genre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGenre;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_genre", type="string", length=45, nullable=true)
     */
    private $libGenre;



    /**
     * Get idGenre
     *
     * @return integer
     */
    public function getIdGenre()
    {
        return $this->idGenre;
    }

    /**
     * Set libGenre
     *
     * @param string $libGenre
     *
     * @return Genre
     */
    public function setLibGenre($libGenre)
    {
        $this->libGenre = $libGenre;

        return $this;
    }

    /**
     * Get libGenre
     *
     * @return string
     */
    public function getLibGenre()
    {
        return $this->libGenre;
    }
}
