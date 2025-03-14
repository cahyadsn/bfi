<?php
/*
================================================================================
 *  BISMILLAAHIRRAHMAANIRRAHIIM - In the Name of Allah, Most Gracious, Most Merciful
================================================================================
FILENAME     : index.php
AUTHOR       : CAHYA DSN
CREATED DATE : 2025-02-02 17:08:09
UPDATED DATE : 2025-03-14 08:32:22
DEMO SITE    : http://psycho.cahyadsn.com/bfi
SOURCE CODE  : https://github.com/cahyadsn/bfi
================================================================================
This program is free software; you can redistribute it and/or modify it under the
terms of the MIT License.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

See the MIT License for more details

copyright (c) 2025 by cahya dsn; cahyadsn@gmail.com
================================================================================ */
session_start();
include 'inc/config.php';
$c=isset($_SESSION['c'])?$_SESSION['c']:(isset($_GET['c'])?$_GET['c']:'black');
$page=isset($_SESSION['page'])?$_SESSION['page']:0;
$num_perpage=7;
header('Expires: '.date('r'));
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
if(!isset($_SESSION['bfi_en_data'])){
	$sql="SELECT * FROM bfi_statements WHERE lang='{$_SESSION['lang']}'";
	$result=$db->query($sql);
	$data=array();
	while($row=$result->fetch_object()) $data[]=$row;
	$_SESSION['bfi_en_data']=$data;
}else{
	$data=$_SESSION['bfi_en_data'];
}
?>
<!DOCTYPE html>
<html>
  <head>
  <title>Big Five Inventory</title>
	<meta charset="utf-8" />
  <meta http-equiv="expires" content="<?php echo date('r');?>" />
  <meta http-equiv="pragma" content="no-cache" />
  <meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta http-equiv="content-language" content="en" />
	<meta name="author" content="Cahya DSN" />
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
	<meta name="keywords" content="Big, Five, Inventory, BFI, personality, test" />
	<meta name="description" content="Big Five Inventory ver <?php echo $version;?> created by cahya dsn" />
	<meta name="robots" content="index, follow" />
	<link rel="shortcut icon" href="<?php echo _ASSET;?>img/favicon.ico" type="image/x-icon">
	<?php if(defined('_ISONLINE') && _ISONLINE):?>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-<?php echo $c;?>.css" media="all" id="bfi_en_css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	<?php else:?>
	<link rel="stylesheet" href="<?php echo _ASSET;?>css/w3/w3.css">
	<link rel="stylesheet" href="<?php echo _ASSET;?>css/w3/w3-theme-<?php echo $c;?>.css" media="all" id="bfi_en_css">
	<?php endif;?>
  <link rel="stylesheet" href="<?php echo _ASSET;?>css/bfi.css">
  <script src="<?php echo _ASSET;?>js/zepto.min.js"></script>
</head>
<body>
<div class="w3-top">
  <div class="w3-bar w3-theme-d5" id="top_panel">
    <span class="w3-bar-item"># BFI v<?php echo $version;?></span>
    <a href="index.php" class="w3-bar-item w3-button">Home</a>
		<div class="w3-dropdown-hover">
		  <button class="w3-button">Themes</button>
		  <div class="w3-dropdown-content w3-white w3-card-4" id="theme">
				<?php
				$color=array("black","red","yellow","green","blue");
				foreach($color as $c){
					echo "<a href='#' class='w3-bar-item w3-button w3-{$c} color' data-value='{$c}'> </a>";
				}
				?>
			</div>
		</div>
	</div>
