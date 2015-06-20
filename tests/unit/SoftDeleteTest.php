<?php
/**
 * SoftDeleteTest.php
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @link https://mrphp.com.au/
 */

namespace tests;

use tests\models\PostA;
use tests\models\PostB;
use Yii;

/**
 * SoftDeleteTest
 */
class SoftDeleteTest extends DatabaseTestCase
{

    /**
     * Soft Delete PostA
     */
    public function testSoftDeletePostA()
    {
        /** @var PostA $post */
        $post = PostA::findOne(2);
        $post->delete();
        $this->assertNotNull($post->deleted_at);
        $post = PostA::findOne(2);
        $this->assertNotNull($post->deleted_at);
    }

    /**
     * Soft Un-Delete PostA
     */
    public function testUnDeletePostA()
    {
        /** @var PostA $post */
        $post = PostA::findOne(2);
        $post->delete();
        $this->assertNotNull($post->deleted_at);
        $post = PostA::findOne(2);
        $this->assertNotNull($post->deleted_at);
        $post->unDelete();
        $this->assertNull($post->deleted_at);
        $post = PostA::findOne(2);
        $this->assertNull($post->deleted_at);
    }

    /**
     * Hard Delete PostA
     */
    public function testHardDeletePostA()
    {
        /** @var PostA $post */
        $post = PostA::findOne(2);
        $post->hardDelete();
        $post = PostA::findOne(2);
        $this->assertNull($post);
    }

    /**
     * Soft Delete PostB
     */
    public function testSoftDeletePostB()
    {
        /** @var PostB $post */
        $post = PostB::findOne(2);
        $post->delete();
        $this->assertNotNull($post->deleted_at);
        $post = PostB::findOne(2);
        $this->assertNotNull($post->deleted_at);
    }

    /**
     * Soft Un-Delete PostB
     */
    public function testUnDeletePostB()
    {
        /** @var PostB $post */
        $post = PostB::findOne(2);
        $post->delete();
        $this->assertNotNull($post->deleted_at);
        $post = PostB::findOne(2);
        $this->assertNotNull($post->deleted_at);
        $post->unDelete();
        $this->assertNull($post->deleted_at);
        $post = PostB::findOne(2);
        $this->assertNull($post->deleted_at);
    }

    /**
     * Hard Delete PostB
     */
    public function testHardDeletePostB()
    {
        /** @var PostB $post */
        $post = PostB::findOne(2);
        $post->hardDelete();
        $post = PostB::findOne(2);
        $this->assertNull($post);
    }

}