<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<form name="myform" method="POST" action="/KOL/index.php/Admin/Material/uploadImg" enctype="multipart/form-data">
    <td height="45"><input type="file" name="pic[]"/></td>
    <td height="45"><input type="file" name="pic[]"/></td>
    <td height="45"><input type="file" name="pic[]"/></td>
    <input type="submit"/>
</form>
</body>
</html>