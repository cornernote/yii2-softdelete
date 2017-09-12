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
        // delete() must return `false`, because we can't prevent real deletion and return `true` at the same time
        $this->assertFalse($post->delete(), 'Result of `delete()` expected to be `false`');
        $this->assertNotNull($post->deleted_at);
        $post = PostA::findOne(2);
        $this->assertNotNull($post->deleted_at);
    }

    /**
     * Explicit Soft Delete PostA
     */
    public function testExplicitSoftDeletePostA()
    {
        /** @var PostA $post */
        $post = PostA::findOne(2);
        $this->assertTrue($post->softDelete(), 'Result of `softDelete()` expected to be `true`');
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
        // delete() must return `false`, because we can't prevent real deletion and return `true` at the same time
        $this->assertFalse($post->delete(), 'Result of `delete()` expected to be `false`');
        $this->assertNotNull($post->deleted_at);
        $post = PostA::findOne(2);
        $this->assertNotNull($post->deleted_at);
        $this->assertTrue($post->unDelete(), 'Result of `unDelete()` expected to be `true`');
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
        $this->assertTrue($post->hardDelete(), 'Result of `hardDelete()` expected to be `true`');
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
        // delete() must return `false`, because we can't prevent real deletion and return `true` at the same time
        $this->assertFalse($post->delete(), 'Result of `delete()` expected to be `false`');
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
        // delete() must return `false`, because we can't prevent real deletion and return `true` at the same time
        $this->assertFalse($post->delete(), 'Result of `delete()` expected to be `false`');
        $this->assertNotNull($post->deleted_at);
        $post = PostB::findOne(2);
        $this->assertNotNull($post->deleted_at);
        $this->assertTrue($post->unDelete(), 'Result of `unDelete()` expected to be `true`');
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
        $this->assertTrue($post->hardDelete(), 'Result of `hardDelete()` expected to be `true`');
        $post = PostB::findOne(2);
        $this->assertNull($post);
    }
}
