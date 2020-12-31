# progress-bar
>一个php脚本进度条工具

## 自定义风格示例
``` php
$progress->style([
    //进度条标题
    'title' => sprintf('下载%s', $total),
    //进度条长度
    'length' => 50,
    //进度条占位符
    'placeholder' => '-',
    //进度条样式
    'progress' => '>',
    //进度条满提示
    'done' => '完毕！',
])->show($progress);
```


## 示例
``` php
$progress = new Silfoxs\ProgressBar();
for ($j=0; $j < 10; $j++) {
    $progress->total($total = mt_rand(100, 500));
    for ($i = 1; $i <= $total; $i++) {
        $progress->style([
            'title' => sprintf('下载%s', $total),
        ])->show($i);
        usleep(mt_rand(10000, 300000));
    }
}
```
