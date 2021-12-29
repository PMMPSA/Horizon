<?php

namespace cmdsnooper;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class CmdSnooper extends PluginBase {
	public $snoopers = [];
	
	public function onEnable() {
		@mkdir($this->getDataFolder());
		$this->getLogger()->info("Plugin Đã Hoạt Động");
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		$this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML, array(
	  	"Console.Logger" => "true",
  		));
	}
	
	 public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {			
		if(strtolower($cmd->getName()) == "snoop") {
		 	if($sender instanceof Player) {
				if($sender->hasPermission("snoop.command")) {
					if(!isset($this->snoopers[$sender->getName()])) {
						$sender->sendMessage("§f[§aSnoop§f]§b Bạn Đã Bật Chế Độ Xem Các Người Chơi Khác Dùng Lệnh.");
						$this->snoopers[$sender->getName()] = $sender;
						return true;
					} else {
						$sender->sendMessage("§f[§aSnoop§f]§b Bạn Đã Tắt Chế Độ Xem Người Khác Sử Dụng Lệnh.");
						unset($this->snoopers[$sender->getName()]);
						return true;
					}
				}
			}
		}
	}
 }
