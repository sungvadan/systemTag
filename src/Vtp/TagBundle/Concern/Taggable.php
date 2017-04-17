<?php
namespace Vtp\TagBundle\Concern;

trait Taggable
{
    /**
     * @ORM\ManyToMany(targetEntity="Vtp\TagBundle\Entity\Tag", cascade={"persist"})
     */
    private $tags;


    /**
     * Add tag
     *
     * @param \Vtp\TagBundle\Entity\Tag $tag
     *
     * @return Post
     */
    public function addTag(\Vtp\TagBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \Vtp\TagBundle\Entity\Tag $tag
     */
    public function removeTag(\Vtp\TagBundle\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

}