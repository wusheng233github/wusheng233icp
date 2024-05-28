<!DOCTYPE html>
<html>
	<head>
		<title><?php $title = file_get_contents("title.txt"); $domain = file_get_contents("domain.txt"); echo $title; ?></title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/mdui.min.css"></link>
		<script src="js/mdui.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<div class="mdui-toolbar mdui-color-blue-700">
			<span class="mdui-typo-title"><?php echo $title; ?></span>
		</div>
		<div class="mdui-card mdui-m-x-2 mdui-p-x-2 mdui-p-b-2">
			<p class="mdui-typo-display-1 mdui-m-l-2"><?php echo $title; ?>查询</p>
			<?php
			function searchArray($array, $value) {
				$results = [];
				foreach($array as $key => $item) {
					if($item === $value) {
						$results[] = $array;
					} else if(is_array($item)) {
						$subResults = searchArray($item, $value);
						if(!empty($subResults)) {
							$results = array_merge($results, $subResults);
						}
					}
				}
				return $results;
			}
			if(!empty($_GET["id"])) {
				$id = json_decode(file_get_contents("id.json"), true);
				$pendingid = json_decode(file_get_contents("pendingid.json"), true);
				$info = json_decode(file_get_contents("idinfo.json"), true);
				if(in_array($_GET["id"], $id)) {
					$array = searchArray($info, $_GET["id"]);
					echo "<p class=\"mdui-typo-headline mdui-m-l-3\">{$_GET["id"]}</p><h4>域名: {$array[0]["domain"]}</h4><h4>介绍: {$array[0]["description"]}</h4>";
					
				} else if(in_array($_GET["id"], $pendingid)) {
					echo "<p class=\"mdui-typo-headline mdui-m-l-3\">{$_GET["id"]}正在审核</p>";
				} else {
					echo "<p class=\"mdui-typo-headline mdui-m-l-3\">{$_GET["id"]}不存在</p>";
				}
			} else {
				echo "<form action=\"index.php\" method=\"GET\"><div class=\"mdui-textfield\"><input class=\"mdui-textfield-input\" type=\"text\" name=\"id\" placeholder=\"输入编号\" /></div><input type=\"submit\" class=\"mdui-btn mdui-btn-raised mdui-ripple mdui-color-teal\" value=\"查询\"><form>";
			}
			?>
		</div>
	</body>
</html>