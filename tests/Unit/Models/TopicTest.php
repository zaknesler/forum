<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Topic;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TopicTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function creating_a_topic_generates_a_slug()
    {
        $topic = factory(Topic::class)->create(['title' => 'A Cool Topic!']);

        $this->assertEquals('a-cool-topic', $topic->slug);
    }

    /** @test */
    function creating_topics_with_the_same_title_generates_different_slugs()
    {
        $firstTopic = factory(Topic::class)->create(['title' => 'A Cool Topic!']);
        $secondTopic = factory(Topic::class)->create(['title' => 'A Cool Topic!']);
        $thirdTopic = factory(Topic::class)->create(['title' => 'A Cool Topic!']);

        $this->assertEquals('a-cool-topic', $firstTopic->slug);
        $this->assertEquals('a-cool-topic-1', $secondTopic->slug);
        $this->assertEquals('a-cool-topic-2', $thirdTopic->slug);
    }
}
