<?php
$data = json_decode(file_get_contents("id.json"), true);
$pendingid = json_decode(file_get_contents("pendingid.json"), true);
if(in_array($_GET["id"], $data) || in_array($_GET["id"], $pendingid)) {
	header("Location: ?error=1");
}
?>
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
		<?php
		if($_GET["error"] == 1) {
			echo "<h2 class=\"mdui-typo-display-1 mdui-m-l-2\">错误的ID</h2><p class=\"mdui-typo-headline mdui-m-l-3\">已被注册</p>";
		} else {
			if(isset($_GET["id"])) {
				if(isset($_GET["step"]) && $_GET["step"] == 2) {
					echo "<h2 class=\"mdui-typo-display-1 mdui-m-l-2\">提交信息</h2><form action=\"complete.php\" method=\"POST\"><div class=\"mdui-textfield\"><input class=\"mdui-textfield-input\" type=\"text\" name=\"id\" placeholder=\"ID\" value=\"{$_GET["id"]}\" /></div><div class=\"mdui-textfield\"><input class=\"mdui-textfield-input\" type=\"text\" name=\"domain\" placeholder=\"网站域名\" /></div><div class=\"mdui-textfield\"><input class=\"mdui-textfield-input\" type=\"text\" name=\"description\" placeholder=\"网站介绍\" /></div><input type=\"submit\" class=\"mdui-btn mdui-btn-raised mdui-ripple mdui-color-teal\" value=\"完成\"><form>";
				} else {
					echo "<h2 class=\"mdui-typo-display-1 mdui-m-l-2\">设置您的网站</h2><p class=\"mdui-typo-headline mdui-m-l-3\">在页脚添加代码</p><p>&gt;&lt;a href=&quot;https://$domain/?id={$_GET["id"]}&quot; target=&quot;_blank&quot;&gt;$title {$_GET["id"]}号&lt;/a&gt;</p><button class=\"mdui-btn mdui-btn-raised mdui-ripple mdui-color-teal\" onclick=\"window.location.href='?id={$_GET["id"]}&step=2'\">我已完成设置</button>";
				}
			} else {
				echo "<h2 class=\"mdui-typo-display-1 mdui-m-l-2\">$title 申请</h2><div class=\"mdui-typo-headline mdui-m-l-3\">要求</div><p>某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某<br>某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某<br>某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某</p><button class=\"mdui-btn mdui-btn-raised mdui-ripple mdui-color-teal\" onclick=\"window.location.href='id.php'\">开始</button>";
			}
		}
		?>
		</div>
	</body>
</html>