<?php
namespace Blog\Repository;

use Blog\Entity\Post;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
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
    /**
     *
     * @var type \Zend\Db\Adapter\Adapter $dbAdapter
     */
    protected $dbAdapter;
    /**
     *
     * @var type \Zend\Db\Adapter\Adapter $dbAdapter
     */
    function getDbAdapter()
    {
        return $this->dbAdapter;
    }
    function setDbAdapter(Adapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }
    /**
     *
     * @param Post $post
     */
    public function save(Post $post)
    {
        $sql = new Sql($this->dbAdapter);
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



}
