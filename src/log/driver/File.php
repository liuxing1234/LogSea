<?php

namespace LogSea\log\driver;


/**
 * 本地化调试输出到文件
 */
class File
{
    protected $config = [
        'time_format' => ' c ',
        'single' => false,
        'file_size' => 2097152,
        'path' => '',
        'max_files' => 0
    ];

    // 实例化并传入参数
    public function __construct($config = [])
    {
        if (is_array($config)) {
            $this->config = array_merge($this->config, $config);
        }
    }

    /**
     * 日志写入接口
     * @access public
     * @param  string $log 日志信息
     * @param  bool $append 是否追加请求信息
     * @return bool
     */
    public function save($log)
    {
        $destination = $this->getMasterLogFile();

        $path = dirname($destination);
        var_dump($path);
        !is_dir($path) && mkdir($path, 0755, true);

        if ($log) {
            return $this->write($log, $destination);
        }

        return true;
    }

    /**
     * 获取主日志文件名
     * @access public
     * @return string
     */
    protected function getMasterLogFile()
    {

            if ($this->config['max_files']) {
                $filename = date('Ymd') . '.log';
                $files = glob($this->config['path'] . '*.log');

                try {
                    if (count($files) > $this->config['max_files']) {
                        unlink($files[0]);
                    }
                } catch (\Exception $e) {
                }
            } else {
                $filename = date('Ym') . DIRECTORY_SEPARATOR . date('d') . '.log';
                var_dump($filename);
            }

            $destination = $this->config['path'] . $filename;


        return $destination;
    }

    /**
     * 获取独立日志文件名
     * @access public
     * @param  string $path 日志目录
     * @param  string $type 日志类型
     * @return string
     */
    protected function getApartLevelFile($path)
    {
        if ($this->config['single']) {
            $name = is_string($this->config['single']) ? $this->config['single'] : 'single';


        } elseif ($this->config['max_files']) {
            $name = date('Ymd');
        } else {
            $name = date('d');
        }

        return $path . DIRECTORY_SEPARATOR . $name . '.log';
    }

    /**
     * 日志写入
     * @access protected
     * @param  string $message 日志信息
     * @param  string $destination 日志文件
     * @param  bool $apart 是否独立文件写入
     * @param  bool $append 是否追加请求信息
     * @return bool
     */
    protected function write($message, $destination)
    {
        // 检测日志文件大小，超过配置大小则备份日志文件重新生成
        $this->checkLogSize($destination);
        $prefix = "[".date("Y-m-d H:i:s")."]";
        $message .= "\r\n";
        $log = $prefix.$message;
        return error_log($log, 3, $destination);
    }


    /**
     * 检查日志文件大小并自动生成备份文件
     * @access protected
     * @param  string $destination 日志文件
     * @return void
     */
    protected function checkLogSize($destination)
    {
        if (is_file($destination) && floor($this->config['file_size']) <= filesize($destination)) {
            try {
                rename($destination, dirname($destination) . DIRECTORY_SEPARATOR . time() . '-' . basename($destination));
            } catch (\Exception $e) {
            }
        }
    }


}



