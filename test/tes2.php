<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>JS Bin</title>
<!-- ADD CSS HERE -->
<link rel="stylesheet" href="style/bootstrap.css">
<link rel="stylesheet" href="style/bootstrap-tagsinput.css">
<!-- ADD JS/SCRIPT HERE -->
<script src="style/jquery.js"></script>
<script src="style/bootstrap.js"></script>
<script src="style/bootstrap-tagsinput.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($){

            $('#input').tagsinput({
            confirmKeys:[44]
            })
        })
    </script>
</head>
<body>
    <input type="text" value="washington, america" data-role="tagsinput" id="input">
</body>
</html>