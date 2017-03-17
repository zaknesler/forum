<?php

namespace App\Transformers;

use App\Models\Topic;
use App\Transformers\UserTransformer;
use League\Fractal\TransformerAbstract;

class TopicTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Topic $topic)
    {
        return [
            'id' => $topic->id,
            'title' => $topic->title,
            'slug' => $topic->slug,
            'body' => $topic->body,
            'uri' => '/topics/' . $topic->slug,
            'created_at' => $topic->created_at->toDateTimeString(),
            'created_at_human' => $topic->created_at->diffForHumans(),
            'user' => fractal($topic->user, new UserTransformer),
        ];
    }
}
