<?php
namespace Heal;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as Color;
use pocketmine\Player;

class Healer extends PluginBase{
     public function onEnable(){
          $this->getLogger()->info("Healer v1 Đã Hoạt Động");
     }
     public function onCommand(CommandSender $sender, Command $command, $labels, array $args){
          $cmd = strtolower($command);
          if($cmd == "heal"){
               if($sender->hasPermission("heal.chobanthan") && $sender instanceof Player) {
                    $sender->setHealth($sender->getMaxHealth());
                    $sender->sendMessage(Color::YELLOW."§f[§aĐã Hồi Phục §cHP§f]");
               }
               if(isset($args[0])){
                    if($sender->hasPermission("heal.chonguoikhac")){
                      $player = $this->getServer()->getPlayer($args[0]);
                      if($player !== null){
                          $player->setHealth($sender->getMaxHealth());
                          $sender->sendMessage(Color::YELLOW . "§f• §aĐã Hồi Phục §cHP§a Cho:§b $args[0]");
                          $player->sendMessage(Color::YELLOW . "§f• §aBạn Đã Được Hồi Phục §cHP§a Bởi:§b ". $sender->getName());
                     }else{
                          $sender->sendMessage(Color::RED . "§f[§cNgười Chơi Không Hoạt Động§f]");
                     }
                    }
               }
          }
     }
     public function onDisable(){
          $this->getLogger()->info("Healer v1 Đã Tắt");
     }
}
