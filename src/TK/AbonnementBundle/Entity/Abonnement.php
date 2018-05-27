<?php


namespace TK\AbonnementBundle\Entity ;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abonnement
 *
 * @ORM\Table(name="abonnement", indexes={@ORM\Index(name="etat_in_assos_idx", columns={"etat"}), @ORM\Index(name="type", columns={"type"})})
 * @ORM\Entity(repositoryClass="TK\AbonnementBundle\Repository\AbonnementRepository")
 * */
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
    private $debut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="datetime", nullable=false)
     */
    private $fin;

    /**
     * @var \TypeAbonnement
     *
     * @ORM\ManyToOne(targetEntity="TypeAbonnement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type", referencedColumnName="id")
     * })
     */
    private $type;

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
     * @ORM\ManyToMany(targetEntity="\TK\UtilisateurBundle\Entity\Utilisateur", mappedBy="abonnements")
     */
    private $etudiant;

    /**
     * @var \TK\UtilisateurBundle\Entity\Utilisateur
     *
     */
    private $proprietaire;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->etudiant = new \Doctrine\Common\Collections\ArrayCollection();
        $this->debut = new \DateTime() ;
        $this->fin = new \DateTime();
        $this->fin->setTimestamp($this->debut->getTimestamp()+31536000) ;
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
     * Set type
     *
     * @param \TK\AbonnementBundle\Entity\TypeAbonnement $type
     *
     * @return Abonnement
     */
    public function setType(\TK\AbonnementBundle\Entity\TypeAbonnement $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \TK\AbonnementBundle\Entity\TypeAbonnement
     */
    public function getType()
    {
        return $this->type;
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
     * @param \TK\UtilisateurBundle\Entity\Utilisateur $etudiant
     *
     * @return Abonnement
     */
    public function addEtudiant(\TK\UtilisateurBundle\Entity\Utilisateur $etudiant)
    {
        $this->etudiant[] = $etudiant;

        return $this;
    }

    /**
     * Remove etudiant
     *
     * @param \TK\UtilisateurBundle\Entity\Utilisateur $etudiant
     */
    public function removeEtudiant(\TK\UtilisateurBundle\Entity\Utilisateur $etudiant)
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

    public function getOwner(){
        return $this->etudiant[0] ;
    }

    /**
     * @return \TK\UtilisateurBundle\Entity\Utilisateur
     */
    public function getProprietaire()
    {
        return $this->proprietaire;
    }

    /**
     * @param \TK\UtilisateurBundle\Entity\Utilisateur $proprietaire
     */
    public function setProprietaire($proprietaire)
    {
        $this->proprietaire = $proprietaire;
    }
}
