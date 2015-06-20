<?php
/**
 * SoftDeleteQueryTest.php
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @link https://mrphp.com.au/
 */

namespace tests;

use tests\models\PostA;
use Yii;

/**
 * SoftDeleteQueryTest
 */
class SoftDeleteQueryTest extends DatabaseTestCase
{

    /**
     * Find Deleted Posts
     */
    public function testFindDeletedPosts()
    {
        $data = [];
        $posts = PostA::find()->deleted()->all();
        foreach ($posts as $post) {
            $data[] = $post->toArray();
        }
        $this->assertEquals(require(__DIR__ . '/data/test-find-deleted-posts.php'), $data);
    }

    /**
     * Find Not Deleted Posts
     */
    public function testFindNotDeletedPosts()
    {
        $data = [];
        $posts = PostA::find()->notDeleted()->all();
        foreach ($posts as $post) {
            $data[] = $post->toArray();
        }
        $this->assertEquals(require(__DIR__ . '/data/test-find-not-deleted-posts.php'), $data);
    }

}