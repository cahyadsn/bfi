<?php
/*
================================================================================
 *  BISMILLAAHIRRAHMAANIRRAHIIM - In the Name of Allah, Most Gracious, Most Merciful
================================================================================
FILENAME      : assets/js/change.color.php
AUTHOR        : CAHYA DSN
CREATED DATE  : 2025-02-02 17:27:23
UPDATED DATE  : 2025-02-03 17:30:06
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
  $.post(aset+'/js/change.color.php',{'color':color},function(d){
    const element = document.getElementById('#top_panel');
    const style = window.getComputedStyle(element);
    const clr = style.backgroundColor;
    console.log(clr);
  });
});

$('.w3-radio').on('click',function(){
	$(this).parent().prev().removeClass('incomplete');
	$(this).parent().parent().prev().children().removeClass('incomplete');
});

// Questionnaire Validation
$('#btn_kirim').on('click',function(e){
    let answered = 0;
    // Remove incomplete class from all questions
    //$('form[name="bfi"] td, form[name="bfi"] th').removeClass('incomplete');
    // Check does we have 44 options selected
		for ( i=1; i<45; i++ ) {
			// count answered questions
			if ( $('form[id="bfi"] input[type="radio"][name^="d['+i+']"]:checked').length == 1 ) {
				answered++;
			} else {
				//$('form[id="bfi"] input[type="radio"][name^="d['+i+']"]').each(function(i){
				//	$(this).parent().prev().addClass('incomplete');
				//});
			}
		}
    if ( answered != 44 ) {
      // Prevent form submission
      e.preventDefault();
      // Display message
      $('#msg').html('You have answered '+answered+' out of 44 questions.<br>\nPlease review questionnaire and answer marked questions.');
      $('#warning').show();
  }
});

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