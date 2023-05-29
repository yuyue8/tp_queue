<?php

namespace Yuyue8\TpQueue;

class Service extends \think\Service
{

    /**
     * 服务启动
     *
     * @return void
     */
    public function boot()
    {
        $this->commands(
            \Yuyue8\TpQueue\command\MakeJobs::class
        );
    }

}