</div>
<div class="w3-container">
  <form action='result.php' method='post' id='bfi'>
	<input type="hidden" id="page" value="0">
  <div class="w3-card-4">
    <div class='w3-container'>
      <h2>&nbsp;</h2>
      <h2 class="w3-text-theme">Big Five Inventory</h1>
      <div class="w3-row">
        <div class="w3-col s12" id='main'>
        The Big Five is different from other popular personality systems because its model is based on traits rather than types. The Big Five categorizes an inventory of related descriptive personality traits into a spectrum of five common dimensions: Openness, Conscientiousness, Extraversion, Agreeableness, and Neuroticism. We each have varying levels of these key personality factors that impact our thoughts, decisions, and behavior.
          <div class="w3-container w3-section w3-theme-l3">
            <span onclick="this.parentElement.style.display='none'" class="w3-closebtn" style='float:right;'>x</span>
            <h3>Instructions</h3>
            <p>It is important that you answer all the questions from the perspective of what feels real for you and not try to give answers that you think would sound like how you should behave in any particular situation. The objective is to understand yourself as you really are – not the way, for example, you must react in your job, or others expect you to behave. Effectiveness as an individual or leader is not based on any particular personality style. It is really about how well you know yourself and others</p>
            <p>There are five choices for each question, which is have number 1 to 5 with meaning : (1) Absolutely (2) Kinda (3) 50/50 (4) Not Really and {5) Not at All. There are no right or wrong answers – all of the population agrees with whatever choice you make.</p>
          </div>
        </div>
        <h6>&nbsp;</h6>
      </div>
      <div class="w3-row">
        <table class="w3-table w3-striped">
          <thead>
          <tr class="w3-theme-d3">
            <th rowspan='2'>No</th>
            <th rowspan='2'>Statements</th>
            <th colspan='5'>Options</th>
          </tr>
          <tr class="w3-theme-d2">
            <th title='Absolutely'>1</th>
            <th title='Kinda'>2</th>
            <th title='50/50'>3</th>
            <th title='Not Really'>4</th>
            <th title='Not at All'>5</th>
          </tr>
          </thead>
          <tbody id='p0'>
          <?php
          $no=0;
          foreach($data as $d){
            echo "
            <tr style='border-top:solid 1px #999;'>
              <td style='width:30px !important;'>".++$no."</td>
              <td class='right'>{$d->statement}</td>
              <td style='padding-left:16px !important;width:30px !important;' class='incomplete' title='absolutely'><input type='radio' name='d[{$d->id}]' value='1' class='w3-radio' /></td>
              <td style='padding-left:16px !important;width:30px !important;' class='incomplete' title='Kinda'><input type='radio' name='d[{$d->id}]' value='2' class='w3-radio' /></td>
              <td style='padding-left:16px !important;width:30px !important;' class='incomplete' title='50/50'><input type='radio' name='d[{$d->id}]' value='3' class='w3-radio' /></td>
              <td style='padding-left:16px !important;width:30px !important;' class='incomplete' title='Not Really'><input type='radio' name='d[{$d->id}]' value='4' class='w3-radio' /></td>
              <td style='padding-left:16px !important;width:30px !important;' class='incomplete' title='Not at All'><input type='radio' name='d[{$d->id}]' value='5' class='w3-radio' /></td>
            </tr>
               ";
            if($no%$num_perpage==0) {
            echo "</tbody><tbody style='display:none' id='p".round($no/$num_perpage)."'>";
            }
          }
          ?>
          </tbody>
        </table>
      </div>
      <div class="w3-row">
        <h6>&nbsp;</h6>
        <div class="w3-col w3-right-align s4 m2 w3-padding">
          <button class="w3-button w3-round-large w3-theme-d1 w3-margin-8 w3-disabled" id="btn_back" disabled>prev</button>
        </div>
        <div class="w3-col s4 m2 w3-padding">
          <button class="w3-button w3-round-large w3-theme-d1 w3-margin-8" id="btn_next">next</button>
        </div>
        <div class="w3-col s4 m8 w3-padding">
          <input type='submit' value='process' id='btn_kirim' class='w3-button w3-round-large w3-theme-d1 w3-right w3-margin-8 w3-disabled' disabled/>
        </div>
      </div>
      <h6>&nbsp;</h6>
      <div class='w3-theme-l2 w3-padding'><b>source code (v1.0) </b> : <a href='https://github.com/cahyadsn/bfi'>https://github.com/cahyadsn/bfi</a></div>
        <h2>&nbsp;</h2>
    </div>
  </div>
	</form>
</div>
<div class="w3-bottom">
	<div class="w3-bar w3-theme-d4 w3-center w3-padding">
		Big Five Inventory v<?php echo $version;?> copyright &copy; 2025<?php echo (date('Y')>2025?date('-Y'):'');?> by <a href='mailto:cahyadsn@gmail.com'>cahya dsn</a><br />
	</div>
</div>
<div id="warning" class="w3-modal">
  <div class="w3-modal-content">
    <header class="w3-container w3-red">
      <span onclick="document.getElementById('warning').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
      <h2>Warning</h2>
    </header>
    <div class="w3-container">
      <p id='msg'></p>
    </div>
    <footer class="w3-container w3-border-top w3-padding-16 w3-light-grey">
      <a href='#' onclick="document.getElementById('warning').style.display='none'" class="w3-button w3-grey">close</a>
    </footer>
  </div>
</div>
<script src="<?php echo _ASSET;?>js/bfi.php?v=<?php echo md5(filemtime(_ASSET.'js/bfi.php'));?>"></script>
</body>
</html>