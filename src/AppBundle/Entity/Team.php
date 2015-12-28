<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TeamRepository")
 */
class Team
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @ORM\OneToOne(targetEntity="Country", inversedBy="team")
     */
    protected $country;

    /**
     * @ORM\OneToMany(targetEntity="Player", mappedBy="team")
     */
    protected $players;

    /**
     * @ORM\OneToMany(targetEntity="Coach", mappedBy="team")
     */
    protected $coaches;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->coaches = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Team
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Team
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
     * Set country
     *
     * @param Country $country
     *
     * @return Team
     */
    public function setCountry(Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Add player
     *
     * @param Player $player
     *
     * @return Team
     */
    public function addPlayer(Player $player)
    {
        $this->players[] = $player;

        return $this;
    }

    /**
     * Remove player
     *
     * @param Player $player
     */
    public function removePlayer(Player $player)
    {
        $this->players->removeElement($player);
    }

    /**
     * Get players
     *
     * @return Collection
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Add coach
     *
     * @param Coach $coach
     *
     * @return Team
     */
    public function addCoach(Coach $coach)
    {
        $this->coaches[] = $coach;

        return $this;
    }

    /**
     * Remove coach
     *
     * @param Coach $coach
     */
    public function removeCoach(Coach $coach)
    {
        $this->coaches->removeElement($coach);
    }

    /**
     * Get coaches
     *
     * @return Collection
     */
    public function getCoaches()
    {
        return $this->coaches;
    }
}
