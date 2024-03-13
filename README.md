# TpQueue

## 安装

```
composer require yuyue8/tp_queue
```

## 使用方法

默认使用 `Yuyue8\TpQueue\basic\BaseJobs` 类执行任务，若需自定义执行类，
只需继承 `Yuyue8\TpQueue\basic\BaseJobs` 类，并重置 `fire` 方法，
然后在`tp_config`配置文件中添加 `base_jobs_class` 参数，值为自定义类

例如：

```
'base_jobs_class' => \app\basic\Job::class
```

然后创建 `jobs` 类

```
php think make:jobs /data/jobs/Sms
```

> 在 `jobs` 类中，返回 `true` 表示消费成功，其他返回值表示消费失败，将会进入重新投递，重新投递次数用完依然没有消费成功，删除此消息，并执行 `JobsFailListener` 事件, `JobsFailListener` 该事件需要自己创建并注册

使用方法如下：

```php
/** @var Sms $job */
$job = app(Sms::class);
$job->dispatch(['参数1','参数2'...]);
$job->dispatchSece('延迟时间',['参数1','参数2'...]);
$job->dispatchDo('执行方法名',['参数1','参数2'...],'延长时间');
```

## 监听任务并执行

```bash
&> php think queue:listen
php think queue:listen --queue Sms

&> php think queue:work
```
