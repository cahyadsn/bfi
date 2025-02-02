<?php
/*
================================================================================
 *  BISMILLAAHIRRAHMAANIRRAHIIM - In the Name of Allah, Most Gracious, Most Merciful
================================================================================
FILENAME      : assets/js/change.color.php
AUTHOR        : CAHYA DSN
CREATED DATE  : 2025-02-02 17:27:23
UPDATED DATE  : 2025-02-02 17:27:29
DEMO SITE     : https://psycho.cahyadsn.com/bfi
SOURCE CODE   : https://github.com/cahyadsn/bfi
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
header("Content-type: text/javascript");
if(!defined('_ASSET')) define('_ASSET','assets/');
echo "var aset='"._ASSET."';";
?>
$('#btn_back').on('click',function(e){
	e.preventDefault();
	$('tbody[id^="p"]').hide();
	var h=$('input#page').val()*1-1;
	$('input#page').val(h);
	$('tbody[id="p'+h+'"]').show();
	if(h==0){
		$(this).addClass('w3-disabled').prop("disabled", true);
	}
	if( h < 6 ){
		$('#btn_next').removeClass('w3-disabled').prop("disabled", false);
		$('#btn_kirim').addClass('w3-disabled').prop("disabled", true);
	}
});
$('#btn_next').on('click',function(e){
	e.preventDefault();
	$('tbody[id^="p"]').hide();
	var p=$('input#page').val()*1+1;
	$('input#page').val(p);
	$('tbody[id="p'+p+'"]').show();
	if(p>=0){
		$('#btn_back').removeClass('w3-disabled').prop("disabled", false);
	}
	if( p == 6 ){
		$(this).addClass('w3-disabled').prop("disabled", true);;
		$('#btn_kirim').removeClass('w3-disabled').prop("disabled", false);
	}
});
$('a.color').click(function(){
  var color=$(this).attr('data-value');
  <?php if(defined('_ISONLINE') && _ISONLINE):?>
  document.getElementById('bfi_en_css').href='https://www.w3schools.com/lib/w3-theme-'+color+'.css';
  <?php else:?>
  document.getElementById('bfi_en_css').href=aset+'/css/w3/w3-theme-'+color+'.css';
  <?php endif;?>
  $.post(aset+'/js/change.color.php',{'color':color});
});

$('.w3-radio').on('click',function(){
	$(this).parent().prev().removeClass('incomplete');
	$(this).parent().parent().prev().children().removeClass('incomplete');
});

// Questionnaire Validation
$('form[name="bfi"] input[type="submit"]').on('click',function(e){
    var answered = 0;
    // Remove incomplete class from all questions
    $('form[name="bfi"] td, form[name="bfi"] th').removeClass('incomplete');
    // Check does we have 44 options selected
    for ( i=1; i<=44; i++ ) {
      // count answered questions
      if ( $('form[name="bfi"] input[type="radio"][name^="m['+i+']"]:checked').length == 1 && $('form[name="bfi"] input[type="radio"][name^="l['+i+']"]:checked').length == 1 ) {
        answered++;
      } else {
        $('form[name="bfi"] input[type="radio"][name^="m['+i+']"]').each(function(i){
          // Traverse to previous 2 siblings only for first control
          if ( i == 0 ) {
            $(this).parent().addClass('incomplete').prev().addClass('incomplete').prev().addClass('incomplete');
          } else {
            $(this).parent().addClass('incomplete').prev().addClass('incomplete');
          }
        });
      }
    }
    if ( answered != 44 ) {
      // Prevent form submission
      e.preventDefault();
      // Display message
      $('#msg').html('You have answered '+answered+' out of 28 questions.<br>\nPlease review questionnaire and answer marked questions.');
      $('#warning').show();
  }
});

function openTabs(evt, tabName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("tabs");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
     tablinks[i].className = tablinks[i].className.replace(" w3-border-theme", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-border-theme";
}

function exportToPDF(){
    var doc = new jsPDF();
    doc.setFontSize(20);
    doc.myText('bfi',{align: "center"},35,25);
    doc.setFontSize(10);
    doc.myText('Overview\nWelcome! You\'ve just completed the first step of bfi Classic. You are now on your way toward\nincreased self-awarness and personal effectiveness. Your report is organized into three main sections:\n\nSECTION I is devoted entirely to you and your unique behavioral style based on your responses to\nbfi Classic. First you will see your bfi Graph, the basis of your feedback. Then, in Stage 1, you\nwilllearn about your Highest bfi Dimension and your tendencies, needs, preferred environment,\nand strategies for effectiveness. In Stage 2 you ll be able to explore your Intensity Index to become\nmore aware of your potential strengths and weaknesses. Stage 3 will help you bfiover how your\nD, i, S, and C dimensions combine to form your unique Classical Profile Pattern.\n\nSECTION II covers the bfi model and description of the four bfi Dimensions with corresponding\ntendencies, need, preferred environments, and effectiveness strategies for each.\n\nSECTION III provides the scoring and data analysis behind your report\n\nAs you read your report, please keep in mind that no dimension or pattern in bfi CLassic is better or\nworse than another and there are no right or wrong answer. Rather, the report shows your unique\nresponses to your environment. You may want to read your report through once, then use a pen or\nhighlighter to customize the results by crossing out any statements that don\'t apply and highlighting all\nthose that do.\n\nNow, let\'s get started',{align:"left"},35,50);
    doc.myText('bfi v0.1 copyright \u00a9 2025<?php echo date('Y')>2025?'-'.date('Y'):''?> by cahyadsn',{align: "center"},35,290);
    doc.save("bfi_classic.pdf");
}

$('#btn1').on('click',function(){
    var check=1;
    if($('#name').val()=='') check=0;
    if($('#email').val()=='') check=0;
    if(check==1){
        /*$.post('inc/check.php',{email:$('#email').val()},function(data){
            var d=$.parseJSON(data);
            console.log(d.status);
            if(d.status=='ada'){
                alert('data sudah ada');
                document.location.replace('final.php?recall');
            }else{*/
                $('#intro').hide();
                $('#btn1_1').hide();
                $('#intro1').hide();
                $('#intro2').hide();
                $('#instruct').show();
                $('#test').show();
                $('#nav').show();
        /*    }
        });*/
    }else{
      $('#msg').html('Please fulfill your personal information first.');
      $('#warning').show();
    }
});