<?php
namespace Blog\Repository;

use Blog\Entity\Hydrator\CategoryHydrator;
use Blog\Entity\Hydrator\PostHydrator;
use Blog\Entity\Post;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

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
                        ['category_id' => 'id', 'name', 'category_slug' => 'slug'],
                        $sqlSelect::JOIN_INNER
                );
        $sqlSelect->order('p.id DESC');



        // use hydrator to grab the values and populate the category and post objects.
        $hydrator = new AggregateHydrator();
        $hydrator->add(new PostHydrator());
        $hydrator->add(new CategoryHydrator());

        $resultSet = new HydratingResultSet($hydrator, new Post());

        $paginatorAdapter = new DbSelect($sqlSelect, $this->adapter, $resultSet);
        $paginator = new Paginator($paginatorAdapter);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage(5);

        return $paginator;
    }

    /**
     * Find a specific post with it's specific category.
     *
     * @param type $categorySlug
     * @param type $postSlug
     * @return null|mixed
     */
    public function find($categorySlug, $postSlug)
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
        $sqlSelect->where(array(
            'c.slug' => $categorySlug,
            'p.slug' => $postSlug
        ));

        $stmt = $sql->prepareStatementForSqlObject($sqlSelect);
        $result = $stmt->execute();

        $hydrator = new AggregateHydrator();
        $hydrator->add(new PostHydrator());
        $hydrator->add(new CategoryHydrator());

        $resultSet = new HydratingResultSet($hydrator, new Post()); // populate the new post object
        $resultSet->initialize($result); // initializes the resultset and sets the data source.
        // return the post or return null.
        return ($resultSet->count() > 0) ? $resultSet->current() : null;
    }

    public function findById($postId)
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
        $sqlSelect->where(array(
            'p.id' => $postId
        ));

        $stmt = $sql->prepareStatementForSqlObject($sqlSelect);
        $result = $stmt->execute();

        $hydrator = new AggregateHydrator();
        $hydrator->add(new PostHydrator());
        $hydrator->add(new CategoryHydrator());

        $resultSet = new HydratingResultSet($hydrator, new Post()); // populate the new post object
        $resultSet->initialize($result); // initializes the resultset and sets the data source.
        // return the post or return null.
        return ($resultSet->count() > 0) ? $resultSet->current() : null;
    }

    public function update(Post $post)
    {
        $sql = new Sql($this->adapter);
        $sqlUpdate = $sql->update('post');

        $sqlUpdate->set(array(
            'title' => $post->getTitle(),
            'slug' => $post->getSlug(),
            'content' => $post->getContent(),
            'category_id' => $post->getCategory()->getId(),
        ))->where(array(
            'id' => $post->getId()
        ));

        $stmt = $sql->prepareStatementForSqlObject($sqlUpdate);
        $stmt->execute();
    }

    public function delete(Post $post)
    {
        $sql = new Sql($this->adapter);
        $sqlDelete = $sql->delete();
        $sqlDelete->from('post');
        $sqlDelete->where(['id' => $post->getId()]);
        $d = $sqlDelete->getSqlString();
        $stmt = $sql->prepareStatementForSqlObject($sqlDelete);
        $stmt->execute();
    }

}
