<?php

namespace TK\UtilisateurBundle\Entity ;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur", indexes={@ORM\Index(name="grade_in_assos_idx", columns={"role"}), @ORM\Index(name="etat_abon_in_assos_idx", columns={"abonnement_etat"}), @ORM\Index(name="genre_in_assos_idx", columns={"sexe"}), @ORM\Index(name="pays_in_assos_idx", columns={"pays"})})
 * @ORM\Entity(repositoryClass="TK\UtilisateurBundle\Repository\UtilisateurRepository")
 */
class Utilisateur implements UserInterface
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
     * @ORM\Column(name="nom", type="string", length=150, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=150, nullable=false)
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="datetime", nullable=true)
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     *
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */

    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=250, nullable=false)
     */
    private $mdp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_inscription", type="datetime", nullable=true)
     */
    private $dateInscription = 'CURRENT_TIMESTAMP';

    /**
     * @var \TK\AbonnementBundle\Entity\EtatAbonnement
     *
     * @ORM\ManyToOne(targetEntity="\TK\AbonnementBundle\Entity\EtatAbonnement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="abonnement_etat", referencedColumnName="id_etat")
     * })
     */
    private $abonnementEtat;

    /**
     * @var \Genre
     *
     * @ORM\ManyToOne(targetEntity="Genre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sexe", referencedColumnName="id_genre")
     * })
     */
    private $sexe;

    /**
     * @var \Grade
     *
     * @ORM\ManyToOne(targetEntity="Grade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role", referencedColumnName="id_grade")
     * })
     */
    private $role;

    /**
     * @var \Pays
     *
     * @ORM\ManyToOne(targetEntity="Pays")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pays", referencedColumnName="id_pays")
     * })
     */
    private $pays;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="\TK\AbonnementBundle\Entity\Abonnement", inversedBy="etudiant")
     * @ORM\JoinTable(name="etudiants_abonnements",
     *   joinColumns={
     *     @ORM\JoinColumn(name="etudiant", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="abonnements", referencedColumnName="id_abonnement")
     *   }
     * )
     */
    private $abonnements;


    /**
     * array of roles
     */
    private $roles ;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->abonnements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dateNaissance = new \DateTime() ;
        $this->dateInscription = new \DateTime() ;
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
     * @return Utilisateur
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
     * @return Utilisateur
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
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Utilisateur
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Utilisateur
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set mdp
     *
     * @param string $mdp
     *
     * @return Utilisateur
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get mdp
     *
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set dateInscription
     *
     * @param \DateTime $dateInscription
     *
     * @return Utilisateur
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * Get dateInscription
     *
     * @return \DateTime
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * Set abonnementEtat
     *
     * @param \TK\AbonnementBundle\Entity\EtatAbonnement $abonnementEtat
     *
     * @return Utilisateur
     */
    public function setAbonnementEtat(\TK\AbonnementBundle\Entity\EtatAbonnement $abonnementEtat = null)
    {
        $this->abonnementEtat = $abonnementEtat;

        return $this;
    }

    /**
     * Get abonnementEtat
     *
     * @return \TK\AbonnementBundle\Entity\EtatAbonnement
     */
    public function getAbonnementEtat()
    {
        return $this->abonnementEtat;
    }

    /**
     * Set sexe
     *
     * @param \TK\UtilisateurBundle\Entity\Genre $sexe
     *
     * @return Utilisateur
     */
    public function setSexe(\TK\UtilisateurBundle\Entity\Genre $sexe = null)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return \TK\UtilisateurBundle\Entity\Genre
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set role
     *
     * @param \TK\UtilisateurBundle\Entity\Grade $role
     *
     * @return Utilisateur
     */
    public function setRole(\TK\UtilisateurBundle\Entity\Grade $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \TK\UtilisateurBundle\Entity\Grade
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set pays
     *
     * @param \TK\UtilisateurBundle\Entity\Pays $pays
     *
     * @return Utilisateur
     */
    public function setPays(\TK\UtilisateurBundle\Entity\Pays $pays = null)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return \TK\UtilisateurBundle\Entity\Pays
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Add abonnement
     *
     * @param \TK\AbonnementBundle\Entity\Abonnement $abonnement
     *
     * @return Utilisateur
     */
    public function addAbonnement(\TK\AbonnementBundle\Entity\Abonnement $abonnement)
    {
        $this->abonnements[] = $abonnement;

        return $this;
    }

    /**
     * Remove abonnement
     *
     * @param \TK\AbonnementBundle\Entity\Abonnement $abonnement
     */
    public function removeAbonnement(\TK\AbonnementBundle\Entity\Abonnement $abonnement)
    {
        $this->abonnements->removeElement($abonnement);
    }

    /**
     * Get abonnements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAbonnements()
    {
        return $this->abonnements;
    }

    public function getRoles()
    {
        return array($this->role->getLibGrade()) ;
    }

    public function setRoles(array $roles){
        $this->roles = $roles ;
    }

    public function getPassword()
    {
        return $this->getMdp() ;
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        return $this->getEmail();
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function has_role($roles){

    }

}
