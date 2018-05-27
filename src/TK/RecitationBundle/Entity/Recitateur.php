<?php

namespace TK\RecitationBundle\Entity ;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ;

/**
 * Recitateur
 *
 * @ORM\Table(name="recitateur", indexes={@ORM\Index(name="genre", columns={"genre"})})
 * @ORM\Entity(repositoryClass="TK\RecitationBundle\Repository\RecitationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Recitateur
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
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=100, nullable=false)
     */
    private $prenom;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbr_pistes", type="integer", nullable=false)
     */
    private $nbrPistes;

    /**
     * @var string
     *
     * @ORM\Column(name="img_profil", type="string", length=100, nullable=false)
     *
     * @Assert\Image()
     */
    private $imgProfil;

    /**
     * @var \TK\UtilisateurBundle\Entity\Genre
     *
     * @ORM\ManyToOne(targetEntity="TK\UtilisateurBundle\Entity\Genre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="genre", referencedColumnName="id_genre")
     * })
     */
    private $genre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\OneToMany(targetEntity="TK\RecitationBundle\Entity\Sons", mappedBy="recitateur")
     */

    private $sons;

    /**
     * @var \CategorieRecitateur
     *
     * @ORM\ManyToOne(targetEntity="CategorieRecitateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categorie", referencedColumnName="id")
     * })
     */
    private $categorie;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sons = new \Doctrine\Common\Collections\ArrayCollection();
        $this->nbrPistes = 0 ;
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Recitateur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Recitateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nbrPistes
     *
     * @param integer $nbrPistes
     *
     * @return Recitateur
     */
    public function setNbrPistes($nbrPistes)
    {
        $this->nbrPistes = $nbrPistes;

        return $this;
    }

    /**
     * Get nbrPistes
     *
     * @return integer
     */
    public function getNbrPistes()
    {
        return $this->nbrPistes;
    }

    /**
     * Set imgProfil
     *
     * @param string $imgProfil
     *
     * @return Recitateur
     */
    public function setImgProfil($imgProfil)
    {
        $this->imgProfil = $imgProfil;

        return $this;
    }

    /**
     * Get imgProfil
     *
     * @return string
     */
    public function getImgProfil()
    {
        return $this->imgProfil;
    }

    /**
     * Set genre
     *
     * @param \TK\UtilisateurBundle\Entity\Genre $genre
     *
     * @return Recitateur
     */
    public function setGenre(\TK\UtilisateurBundle\Entity\Genre $genre = null)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return \TK\UtilisateurBundle\Entity\Genre
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Add son
     *
     * @param \TK\RecitationBundle\Entity\Sons $son
     *
     * @return Recitateur
     */
    public function addSon(\TK\RecitationBundle\Entity\Sons $son)
    {
        $this->sons[] = $son;
        $this->nbrPistes++ ;
        return $this;
    }

    /**
     * Remove son
     *
     * @param \TK\RecitationBundle\Entity\Sons $son
     */
    public function removeSon(\TK\RecitationBundle\Entity\Sons $son)
    {
        $this->sons->removeElement($son);
        $this->nbrPistes-- ;
    }

    /**
     * Get sons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSons()
    {
        return $this->sons;
    }

    public function getNomPrenom(){
        return $this->getNom() . ' ' . $this->getPrenom() ;
    }

    /**
     * @ORM\PrePersist
     */
    public function setPrettyFirstLastName()
    {
        $this->nom = strtoupper($this->nom) ;
        $this->prenom = ucfirst(strtolower($this->prenom));
    }

    /**
     * Set categorie
     *
     * @param \TK\RecitationBundle\Entity\CategorieRecitateur $categorie
     *
     * @return Recitateur
     */
    public function setCategorie(\TK\RecitationBundle\Entity\CategorieRecitateur $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \TK\RecitationBundle\Entity\CategorieRecitateur
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}
