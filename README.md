# TpQueue

## 安装
~~~
composer require yuyue8/tp_queue
~~~

## 使用方法

创建 `jobs` 类
```
php think make:jobs /data/jobs/Sms
```

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