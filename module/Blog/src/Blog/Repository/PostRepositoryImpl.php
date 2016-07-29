<?php
namespace Blog\Repository;

use Blog\Entity\Post;
use Zend\Db\Sql\Sql;
use Zend\Hydrator\Aggregate\AggregateHydrator;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
                'category_id' => $post->getCategory(),
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
        $stmt->execute();

        // use hydrator to grab the values and populate the category and post objects.
        $hydrator = new AggregateHydrator();
    }

}
