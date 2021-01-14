<?php

namespace App\Traits;

use App\Comment;

trait CommentsTrait{
    protected function saveComment(array $data){

        $temp['user_id']    = auth()->user()->id;
        $temp['user_guard'] = userGuardCheck();
        $temp['ticket_id']  = $data['ticket_id'];
        $temp['comment'] = $data['comment'];
        $temp['type'] = $data['type'] ?? 0;

        $comment = Comment::updateOrCreate(['id' => $data['id'] ?? null], $temp);

        if (isset($data['comment_attachment'])){
            storeMediaFile($comment, $data['comment_attachment'], 'comment_attachment');
        }

        return response()->json(['status' => true,'message' => _t(__('message.supportTickets.comment_message'))]);
    }
}
