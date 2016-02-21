<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-21
 * Time: 下午3:49
 */

namespace AGarage\Site\Entity\Blog;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class BlogComment
 * @package AGarage\Site\Entity\Blog
 * @ORM\Entity
 * @ORM\Table(name="blog_comment")
 */
class BlogComment
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var BlogArticle
     * @ORM\ManyToOne(targetEntity="AGarage\Site\Entity\Blog\BlogArticle", inversedBy="comments")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     */
    protected $article;

    /**
     * @var BlogComment
     * @ORM\ManyToOne(targetEntity="BlogComment", inversedBy="follows")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $parent;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="BlogComment", mappedBy="parent")
     */
    protected $follows;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    protected $title;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    protected $content;

    /**
     * @var int
     * @ORM\Column(type="datetime")
     */
    protected $create_time;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->follows = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return BlogComment
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
     * @return BlogComment
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
     * Set createTime
     *
     * @param \DateTime $createTime
     *
     * @return BlogComment
     */
    public function setCreateTime($createTime)
    {
        $this->create_time = $createTime;

        return $this;
    }

    /**
     * Get createTime
     *
     * @return \DateTime
     */
    public function getCreateTime()
    {
        return $this->create_time;
    }

    /**
     * Set article
     *
     * @param \AGarage\Site\Entity\Blog\BlogArticle $article
     *
     * @return BlogComment
     */
    public function setArticle(\AGarage\Site\Entity\Blog\BlogArticle $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \AGarage\Site\Entity\Blog\BlogArticle
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set parent
     *
     * @param \AGarage\Site\Entity\Blog\BlogComment $parent
     *
     * @return BlogComment
     */
    public function setParent(\AGarage\Site\Entity\Blog\BlogComment $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AGarage\Site\Entity\Blog\BlogComment
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add follow
     *
     * @param \AGarage\Site\Entity\Blog\BlogComment $follow
     *
     * @return BlogComment
     */
    public function addFollow(\AGarage\Site\Entity\Blog\BlogComment $follow)
    {
        $this->follows[] = $follow;

        return $this;
    }

    /**
     * Remove follow
     *
     * @param \AGarage\Site\Entity\Blog\BlogComment $follow
     */
    public function removeFollow(\AGarage\Site\Entity\Blog\BlogComment $follow)
    {
        $this->follows->removeElement($follow);
    }

    /**
     * Get follows
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFollows()
    {
        return $this->follows;
    }
}
