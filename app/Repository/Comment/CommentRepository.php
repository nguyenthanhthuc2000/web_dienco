<?php
namespace App\Repository\Comment;

use App\Models\Comment;
use App\Repository\BaseRepository;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        $m = new Comment();
        return $m;
    }

}
