<?php
namespace Blog\Repository;

use Blog\Entity\Hydrator\CategoryHydrator;
use Blog\Entity\Hydrator\PostHydrator;
use Blog\Entity\Post;
use Zend\Db\Sql\Sql;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;

/**
 * Description of PostRepositoryImpl
 *
 * @author ladams
 */
class PostRepositoryImpl implements PostRepository
{
    use \Zend\Db\Adapter\AdapterAwareTrait;
    /**
     *
     * @param Post $post
     */
    public function save(Post $post)
    {
        $sql = new Sql($this->adapter);
        $sqlInsert = $sql->insert();
        $sqlInsert->values([
                'title' => $post->getTitle(),
                'slug' => $post->getSlug(),
                'content' => $post->getContent(),
                'category_id' => $post->getCategory()->getId(),
                'created' => time(),
            ])
            ->into('post');

        // preparing a statement, so we can execute.
        $stmt = $sql->prepareStatementForSqlObject($sqlInsert);
        $stmt->execute();
    }

    public function fetchAll()
    {
        $sql = new Sql($this->adapter);

        $sqlSelect = $sql->select();
        $sqlSelect->from(['p' =>'post']);
        $sqlSelect->columns([
                'id',
                'title',
                'slug',
                'content',
                'created'
            ]);
        $sqlSelect->join(['c' => 'category'],
                        'c.id = p.category_id',
                        ['category_id' => 'id', 'name', 'category_slug' => 'slug']
                );
        $sqlSelect->order('p.id DESC');

        $stmt = $sql->prepareStatementForSqlObject($sqlSelect);
        $result = $stmt->execute();

        // use hydrator to grab the values and populate the category and post objects.
        $hydrator = new AggregateHydrator();
        $hydrator->add(new PostHydrator());
        $hydrator->add(new CategoryHydrator());

        $resultSet = new HydratingResultSet($hydrator, new Post());
        $resultSet->initialize($result);
        $posts = array();

        foreach ($resultSet as $post) {
            /**
             * @var Post $post
             */
            $posts[] = $post;
        }

        return $posts;
    }

}
