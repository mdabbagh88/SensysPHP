<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Endru Reza" content="crawling,sentiment,naivebayes">

    <title>SensysPHP</title>

    <!-- Bootstrap core CSS -->
    <link href="style/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="style/css/tag/bootstrap-tagsinput.css">
    <!-- Add custom CSS here -->
    <link href="style/css/sb-admin.css" rel="stylesheet">
    <!-- Add Font CSS -->
    <link rel="stylesheet" href="style/font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="style/css/morris-0.4.3.min.css">

    <!-- Add Script Here -->
    <script src="style/js/jquery.js"></script> 
    <script src="style/js/bootstrap.js"></script>
    <script src="style/js/tag/bootstrap-tagsinput.js"></script>
    <script src="style/js/raphael-min.js"></script>
    <script src="style/js/morris-0.4.3.min.js"></script>    
    <script type="text/javascript">
        $(document).ready(function(){
            $("a#tooltip").tooltip({
                placement : 'top'
            });
        });
    </script>
  </head>

    <body>
        
        <div id="wrapper">
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-exl-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">SensysPHP Dashboard</a>
                </div>
                
                <div class="collapse navbar-collapse navbar-exl-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="crawlerURL.php"><i class="fa fa-facebook-square"></i> Crawling Site URL</a></li>
                        <li><a href="crawlerDOM.php"><i class="fa fa-html5"></i> Scrapping Using HTML DOM Parser</a></li>
                        <li><a href="bayes.php"><i class="fa fa-edit"></i> Classification</a></li>
                        <li><a href="report.php"><i class="fa fa-bar-chart-o"></i> Report</a></li>
                        <li><a href="about.php"><i class="fa fa-file"></i> About Developer</a></li>
                    </ul>
                </div>  
            </nav>  
        
        <div id="page-wrapper">

            
<!--Dilanjutkan Ke Index.php -->