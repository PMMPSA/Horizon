<?php

namespace emanuele0204\Size;

use pocketmine\plugin\PluginBase;
use pocketmine\command\{Command, CommandSender};
use pocketmine\entity\Entity;
use pocketmine\{Server, Player};

class Size extends PluginBase{
    
    public $b = array();
    public function onEnable(){
        $this->getLogger()->info("Size Đang Hoạt Động");
        $this->getServer()->getCommandMap()->register("size", new pSize($this));
    }
    
    public function respawn(PlayerRespawnEvent $e){
        $o = $e->getPlayer();
        if(!empty($this->b[$o->getName()])){
            $nomep = $this->b[$o->getName()];
            $o->setDataProperty(Entity::DATA_SCALE, Entity::DATA_TYPE_FLOAT, $nomep);
        }
    }
}

class pSize extends Command{
    
    private $p;
    public function __construct($plugin){
        $this->p = $plugin;
        parent::__construct("size", "Size By emanuele0204");
    }
    
    public function execute(CommandSender $g, $label, array $args){
        if($g->hasPermission("size.size")){
            if(isset($args[0])){
                if(is_numeric($args[0])){
                  if ($args[0] >= 0 && $args[0] <= 5) {
                    $this->p->b[$g->getName()] = $args[0];
                    $g->setDataProperty(Entity::DATA_SCALE, Entity::DATA_TYPE_FLOAT, $args[0]);
                    $g->sendMessage("§f[§aSize Của Bạn Đã Được Chỉnh Thành: ".$args[0]."§f]");
                }elseif($args[0] == "reset"){
                    if(!empty($this->p->b[$g->getName()])){
                        unset($this->p->b[$g->getName()]);
                        $g->setDataProperty(Entity::DATA_SCALE, Entity::DATA_TYPE_FLOAT, 1.0);
                        $g->sendMessage("§f[§Size Của Bạn Đã Được Chỉnh Về Mặc Định§f]");
                    }else{
                        $g->sendMessage("§f[§aGhi /size <Size> Để Chỉnh Size §f|§a Ghi /size reset Để Chỉnh Size Về Mặc Định§f]");
                    }
                }else{
                    $g->sendMessage("§f[§cVui Lòng Không Size Quá 5. Cám Ơn!§f]");
               }
            }
         }
      }
   }
}
