<?php
namespace Util;

/**
 * 渲染进度条
 */
class ProgressBar
{
    // 总进度
    private $total;
    // 当前进度
    private $progress;
    // 任务开始时间戳
    private $startTime;
    // 任务耗时
    private $keepTime;
    //默认配置
    private $config = [
        //进度条标题
        'title' => '进度',
        //进度条长度
        'length' => 50,
        //进度条占位符
        'placeholder' => '-',
        //进度条样式
        'progress' => '>',
        //进度条满提示
        'done' => '完毕！',
    ];

    /**
     * 设置总进度
     *
     * @param integer $total
     * @return object
     */
    public function total(int $total) : object
    {
        $this->total = $total;
        $this->startTime = time();
        return $this;
    }

    /**
     * 设置当前进度
     *
     * @param integer $progress
     * @return object
     */
    public function show(int $progress) : object
    {
        $this->progress = $progress;
        $this->keepTime = time() - $this->startTime;
        $this->render();
        return $this;
    }

    /**
     * 设置风格
     *
     * @param array $config
     * @return object
     */
    public function style(array $config) : object
    {
        $this->config = array_merge($this->config, $config);
        return $this;
    }

    /**
     * 获取进度条信息
     *
     * @return string
     */
    private function getBar() : string
    {
        $time = $this->getKeepTime();
        $done = ($this->progress >= $this->total) ? $this->config['done'] . " {$time}\n" : "%d%%\r";
        return "{$this->config['title']}: [%'{$this->config['placeholder']}-{$this->config['length']}s] {$done}";
    }

    /**
     * 获取耗时
     *
     * @return string
     */
    private function getKeepTime() : string
    {
        $hour = floor($this->keepTime / 3600);
        $min = floor(($this->keepTime % 3600) / 60);
        $sec = floor((($this->keepTime % 3600) % 60));
        return sprintf('%d:%02d:%02d', $hour, $min, $sec);
    }

    /**
     * 渲染进度条
     */
    private function render()
    {
        printf(
            $this->getBar(),
            str_repeat($this->config['progress'],$this->progress/$this->total*$this->config['length']),
            $this->progress/$this->total*100
        );
    }
}
