<?php

namespace TK\MediaBundle\Entity ;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ;

/**
 * Media
 *
 * @ORM\Table(name="media", indexes={@ORM\Index(name="type", columns={"type", "categorie", "auteur"}), @ORM\Index(name="media_from_categorie", columns={"categorie"}), @ORM\Index(name="media_by_auteur", columns={"auteur"}), @ORM\Index(name="IDX_6A2CA10C8CDE5729", columns={"type"})})
 * @ORM\Entity(repositoryClass="TK\MediaBundle\Repository\MediaRepository")
 */
class Media
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
     * @ORM\Column(name="titre",  type="string", length=100, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="fichier", type="string", length=150, nullable=false)
     * @Assert\File(
     *     mimeTypes={"video/mp4"},
     *     mimeTypesMessage = "Veuillez vérifier l'extension de votre fichier."
     * )
     */
    private $fichier;

    /**
     * @var \TK\UtilisateurBundle\Entity\Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="TK\UtilisateurBundle\Entity\Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="auteur", referencedColumnName="id")
     * })
     */
    private $auteur;

    /**
     * @var \CategorieMedia
     *
     * @ORM\ManyToOne(targetEntity="CategorieMedia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categorie", referencedColumnName="id")
     * })
     */
    private $categorie;

    /**
     * @var \TypeMedia
     *
     * @ORM\ManyToOne(targetEntity="TypeMedia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type", referencedColumnName="id")
     * })
     */
    private $type;



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
     * @param integer $titre
     *
     * @return Media
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return integer
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
     * @return Media
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
     * Set auteur
     *
     * @param \TK\UtilisateurBundle\Entity\Utilisateur $auteur
     *
     * @return Media
     */
    public function setAuteur(\TK\UtilisateurBundle\Entity\Utilisateur $auteur = null)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return \TK\UtilisateurBundle\Entity\Utilisateur
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set categorie
     *
     * @param \TK\MediaBundle\Entity\CategorieMedia $categorie
     *
     * @return Media
     */
    public function setCategorie(\TK\MediaBundle\Entity\CategorieMedia $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \TK\MediaBundle\Entity\CategorieMedia
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set type
     *
     * @param \TK\MediaBundle\Entity\TypeMedia $type
     *
     * @return Media
     */
    public function setType(\TK\MediaBundle\Entity\TypeMedia $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \TK\MediaBundle\Entity\TypeMedia
     */
    public function getType()
    {
        return $this->type;
    }
}
