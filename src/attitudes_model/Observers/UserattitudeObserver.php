<?php
namespace App\Models\Observers;

use App\Models\Userattitude;

class UserattitudeObserver {

    public function creating($model)
    {
        if ($model->importance == 3 && $model->item_type == 'entitystandpoint') {
            Userattitude
            ::join('entitystandpoints AS esp', 'esp.id', '=', 'user_attitudes.item_id')
            ->where('user_attitudes.item_type', 'entitystandpoint')
            ->where('user_attitudes.importance', 3)
            ->where('esp.question_id', $model->entitystandpoint->question_id)
            ->where('user_attitudes.creator_id', $model->creator_id)
            ->getQuery()->update(['user_attitudes.importance' => 2, "user_attitudes.{$model->getUpdatedAtColumn()}" => $model->freshTimestampString()]);
//            ->update(['user_attitudes.importance' => 2]);
        }
    }

    public function updating($model)
    {
        if ($model->importance == 3
            && $model->item_type == 'entitystandpoint'
            && (
            $model->getOriginal('importance') != 3
            || $model->getOriginal('item_type') != 'entitystandpoint'
            || $model->getOriginal('item_id') != $model->item_id  // doesn't account for changes in entitystandpoints.question_id
            || $model->getOriginal('creator_id') != $model->creator_id
            )
        ) {
            Userattitude
            ::join('entitystandpoints AS esp', 'esp.id', '=', 'user_attitudes.item_id')
            ->where('user_attitudes.item_type', 'entitystandpoint')
            ->where('user_attitudes.importance', 3)
            ->where('esp.question_id', $model->entitystandpoint->question_id)
            ->where('user_attitudes.creator_id', $model->creator_id)
            ->getQuery()->update(['user_attitudes.importance' => 2, "user_attitudes.{$model->getUpdatedAtColumn()}" => $model->freshTimestampString()]);
//            ->update(['user_attitudes.importance' => 2]);
        }
    }

}
