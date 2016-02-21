<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-21
 * Time: 下午3:22
 */

namespace AGarage\Site\Entity\Blog;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class BlogArticle
 * @package AGarage\Site\Entity\Blog
 * @ORM\Entity()
 * @ORM\Table(name="blog_article")
 */
class BlogArticle
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="AGarage\Site\Entity\Blog\BlogTopic", inversedBy="articles")
     * @ORM\JoinTable(name="blog_articles_topics")
     */
    protected $topics;

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
     * @var Collection
     * @ORM\OneToMany(targetEntity="AGarage\Site\Entity\Blog\BlogComment", mappedBy="article")
     */
    protected $comments;

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
     * @return BlogArticle
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
     * @return BlogArticle
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
     * @param integer $createTime
     *
     * @return BlogArticle
     */
    public function setCreateTime($createTime)
    {
        $this->create_time = $createTime;

        return $this;
    }

    /**
     * Get createTime
     *
     * @return integer
     */
    public function getCreateTime()
    {
        return $this->create_time;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->topics = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add topic
     *
     * @param \AGarage\Site\Entity\Blog\BlogTopic $topic
     *
     * @return BlogArticle
     */
    public function addTopic(\AGarage\Site\Entity\Blog\BlogTopic $topic)
    {
        $this->topics[] = $topic;

        return $this;
    }

    /**
     * Remove topic
     *
     * @param \AGarage\Site\Entity\Blog\BlogTopic $topic
     */
    public function removeTopic(\AGarage\Site\Entity\Blog\BlogTopic $topic)
    {
        $this->topics->removeElement($topic);
    }

    /**
     * Get topics
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTopics()
    {
        return $this->topics;
    }

    /**
     * Add comment
     *
     * @param \AGarage\Site\Entity\Blog\BlogComment $comment
     *
     * @return BlogArticle
     */
    public function addComment(\AGarage\Site\Entity\Blog\BlogComment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \AGarage\Site\Entity\Blog\BlogComment $comment
     */
    public function removeComment(\AGarage\Site\Entity\Blog\BlogComment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }
}
