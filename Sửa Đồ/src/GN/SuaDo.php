<?php

namespace GN;

 use pocketmine\plugin\PluginBase;
 use pocketmine\{command\Command, command\CommandSender};
 use pocketmine\item\Item;
 use pocketmine\utils\TextFormat as __;

class SuaDo extends PluginBase {

  public function onEnable() {
$this->getLogger()->info("Đac Hoạt Động");
   }
  public function onDisable() {
   $this->getLogger()->info("Đã Vô Hiệu Hóa");
  }
  public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
switch($cmd->getName()) {

 case "suado":
 $inventory = $sender->getInventory();
 $item = $inventory->getItemInHand();
 $item->setDamage(0);
 $item->setLore(array("§f[§aVật Phẩm Đã Qua Sửa Chữa§f]"));
 $inventory->setItemInHand($item);
 $sender->sendMessage("§e༄༂§bVật Phẩm Đã Được Sửa Chữa§e༂࿐");
  break;
    }
  }
}