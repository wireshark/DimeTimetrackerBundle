<?php
namespace Dime\TimetrackerBundle\Entity;

use Dime\TimetrackerBundle\Entity\Timeslice;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\SerializerBundle\Annotation\SerializedName;

/**
 * Dime\TimetrackerBundle\Entity\Tag
 *
 * @ORM\Table(name="tags")
 * @ORM\Entity(repositoryClass="Dime\TimetrackerBundle\Entity\TagRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Tag
{
    /**
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $name
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $name;

    /**
     * @var ArrayCollection $activities
     *
     * @SerializedName("activities")
     * @ORM\ManyToMany(targetEntity="Activity")
     * @ORM\JoinTable(name="activity_tag",
     *      joinColumns={@ORM\joincolumn(name="tag_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="activity_id", referencedColumnName="id")}
     * )
     */
    protected $activities;

    /**
     * @var ArrayCollection $timeslices
     *
     * @SerializedName("timeslices")
     * @ORM\ManyToMany(targetEntity="Timeslice")
     * @ORM\JoinTable(name="timeslice_tag",
     *      joinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="timeslice_id", referencedColumnName="id")}
     * )
     */
    protected $timeslices;

    /**
     * Entity constructor
     */
    public function __construct()
    {
        $this->timeslices = new ArrayCollection();
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
     * @param  string   $name
     * @return Tag
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
     * Add activity
     *
     * @param  Activity $activity
     * @return Tag
     */
    public function addActivity(Activity $activity)
    {
        $this->activities[] = $activity;

        return $this;
    }

    /**
     * Get activities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActivities()
    {
        return $this->activities;
    }

    /**
     * Add time slice
     *
     * @param  Timeslice $timeslice
     * @return Tag
     */
    public function addTimeslice(Timeslice $timeslice)
    {
        $this->timeslices[] = $timeslice;

        return $this;
    }

    /**
     * Get time slices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTimeslices()
    {
        return $this->timeslices;
    }

    /**
     * get tag as string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
