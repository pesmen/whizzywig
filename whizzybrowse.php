<?php //Whizzybrowse.php v1 - File/Image browser for whizzywig editor.
//CONFIGURE HERE: (or set these variables in PHP and INCLUDE this file)
 if (!$browse) $browse='pics'; //Set to 'pics' OR 'files'
 if (!$dirlist) $dirlist='images|img'; //allowed directories
 if (!$piclist) $piclist='gif|jpg|jpeg|png|ico'; //allowed extensions for images 
 if (!$extlist) $extlist='html|htm|pdf|txt|doc'; //allowed extensions for files 
//TRANSLATE HERE:
 $Instructions='Hover over a name below to preview, click it to select.';
 $Caption='Preview';
 $Up='Up';
 $FileSize='Size';
 $Updated='Updated';
?>
<html>
<!-- 
Copyright © 2009, John Goodman - www.unverse.net  *date 091104
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
-->
<head>
<title>Whizzybrowse file/image browser v1</title>
<style>
body {font:85% sans-serif;}
#picture {width:60%;height:100%; float:right;}
#files {height:100%; overflow:auto; padding:1ex;}
#caption{font-size:1.2em}
#preview {height:80%;width:100%}
</style>
<script type="text/javascript">
function _wI(url) {
 window.opener.document.getElementById('if_url'+window.opener.idTa).value=url;
 window.close();
}
function _wL(url) {
 window.opener.document.getElementById('lf_url'+window.opener.idTa).value=url;
 window.close();
}
</script>
</head>
<body>
<div id="picture">
 <span id="caption"><?php echo $Caption; ?></span><br><br>
 <iframe id="preview" src="javascript:document.write('<?php echo $Caption; ?>');"> </iframe>
</div>
<div id="files" >
<?php 
echo "$Instructions<br>";
$self = $_SERVER['SCRIPT_NAME'];
if(isset($_SERVER['DOCUMENT_ROOT'])){
 $root = $_SERVER['DOCUMENT_ROOT'];
} else if(isset($_SERVER['SCRIPT_FILENAME'])){ //IIS does not set DOCUMENT_ROOT
  $root = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($self)));
}
if(!isset($root)){ // still not set?
 if(isset($_SERVER['PATH_TRANSLATED'])){
  $root = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($self)));
 }
}
$docpath = $_REQUEST['d'] ? trim($_REQUEST['d'],'/') : '';
$d = $root .'/'. $docpath;
if (!is_dir($d)) $d = $root; 
$dir = opendir($d);
while ($file = readdir($dir)){
  $files[] = $file;
}
closedir($dir);
natcasesort($files);
$dflag = "<span style='color:maroon;font-size:x-small'>+</span>"; 
$browselist = ($browse=='pics') ? $piclist : $extlist;
$fun = ($browse=='pics') ? '_wI' : '_wL';
foreach ($files as $filename) {
 if ($filename == '.'){ //current directory
  $dlist .= "<strong>/$docpath </strong><br>\n";
 } else if ($filename == '..') { //parent directory
   if($docpath && $docpath != "/") { //we're in a sub directory - no Up from root
    $updir = substr($docpath,0,strrpos($docpath,'/'));
    $dlist .= "<b style='color:maroon'>&uarr;</b><a href='$self?d=$updir'>$Up</a><br>";
   }	
 } else if (is_dir("$d/$filename")) { //it's a directory
   if (preg_match("/($dirlist)$/",$filename)) {
    $dlist .= "$dflag <a href='$self?d=$docpath/$filename'>$filename</a>/<br>\n"; 
   } 
 } else if (preg_match("/\.($browselist)$/",$filename)) { //it's a file/image
  $filepath = "$d/$filename";
  $fsize = sprintf("%u", filesize($filepath)); //filesizes over 2Mb won't fit in an int so we unsign it
  $modtime = date ("Y-m-d H:i:s", filemtime($filepath)); //mtime is unix timestamp
  $tip = " $FileSize: $fsize <br>$Updated: $modtime ";
  $fpath=str_replace('//','/',"/$docpath/$filename");
  $flist .= "<span style='color:maroon'>&bull;</span> <a href='#' onclick='$fun(\"$fpath\")' onmouseover='document.getElementById(\"preview\").src=\"$fpath\";document.getElementById(\"caption\").innerHTML=\"<b>$filename</b><br>$tip\"'>$filename</a></br>\n"; 
 }
}
echo "$dlist \n $flist";
?>
</div>
</body>
</html>