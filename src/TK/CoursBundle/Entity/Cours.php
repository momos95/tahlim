<?php

namespace TK\CoursBundle\Entity ;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ;

/**
 * Cours
 *
 * @ORM\Table(name="cours", indexes={@ORM\Index(name="format_in_assos_idx", columns={"format"}), @ORM\Index(name="mois_in_assos_idx", columns={"mois"}), @ORM\Index(name="acces_in_assos_idx", columns={"acces"}), @ORM\Index(name="ajoute_par", columns={"ajoute_par"}), @ORM\Index(name="theme", columns={"theme"})})
 * @ORM\Entity(repositoryClass="TK\CoursBundle\Repository\CoursRepository")
 */
class Cours
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_cours", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCours;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=75, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="annee", type="string", length=10, nullable=true)
     */
    private $annee;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ajout", type="datetime", nullable=true)
     */
    private $dateAjout;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=100, nullable=true)
     * @Assert\File(mimeTypes={"application/pdf"})
     */
    private $file;

    /**
     * @var \Theme
     *
     * @ORM\ManyToOne(targetEntity="Theme")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="theme", referencedColumnName="id")
     * })
     */
    private $theme;

    /**
     * @var \Accessibilite
     *
     * @ORM\ManyToOne(targetEntity="Accessibilite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="acces", referencedColumnName="id_accessibilite")
     * })
     */
    private $acces;

    /**
     * @var \TK\UtilisateurBundle\Entity\Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="TK\UtilisateurBundle\Entity\Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ajoute_par", referencedColumnName="id")
     * })
     */
    private $ajoutePar;

    /**
     * @var \Format
     *
     * @ORM\ManyToOne(targetEntity="Format")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="format", referencedColumnName="id_format")
     * })
     */
    private $format;

    /**
     * @var \Mois
     *
     * @ORM\ManyToOne(targetEntity="Mois")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mois", referencedColumnName="id_mois")
     * })
     */
    private $mois;


    public function __construct()
    {
        $this->dateAjout = new \DateTime() ;
        $this->annee = date('Y') ;
    }


    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Cours
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
     * Set description
     *
     * @param string $description
     *
     * @return Cours
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set annee
     *
     * @param string $annee
     *
     * @return Cours
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return string
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     *
     * @return Cours
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    /**
     * Get dateAjout
     *
     * @return \DateTime
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * Set file
     *
     * @param string $file
     *
     * @return Cours
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Get idCours
     *
     * @return integer
     */
    public function getIdCours()
    {
        return $this->idCours;
    }

    /**
     * Set mois
     *
     * @param \TK\CoursBundle\Entity\Mois $mois
     *
     * @return Cours
     */
    public function setMois(\TK\CoursBundle\Entity\Mois $mois = null)
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * Get mois
     *
     * @return \TK\CoursBundle\Entity\Mois
     */
    public function getMois()
    {
        return $this->mois;
    }

    /**
     * Set format
     *
     * @param \TK\CoursBundle\Entity\Format $format
     *
     * @return Cours
     */
    public function setFormat(\TK\CoursBundle\Entity\Format $format = null)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Get format
     *
     * @return \TK\CoursBundle\Entity\Format
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set ajoutePar
     *
     * @param \TK\UtilisateurBundle\Entity\Utilisateur $ajoutePar
     *
     * @return Cours
     */
    public function setAjoutePar(\TK\UtilisateurBundle\Entity\Utilisateur $ajoutePar = null)
    {
        $this->ajoutePar = $ajoutePar;

        return $this;
    }

    /**
     * Get ajoutePar
     *
     * @return \TK\UtilisateurBundle\Entity\Utilisateur
     */
    public function getAjoutePar()
    {
        return $this->ajoutePar;
    }

    /**
     * Set acces
     *
     * @param \TK\CoursBundle\Entity\Accessibilite $acces
     *
     * @return Cours
     */
    public function setAcces(\TK\CoursBundle\Entity\Accessibilite $acces = null)
    {
        $this->acces = $acces;

        return $this;
    }

    /**
     * Get acces
     *
     * @return \TK\CoursBundle\Entity\Accessibilite
     */
    public function getAcces()
    {
        return $this->acces;
    }

    /**
     * Set theme
     *
     * @param \TK\CoursBundle\Entity\Theme $theme
     *
     * @return Cours
     */
    public function setTheme(\TK\CoursBundle\Entity\Theme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \TK\CoursBundle\Entity\Theme
     */
    public function getTheme()
    {
        return $this->theme;
    }
}
