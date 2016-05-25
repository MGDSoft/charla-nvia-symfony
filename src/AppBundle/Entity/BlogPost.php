<?php

namespace AppBundle\Entity;

use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BlogPost
 *
 * @ORM\Table(name="blog_post")
 * @ORM\Entity
 */
class BlogPost
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="20")
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="50", max="8888888888888")
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \AppBundle\Entity\BlogComment
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\BlogComment", mappedBy="post")
     */
    private $comments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return BlogPost
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return BlogPost
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return BlogPost
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
     * Add comment
     *
     * @param \AppBundle\Entity\BlogComment $comment
     *
     * @return BlogPost
     */
    public function addComment(\AppBundle\Entity\BlogComment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \AppBundle\Entity\BlogComment $comment
     */
    public function removeComment(\AppBundle\Entity\BlogComment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection|BlogComment[]
     */
    public function getComments()
    {
        return $this->comments;
    }
}
