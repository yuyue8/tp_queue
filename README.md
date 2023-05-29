# TpUtils

## 安装
~~~
composer require yuyue8/tp_utils
~~~

## 使用方法

使用前需要安装`topthink/think-queue`插件
~~~
composer require topthink/think-queue
~~~

使用方法如下：
```php
/** @var Job $job */
$job = app(Job::class);
$job->dispatch(['参数1','参数2'...]);
$job->dispatchSece('延迟时间',['参数1','参数2'...]);
$job->dispatchDo('执行方法名',['参数1','参数2'...],'延长时间');
```