<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>prettier localhost</title>
</head>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
   <link rel="stylesheet" href="Prettier-localhost/css/bootstrap.min.css">
   <link rel="stylesheet" href="Prettier-localhost/css/header.css">
   <link rel="stylesheet" href="Prettier-localhost/css/custom.css">
   <link rel="stylesheet" href="Prettier-localhost/font/css/font-awesome.min.css">
<body>
   <div class="wrapper">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <header id="header">
                  <div class="slider">
                     <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                           <div class="item active">
                              <img src="Prettier-localhost/img/slider/banner10.jpg">
                           </div>
                           <div class="item">
                              <img src="Prettier-localhost/img/slider/banner9.jpg">
                           </div>
                        </div>
                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                           <span class="fa fa-angle-left" aria-hidden="true"></span>
                           <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                           <span class="fa fa-angle-right" aria-hidden="true"></span>
                           <span class="sr-only">Next</span>
                        </a>
                     </div>
                  </div><!--slider-->
                  <nav class="navbar navbar-default">
                  <!-- Brand and toggle get grouped for better mobile display -->
                     <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNav">
                           <span class="sr-only">Toggle navigation</span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"><img class="img-responsive" src="Prettier-localhost/img/profile.png"></a>
                        <span class="site-name"><b>Localhost</b></span>
                        <span class="site-description">That's the biggest problem, is the tax code itself.</span>
                     </div>
                     <!-- Collect the nav links, forms, and other content for toggling -->
                     <div class="collapse navbar-collapse" id="mainNav" >
                        <ul class="nav main-menu navbar-nav">
                           <li><a href="#"><i class="fa fa-home"></i> HOME</a></li>
                           <li><a href="#">Link</a></li>
                           <li><a href="#">Link</a></li>
                        </ul>
                        <ul class="nav  navbar-nav navbar-right">
                           <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                           <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                           <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                     </div><!-- /.navbar-collapse -->
                     <?php
                     // Opens directory
                     $myDirectory=opendir(".");

                     // Gets each entry
                     while($entryName=readdir($myDirectory)) {
                      $dirArray[]=$entryName;
                     }

                     // Finds extensions of files
                     function findexts ($filename) {
                        $filename=strtolower($filename);
                        $exts=split("[/\\.]", $filename);
                        $n=count($exts)-1;
                        $exts=$exts[$n];
                        return $exts;
                     }

                     // Closes directory
                     closedir($myDirectory);

                     // Counts elements in array
                     $indexCount=count($dirArray);

                     // Sorts files
                     sort($dirArray);

                     // Loops through the array of files
                     for($index=0; $index < $indexCount; $index++) {
                        // Allows ./?hidden to show hidden files
                        if($_SERVER['QUERY_STRING']=="hidden")
                           {
                              $hide="";
                              $ahref="./";
                              $atext="Hide";
                           }
                        else
                           {
                              $hide=".";
                              $ahref="./?hidden";
                              $atext="Show";
                           }
                        if(substr("$dirArray[$index]", 0, 1) != $hide) 
                           {
                              // Gets File Names
                              $name=$dirArray[$index];
                              $namehref=$dirArray[$index];

                              // Gets Extensions 
                              $extn=findexts($dirArray[$index]); 

                              // Gets file size 
                              $size=number_format(filesize($dirArray[$index]));

                              // Gets Date Modified Data
                              $modtime=date("M j Y g:i A", filemtime($dirArray[$index]));
                              $timekey=date("YmdHis", filemtime($dirArray[$index]));

                              // Prettifies File Types, add more to suit your needs.
                              switch ($extn){
                                 case "png": $extn="PNG Image"; break;
                                 case "jpg": $extn="JPEG Image"; break;
                                 case "svg": $extn="SVG Image"; break;
                                 case "gif": $extn="GIF Image"; break;
                                 case "ico": $extn="Windows Icon"; break;
                                 case "txt": $extn="Text File"; break;
                                 case "log": $extn="Log File"; break;
                                 case "htm": $extn="HTML File"; break;
                                 case "php": $extn="PHP Script"; break;
                                 case "js": $extn="Javascript"; break;
                                 case "css": $extn="Stylesheet"; break;
                                 case "pdf": $extn="PDF Document"; break;
                                 case "zip": $extn="ZIP Archive"; break;
                                 case "bak": $extn="Backup File"; break;
                                 default: $extn=strtoupper($extn)." File"; break;
                              }

                              // Separates directories
                              if(is_dir($dirArray[$index])) {
                                $extn="&lt;Directory&gt;"; 
                                $size="&lt;Directory&gt;"; 
                                $class="dir";
                              } else {
                                $class="file";
                              }

                               // Cleans up . and .. directories 
                              if($name=="."){$name=". (Current Directory)"; $extn="&lt;System Dir&gt;";}
                              if($name==".."){$name=".. (Parent Directory)"; $extn="&lt;System Dir&gt;";}

                              // Print 'em
                              if($class == 'dir')
                                 {
                                    print(" 
                                       <div class='container clickable-row' data-href='./$namehref'>
                                          <div class='notice notice-info'>
                                             <strong>$name</strong> $size Date modified ( $modtime ) <i class='pull-right fa fa-folder'></i>
                                          </div>
                                       </div>
                                    ");
                                 }
                              else {
                                 print(" 
                                 <div class='container clickable-row' data-href='./$namehref'>
                                    <div class='notice notice-warning'>
                                       <strong>$name</strong> File ( $size bytes ) Date modified ( $modtime ) <i class='pull-right fa fa-file'></i>
                                    </div>
                                 </div>
                                 ");
                              }
                           }
                        }
                     ?>
                  <h2 class="text-center"><?php print("<a href='$ahref'>$atext hidden files</a>"); ?></h2>
               </body>
<script src=".sorttable.js"></script>
<script src="Prettier-localhost/js/jquery-3.2.1.min.js"></script>
<script src="Prettier-localhost/js/bootstrap.min.js"></script>
<script type="text/javascript">
   jQuery(document).ready(function($) {
      $(".clickable-row").click(function() {
         window.location = $(this).data("href");
      });
   });
</script>
</html>