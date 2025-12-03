<?php

namespace App\Services;

use App\DTOs\CommentDTO;
use App\Models\Comment;
use App\Models\Listing;
use Illuminate\Support\Facades\DB;

class CommentService
{
    public function createComment(CommentDTO $dto): Comment
    {
        return DB::transaction(function () use ($dto) {
            $comment = Comment::create([
                'user_id' => $dto->userId,
                'listing_id' => $dto->listingId,
                'parent_id' => $dto->parentId,
                'content' => $dto->content,
            ]);

            Listing::where('id', $dto->listingId)->increment('comments_count');

            return $comment->load('user');
        });
    }

    public function deleteComment(Comment $comment): bool
    {
        return DB::transaction(function () use ($comment) {
            $comment->listing()->decrement('comments_count');
            return $comment->delete();
        });
    }
}
