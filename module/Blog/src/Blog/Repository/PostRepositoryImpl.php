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

    public function fetch($page)
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



        // use hydrator to grab the values and populate the category and post objects.
        $hydrator = new AggregateHydrator();
        $hydrator->add(new PostHydrator());
        $hydrator->add(new CategoryHydrator());

        $resultSet = new HydratingResultSet($hydrator, new Post());

        $paginatorAdapter = new \Zend\Paginator\Adapter\DbSelect($sqlSelect, $this->adapter, $resultSet);
        $paginator = new \Zend\Paginator\Paginator($paginatorAdapter);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage(5);

        return $paginator;
    }

}
