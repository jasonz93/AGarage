<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-21
 * Time: 下午2:33
 */

namespace AGarage\Site\Entity\Blog;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class BlogTopic
 * @package AGarage\Site\Entity\Blog
 * @ORM\Entity()
 * @ORM\Table(name="blog_topic")
 */
class BlogTopic
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="AGarage\Site\Entity\Blog\BlogArticle", mappedBy="topics")
     */
    protected $articles;

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
     * @return BlogTopic
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
     * Constructor
     */
    public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add article
     *
     * @param BlogArticle $article
     *
     * @return BlogTopic
     */
    public function addArticle(\AGarage\Site\Entity\Blog\BlogArticle $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param BlogArticle $article
     */
    public function removeArticle(\AGarage\Site\Entity\Blog\BlogArticle $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }
}
