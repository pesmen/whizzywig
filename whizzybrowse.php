<?php //Whizzybrowse.php v3 - File/Image browser for whizzywig editor.
//CONFIGURE HERE: (or set these variables in PHP and INCLUDE this file)
 if (!isset($browse))  $browse='pics'; //Set to 'pics' OR 'files'
 if (!isset($dirlist)) $dirlist='images|img'; //allowed directories
 if (!isset($upload_allowed)) $upload_allowed=true; //Are uploads from user PC allowed? true/false
 if (!isset($piclist)) $piclist='gif|jpg|jpeg|png|ico'; //allowed extensions for images 
 if (!isset($extlist)) $extlist='html|htm|pdf|txt|doc|xls|ppt'; //allowed extensions for files 
 
//TRANSLATE HERE:
 if (!isset($Instructions)) $Instructions='Hover over a name below to preview, click it to select.';
 if (!isset($Caption))      $Caption='Preview';
 if (!isset($Up))           $Up='Up';
 if (!isset($FileSize))     $FileSize='Size';
 if (!isset($Updated))      $Updated='Updated';
 if (!isset($UploadFile))   $UploadFile='Upload this file';
 if (!isset($SendFile))     $SendFile='Send File';
 if (!isset($NotAllowed))   $NotAllowed='not allowed';
?>
<html>
<!-- 
Copyright © 2009-10, John Goodman - www.unverse.net  *date 100312
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
-->
<head>
<title>Whizzybrowse file/image browser v3</title>
<style>
body {font:85% sans-serif;}
#picture {width:60%;height:80%; float:right;}
#files {height:80%; overflow:auto; padding:1ex;}
#upload {background-color:buttonface; padding:4px; border:1px outset buttonface}
#caption{font-size:1.2em}
#preview {height:80%;width:100%}
</style>
<script type="text/javascript">
function _wImage(url) {
 window.opener.document.getElementById('if_url'+window.opener.idTa).value=url;
 window.close();
}
function _wLink(url) {
 window.opener.document.getElementById('lf_url'+window.opener.idTa).value=url;
 window.close();
}
</script>
</head>
<?php 
$fun = ($browse=='pics') ? '_wImage' : '_wLink';
$browselist = ($browse=='pics') ? $piclist : $extlist;
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
$webpath = $_REQUEST['d'];
$fspath = $root .'/'. $webpath;
if (!is_dir($fspath)) $fspath = $root; 
$ufile = $_FILES['userfile']['tmp_name']; //GOT UPLOAD
if ($ufile){
 $ufilename = $_FILES['userfile']['name'];
 if (!preg_match("/\.($browselist)$/",$ufilename)) echo "<body>$ufilename $NotAllowed";
 else {
  $uferr = $_FILES['userfile']['error'];
  if ($uferr > 0) exit ("[Upload error $uferr for $ufilename] ");
  $newname = okname($ufilename);
  $target = "$fspath/$newname";
  $webname = $webpath ? "$webpath/$newname" : $newname;
  if (file_exists($target)) @cp($target,"$target.bak"); //Note, previous version silently backed up
  if (!@move_uploaded_file($ufile, $target)) exit ("[Failed to move upload $ufilename to $webname]"); 
  else exit('<body onload="'.$fun.'(\''.$webname.'\');"> '.$webname.' </body></html>');
 }
} else echo '<body>' ;
if ($upload_allowed) { //UPLOAD FORM
?>
<form id="upload" enctype='multipart/form-data' method='post'>
<input type='hidden' name='MAX_FILE_SIZE' value='8000000'><label for='userfile'><?php echo $UploadFile; ?>: </label><input name='userfile' id='userfile' type='file' size='30' style="font-size:75%">
<br>
<input type='hidden' name='d' value='<?php echo $webpath;?>'>
<input type='submit' value='<?php echo $SendFile; ?>'>
</form>
<?php } //endif $upload_allowed 
echo "$Instructions<br>"; 
if ($webname) echo "<a href='#' onmouseover='document.getElementById(\"preview\").src=\"$webname\";' onclick='_wImage(\"$webname\")'>$webname</a><br>";?>
<div id="picture">
 <span id="caption"><?php echo $Caption; ?></span><br><br>
 <iframe id="preview" src="javascript:document.write('<?php echo $Caption; ?>');"> </iframe>
</div>
<div id="files" >
<?php
$dir = opendir($fspath);
while ($file = readdir($dir)){
  $files[] = $file;
}
closedir($dir);
natcasesort($files);
$dflag = "<b>+</b>"; 
foreach ($files as $filename) {
 if ($filename == '.'){ //current directory
  $dlist .= "<strong>$webpath </strong><br>\n";
 } else if ($filename == '..') { //parent directory
   if($webpath && $webpath != "/") { //we're in a sub directory - no Up from root
    $updir = substr($webpath,0,strrpos($webpath,'/'));
    $dlist .= "<b>&uarr;</b><a href='$self?d=$updir'>$Up</a><br>";
   }	
 } else if (is_dir("$fspath/$filename")) { //it's a directory
   if (preg_match("/($dirlist)$/",$filename)) {
    $dlist .= "$dflag <a href='$self?d=$webpath/$filename'>$filename</a>/<br>\n"; 
   } 
 } else if (preg_match("/\.($browselist)$/",$filename)) { //it's a file/image
  $filepath = "$fspath/$filename";
  $fsize = sprintf("%u", filesize($filepath)); //filesizes over 2Mb won't fit in an int so we unsign it
  $modtime = date ("Y-m-d H:i:s", filemtime($filepath)); //mtime is unix timestamp
  $tip = " $FileSize: $fsize <br>$Updated: $modtime ";
  $webname=str_replace('//','/',"/$webpath/$filename");
  $flist .= "<b>&bull;</b> <a href='#' onclick='$fun(\"$webname\")' onmouseover='document.getElementById(\"preview\").src=\"$webname\";document.getElementById(\"caption\").innerHTML=\"<b>$filename</b><br>$tip\"'>$filename</a></br>\n"; 
 }
}
echo "$dlist \n $flist \n";
function okname($tit,$paths=false){
 $ok = get_magic_quotes_gpc() ?  stripslashes($tit) : $tit;
 $ok = preg_replace("/ +/ ", "-", trim($ok));  // space runs to '-'
 $pat = $paths ? "/[^A-Za-z0-9-_.\/]+/" : "/[^A-Za-z0-9-_.]+/"; // '/' allowed?
 $ok = preg_replace($pat, "", $ok); //only alphanumerics and -_
 return $ok;
}
?>
</div>
</body>
</html>