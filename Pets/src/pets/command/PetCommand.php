<?php

namespace pets\command;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pets\main;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;

class PetCommand extends PluginCommand {

	public function __construct(main $main, $name) {
		parent::__construct(
				$name, $main
		);
		$this->main = $main;
		$this->setPermission("pocketmine.command.pets");
		$this->setAliases(array("pets"));
	}

	public function execute(CommandSender $sender, $currentAlias, array $args) {
	if($sender->hasPermission('pocketmine.command.pets')){
		if (!isset($args[0])) {
			$sender->sendMessage("§f==========§eCách Sử Dụng Plugin§f==========\n§f• §a/pets type [Tên Thú Cưng] §f|§b Để Triệu Hồi Thú Cưng\n§aVD: /pets type dog\n\n§f• §aDanh Sách Thú Cưng:§b dog§f, §brabbit§f, §bpig§f, §bsnowgolem§f, §birongolem§f, §bbat§f, §bspider§f, §bcat§f, §bchicken§f, §bzombie§f.\n\n§f• §a/pets off §f|§b Để Tắt Thú Cưng\n\n§f• §a/pets setname §f|§b Để Đặt Tên Cho Thú Cưng §f[§cLỗi§f]\n\n§f•§a /pets size §f|§b Để Chỉnh Kích Thước Thú Cưng §f[§cLỗi§f]\n\n§f•§a /pets info §f|§b Xem Thông Tin Plugin\n§f=======================================");
			
			return true;
		}
		switch (strtolower($args[0])){
			case "name":
			case "setname":
			case "ตั้งชื่อ":
				if (isset($args[1])){
					unset($args[0]);
					$name = implode(" ", $args);
					$this->main->getPet($sender->getName())->setNameTag($name);
					$sender->sendMessage("§f• §aĐã Chỉnh Tên Thú Cưng Thành:§b ".$name);
					$data = new Config($this->main->getDataFolder() . "players/" . strtolower($sender->getName()) . ".yml", Config::YAML);
					$data->set("name", $name); 
					$data->save();
				}
				return true;
			break;
			case "info":
			case "ข้อมูล":
                $sender->sendMessage("§f•§a Plugin Được Code Bởi: §bNameLess");
				return true;
			break;
			case "size":
			case "ขนาด":
                $sender->sendMessage("§f•§a Tính Năng Hiện Đang Lỗi");
				return true;
			case "help":
			case "ช่วยเหลือ":
				$sender->sendMessage("§f==========§eCách Sử Dụng Plugin§f==========\n§f• §a/pets type [Tên Thú Cưng] §f|§b Để Triệu Hồi Thú Cưng\n§aVD: /pets type dog\n\n§f• §aDanh Sách Thú Cưng:§b dog§f, §brabbit§f, §bpig§f, §bsnowgolem§f, §birongolem§f, §bbat§f, §bspider§f, §bcat§f, §bchicken§f, §bzombie§f.\n\n§f• §a/pets off §f|§b Để Tắt Thú Cưng\n\n§f• §a/pets setname §f|§b Để Đặt Tên Cho Thú Cưng §f[§cLỗi§f]\n\n§f•§a /pets size §f|§b Để Chỉnh Kích Thước Thú Cưng §f[§cLỗi§f]\n\n§f•§a /pets info §f|§b Xem Thông Tin Plugin\n§f=======================================");
				return true;
			break;
			case "off":
			case "ปิด":
				$this->main->disablePet($sender);
				$sender->sendMessage("§f•§a Đã Tắt Thú Cưng Thành Công!");
			break;
			case "type":
			case "เลือก":
				if (isset($args[1])){
					switch ($args[1]){
						case "wolf":
						case "dog":
							$this->main->changePet($sender, "WolfPet");
							$sender->sendMessage("§f•§a Triệu Hồi Con Chó Thành Công!");
							return true;
						break;
						case "pig":
							$this->main->changePet($sender, "PigPet");
							$sender->sendMessage("§f§a Triệu Hồi Con Heo Thành Công!");
							return true;
						break;
						case "rabbit":
							$this->main->changePet($sender, "RabbitPet");
							$sender->sendMessage("§f•§a Triệu Hồi Con Thỏ Thành Công!");
							return true;
						break;
						case "cat":
							$this->main->changePet($sender, "OcelotPet");
							$sender->sendMessage("§f•§a Triệu Hồi Con Mèo Thành Công!");
							return true;
						break;
						case "chicken":
							$this->main->changePet($sender, "ChickenPet");
							$sender->sendMessage("§f•§a Triệu Hồi Con Gà Thành Công!");
							return true;
						break;
						case "zombie":
							$this->main->changePet($sender, "(ZombiePet");
							$sender->sendMessage("§f•§a Triệu Hồi Con Thây Ma Thành Công!");
							return true;
						break;
						case "spider":
							$this->main->changePet($sender, "SpiderPet");
							$sender->sendMessage("§f•§a Triệu Hồi Con Nhện Thành Công!");
							return true;
						break;
						case "snowgolem":
							$this->main->changePet($sender, "SnowGolemPet");
							$sender->sendMessage("§f•§a Triệu Hồi Con Người Tuyết Thành Công!");
							return true;
						break;
						case "irongolem":
							$this->main->changePet($sender, "IronGolemPet");
							$sender->sendMessage("§f•§a Triệu Hồi Con Người Sắt Thành Công!");
							return true;
						break;
						case "bat":
							$this->main->changePet($sender, "BatPet");
							$sender->sendMessage("§f•§a Triệu Hồi Con Dơi Thành Công!");
							return true;
						break;
					default:
						$sender->sendMessage("§f==========§eCách Sử Dụng Plugin§f==========\n§f• §a/pets type [Tên Thú Cưng] §f|§b Để Triệu Hồi Thú Cưng\n§aVD: /pets type dog\n\n§f• §aDanh Sách Thú Cưng:§b dog§f, §brabbit§f, §bpig§f, §bsnowgolem§f, §birongolem§f, §bbat§f, §bspider§f, §bcat§f, §bchicken§f, §bzombie§f.\n\n§f• §a/pets off §f|§b Để Tắt Thú Cưng\n\n§f• §a/pets setname §f|§b Để Đặt Tên Cho Thú Cưng §f[§cLỗi§f]\n\n§f•§a /pets size §f|§b Để Chỉnh Kích Thước Thú Cưng §f[§cLỗi§f]\n\n§f•§a /pets info §f|§b Xem Thông Tin Plugin\n§f=======================================");
					break;	
					return true;
					}
				}
			break;
		}
		return true;
	}
	}
}
