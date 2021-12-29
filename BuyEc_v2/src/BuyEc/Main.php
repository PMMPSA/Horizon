<?php

namespace BuyEc;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\enchantment\Enchantment;
use onebone\economyapi\EconomyAPI;

class Main extends PluginBase {
	
	public $eco;
	public $enchants;
	
	public function onEnable() {
		$this->eco = EconomyAPI::getInstance();
		
		$this->enchant = ["0:Protection","1:Fire Protection","2:Feather Falling","3:Blast Protection","4:Projectile Protection","5:Thorns","6:Respiration","7:Depth Strider","8:Aqua Affinity","9:Sharpness","10:Smite","11:Bane of Athropods","12:Knockback","13:Fire Aspect","14:Looting","15:Efficiency","16:Silk Touch","17:Unbreaking","18:Fortune","19:Power","20:Punch","21:Flame","22:Infinity","23:Luck of the Sea","24:Lure"];
	}
	
	/*
	!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	!Plugin Edit Bởi Ghast Noob!
	!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	*/
	
	public function onCommand(CommandSender $s, Command $cmd, $label, array $args) {
		
		if($cmd->getName() == "buyec") {
			
		  if(isset($args[0]) && isset($args[1])) {
			  
			  if(is_numeric($args[0])) {
				  
				if(is_numeric($args[1])) {
					
				  if($this->eco->myMoney($s->getName()) >= $args[1] ."000") {
					  
					  
		$enchantLevel = $args[1] <= 5 ? $args[1] : 1;
		$enchantId = $args[0];
		
		
		$enchantment = Enchantment::getEnchantment($enchantId);
		
		if($enchantment->getId() === Enchantment::TYPE_INVALID){
			
			$enchantment = Enchantment::getEnchantmentByName($enchantId);
			
			if($enchantment->getId() === Enchantment::TYPE_INVALID){
	    		$s->sendMessage("§f•§a Không Tìm Thấy Phù Phép Này!");
	            $s->sendMessage("§f•§a Ghi: /listec <1|2|3|4|5> Để Xem Danh Sách Phù Phép!");
				return true;
			}
		}
		$id = $enchantment->getId();
		$maxLevel = Enchantment::getEnchantMaxLevel($id);
		if($enchantLevel > $maxLevel or $enchantLevel <= 0){
			$s->sendMessage("§f•§a Cấp Độ Phù Phép Cao Nhất Là: ". $maxLevel);
			return true;
		}
		
		$enchantment->setLevel($enchantLevel);
		$item = $s->getInventory()->getItemInHand();
		if($item->getId() <= 0){
			$s->sendMessage("§f•§a Vui Lòng Cầm Vật Phẩm Trên Tay Để Phù Phép!");
			return true;
		}
		
		if(Enchantment::getEnchantAbility($item) === 0){
			$s->sendMessage("§f•§a Vật Phẩm Bạn Đang Cầm Không Phù Hợp Với Phù Phép Này!");
			return true;
		}
		$item->addEnchantment($enchantment);
		$s->getInventory()->setItemInHand($item);
						
						$this->eco->reduceMoney($s->getName(), $args[1] ."000");
						
						$s->sendMessage("§f•§a Phù Phép Thành Công!");
						return true;
				  } else {
					  $s->sendMessage("§f•§a Bạn Không Có Đủ Tiền Để Phù Phép!");
					  return false;
				  }
				} else {
					$s->sendMessage("§f•§a Cấp Độ Phải Là Số!");
					return false;
				}
			  
		  } else {
			  $s->sendMessage("§f•§a ID Phải Là Số!");
		     return false;
		  }
		} else {
			$s->sendMessage("§f•§a Ghi: /buyec <ID Phù Phép> <Cấp Độ>!");
			$s->sendMessage("§f•§a Ghi: /listec <1|2|3|4|5> Để Xem Danh Sách Phù Phép!");
			return false;
		}
		}
		
		if($cmd->getName() == "listec") {
			
		  if(isset($args[0])) {

			 			  $pages = array_chunk($this->enchant, 5);
			  if($args[0] <= count($pages) || $args[0] < 1) {
				  
			  
			  $s->sendMessage("§f•§a Trang Số ". $args[0] ." Trên ". count($pages));
			  foreach($pages[$args[0] - 1] as $enchant) {
				  $is = explode(":", $enchant);
				  $s->sendMessage("§f•§a ". $is[1] .": ". $is[0]);
			  }
			  $s->sendMessage("§f•§a Để Mua Một Phù Phép, Ghi: /buyec <ID> <Cấp Độ>!");
			  return true;
		  } else {
			  $s->sendMessage("§f•§a Không Tìm Thấy Trang Này!");
			  return false;
		  }
		  } else {
			  $s->sendMessage("§f•§a Ghi: /listec <1|2|3|4|5> Để Xem Danh Sách Phù Phép!");
			  return true;
		  }
		}
	}
}