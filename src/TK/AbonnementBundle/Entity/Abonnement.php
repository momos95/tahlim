<?php

namespace TK\AbonnementBundle\Entity ;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abonnement
 *
 * @ORM\Table(name="abonnement", indexes={@ORM\Index(name="etat_in_assos_idx", columns={"etat"})})
 * @ORM\Entity(repositoryClass="TK\AbonnementBundle\Repository\AbonnementRepository")
 */
class Abonnement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_abonnement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAbonnement;

    /**
     * @var string
     *
     * @ORM\Column(name="cle_abonnement", type="string", length=100, nullable=true)
     */
    private $cleAbonnement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut", type="datetime", nullable=false)
     */
    private $debut ;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="datetime", nullable=false)
     */
    private $fin = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="string", length=45, nullable=true)
     */
    private $prix;

    /**
     * @var \EtatAbonnement
     *
     * @ORM\ManyToOne(targetEntity="EtatAbonnement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="etat", referencedColumnName="id_etat")
     * })
     */
    private $etat;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Utilisateur", mappedBy="abonnements")
     */
    private $etudiant;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->etudiant = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idAbonnement
     *
     * @return integer
     */
    public function getIdAbonnement()
    {
        return $this->idAbonnement;
    }

    /**
     * Set cleAbonnement
     *
     * @param string $cleAbonnement
     *
     * @return Abonnement
     */
    public function setCleAbonnement($cleAbonnement)
    {
        $this->cleAbonnement = $cleAbonnement;

        return $this;
    }

    /**
     * Get cleAbonnement
     *
     * @return string
     */
    public function getCleAbonnement()
    {
        return $this->cleAbonnement;
    }

    /**
     * Set debut
     *
     * @param \DateTime $debut
     *
     * @return Abonnement
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut
     *
     * @return \DateTime
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     *
     * @return Abonnement
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set prix
     *
     * @param string $prix
     *
     * @return Abonnement
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set etat
     *
     * @param \TK\AbonnementBundle\Entity\EtatAbonnement $etat
     *
     * @return Abonnement
     */
    public function setEtat(\TK\AbonnementBundle\Entity\EtatAbonnement $etat = null)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return \TK\AbonnementBundle\Entity\EtatAbonnement
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Add etudiant
     *
     * @param \TK\AbonnementBundle\Entity\Utilisateur $etudiant
     *
     * @return Abonnement
     */
    public function addEtudiant(\TK\AbonnementBundle\Entity\Utilisateur $etudiant)
    {
        $this->etudiant[] = $etudiant;

        return $this;
    }

    /**
     * Remove etudiant
     *
     * @param \TK\AbonnementBundle\Entity\Utilisateur $etudiant
     */
    public function removeEtudiant(\TK\AbonnementBundle\Entity\Utilisateur $etudiant)
    {
        $this->etudiant->removeElement($etudiant);
    }

    /**
     * Get etudiant
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtudiant()
    {
        return $this->etudiant;
    }
}
