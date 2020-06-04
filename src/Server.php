<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/6/1
 * Time: 13:40
 */

namespace LogSea;


use LogSea\config\OptionShip;

class Server
{
    protected  $server;
    protected  $logExt;
    public function __construct()
    {
        $server = new \Swoole\WebSocket\Server(OptionShip::$host, OptionShip::$port);
        $server->set(OptionShip::$option);
        foreach (OptionShip::$events as $k=>$v){
            $server->on($k,[$v,"listen"]);
        }
        $this   ->server = $server;
        $this   ->clean();
        Log::write("ojbk wriete");

        $server ->start();
    }


    public function clean(){
        Cache::rm("fds");
    }

    /**
     * 供第三方的类扩展使用
     * @param null $data
     */
    public static  function write($data=null){

        go(function () use($data) {
            try{
                if(OptionShip::$logExtStatic){
                    foreach(OptionShip::$logExt as $method =>$className){
                        $className::$method($data);
                    }
                }elseif(OptionShip::$logExt){
                    foreach(OptionShip::$logExt as $method =>$className){
                        (new $className)->$method($data);
                    }
                }else{
                    //nothing to do ...
                }
            }catch (\Exception $e){
                Log::write("Error:".$e->getMessage());
            }


        });
    }

}