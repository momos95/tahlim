<?php

namespace TK\RecitationBundle\Entity ;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ;

/**
 * Sons
 *
 * @ORM\Table(name="sons")
 * @ORM\Entity
 */
class Sons
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=100, nullable=false)
     */
    private $titre;


    /**
     * @var string
     *
     * @ORM\Column(name="fichier", type="string", length=100, nullable=false)
     * @Assert\File(
     *     mimeTypes={"audio/mpeg"},
     *     mimeTypesMessage = "Veuillez vérifier l'extension de votre fichier."
     * )
     */
    private $fichier;



    /**
     * @var \TK\RecitationBundle\Entity\Recitateur
     * @ORM\ManyToOne(targetEntity="TK\RecitationBundle\Entity\Recitateur", inversedBy="sons")
     * @ORM\JoinColumn(nullable=true)
     */

    private $recitateur;

    /**
     * Constructor
     */
    public function __construct()
    {
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Sons
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set fichier
     *
     * @param string $fichier
     *
     * @return Sons
     */
    public function setFichier($fichier)
    {
        $this->fichier = $fichier;

        return $this;
    }

    /**
     * Get fichier
     *
     * @return string
     */
    public function getFichier()
    {
        return $this->fichier;
    }

    /**
     * Set recitateur
     *
     * @param \TK\RecitationBundle\Entity\Recitateur $recitateur
     *
     * @return Sons
     */
    public function setRecitateur(\TK\RecitationBundle\Entity\Recitateur $recitateur = null)
    {
        $this->recitateur = $recitateur;

        return $this;
    }

    /**
     * Get recitateur
     *
     * @return \TK\RecitationBundle\Entity\Recitateur
     */
    public function getRecitateur()
    {
        return $this->recitateur;
    }
}
