<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Topic;
/*权限*/
class TopicPolicy extends Policy
{
    public function update(User $user, Topic $topic)
    {
        return $topic->user_id === $user->id;
        //return true;
    }

    public function destroy(User $user, Topic $topic)
    {
        return $topic->user_id === $user->id;
    }

}
