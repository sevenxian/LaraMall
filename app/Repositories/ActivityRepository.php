<?php

namespace App\Repositories;

use App\Model\Activity;

class ActivityRepository
{
    use BaseRepository;

    /**
     * @var Activity
     * @author zhulinjie
     */
    protected $model;

    /**
     * ActivityRepository constructor.
     * @param Activity $activity
     */
    public function __construct(Activity $activity)
    {
        $this->model = $activity;
    }

    /**
     * 获取最近的一次活动
     *
     * @param $currentTimestamp
     * @author zhulinjie
     */
    public function activities($currentTimestamp)
    {
        return $this->model->where('end_timestamp', '>', $currentTimestamp)->orderBy('start_timestamp')->first();
    }
    
    /**
     * 获取正在进行的活动
     *
     * @param $currentTimestamp
     * @return mixed
     * @author zhulinjie
     */
    public function ongoingActivities($currentTimestamp)
    {
        return $this->model->where('start_timestamp', '<=', $currentTimestamp)->where('end_timestamp', '>', $currentTimestamp)->first();
    }
}