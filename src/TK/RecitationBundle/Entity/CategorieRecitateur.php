<?php

namespace TK\RecitationBundle\Entity ;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieRecitateur
 *
 * @ORM\Table(name="categorie_recitateur")
 * @ORM\Entity
 */
class CategorieRecitateur
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
     * @ORM\Column(name="libelle", type="string", length=25, nullable=false)
     */
    private $libelle;


    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\OneToMany(targetEntity="Recitateur", mappedBy="categorie")
     */

    private $recitateurs;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->recitateurs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return CategorieRecitateur
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Add recitateur
     *
     * @param \TK\RecitationBundle\Entity\Recitateur $recitateur
     *
     * @return CategorieRecitateur
     */
    public function addRecitateur(\TK\RecitationBundle\Entity\Recitateur $recitateur)
    {
        $this->recitateurs[] = $recitateur;

        return $this;
    }

    /**
     * Remove recitateur
     *
     * @param \TK\RecitationBundle\Entity\Recitateur $recitateur
     */
    public function removeRecitateur(\TK\RecitationBundle\Entity\Recitateur $recitateur)
    {
        $this->recitateurs->removeElement($recitateur);
    }

    /**
     * Get recitateurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRecitateurs()
    {
        return $this->recitateurs;
    }
}
