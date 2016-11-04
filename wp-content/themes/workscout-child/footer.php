<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WorkScout
 */

?>
<!-- Footer
================================================== -->
<div class="margin-top-45"></div>

<div id="footer">
<!-- Main -->
	<div class="container">
		<?php 
		$footer_layout = Kirki::get_option( 'workscout', 'pp_footer_widgets' ); 
        $footer_layout_array = explode(',', $footer_layout); 
        $x = 0;
        foreach ($footer_layout_array as $value) {
            $x++;
             ?>
             <div class="<?php echo esc_attr(workscout_number_to_width($value)); ?> columns">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer'.$x)) : endif; ?>
            </div>
        <?php } ?>
	</div>

	<!-- Bottom -->
	<div class="container">
		<div class="footer-bottom">
			<div class="sixteen columns">
				
                <?php /* get the slider array */
                $footericons = ot_get_option( 'pp_footericons', array() );
                if ( !empty( $footericons ) ) {
                    echo '<h4>'.esc_html__('Follow us','workscout').'</h4>';
                    echo '<ul class="social-icons">';
                    foreach( $footericons as $icon ) {
                        echo '<li><a class="' . $icon['icons_service'] . '" title="' . esc_attr($icon['title']) . '" href="' . esc_url($icon['icons_url']) . '"><i class="icon-' . $icon['icons_service'] . '"></i></a></li>';
                    }
                    echo '</ul>';
                }
                ?>
				
				<div class="copyrights"><?php $copyrights = Kirki::get_option( 'workscout', 'pp_copyrights' ); 
		        if (function_exists('icl_register_string')) {
		            icl_register_string('Copyrights in footer','copyfooter', $copyrights);
		            echo icl_t('Copyrights in footer','copyfooter', $copyrights);
		        } else {
		            echo wp_kses($copyrights,array('br' => array(),'em' => array(),'strong' => array(),));
		        } ?></div>
			</div>
		</div>
	</div>

</div>

<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>

</div>
<!-- Wrapper / End -->

<!--script src="<?php //echo get_template_directory_uri() ?>/js/bookmark-action.js"></script-->
<script>
function addBookmark(ob, id){
	jQuery.ajax({
		url: '<?php echo get_template_directory_uri(); ?>/ajax/bookmark.php',
		dataType: 'html',
		type: 'post',
		data: { "action": "add", "post_id": id },
		beforeSend: function(){
			jQuery(".listings-loader").show();
		},
		success: function(data){
			if(data == 'success'){
				jQuery(ob).parent().html('<a href="javascript:void(0)" class="remove-bookmark button dark" onclick="removeBookmark(this,'+id+')"><i class="fa fa-star"></i>Remove Bookmark</a>');
				jQuery(".listings-loader").hide();
			}
		}
	});
}
function removeBookmark(ob, id){
	jQuery.ajax({
		url: '<?php echo get_template_directory_uri(); ?>/ajax/bookmark.php',
		dataType: 'html',
		type: 'post',
		data: { "action": "remove", "post_id": id  },
		beforeSend: function(){
			jQuery(".listings-loader").show();
		},
		success: function(data){
			if(data == 'success'){
				jQuery(ob).parent().html('<a href="javascript:void(0)" class="add-bookmark button" onclick="addBookmark(this,'+id+')"><i class="fa fa-star"></i>Add Bookmark</a>');
				jQuery(".listings-loader").hide();
			}			
		}
	});
}
</script>
<?php if ( is_page_template( 'template-contact.php' ) ) { ?>
<script type="text/javascript">
(function($){
    $(document).ready(function(){
	   
        $('#googlemaps').gMap({
            maptype: '<?php echo ot_get_option('pp_contact_maptype','ROADMAP') ?>',
            scrollwheel: false,
            zoom: <?php echo ot_get_option('pp_contact_zoom',13) ?>,
            markers: [
                <?php $markers = ot_get_option('pp_contact_map');
                if(!empty($markers)) {
                    $allowed_tags = wp_kses_allowed_html( 'post' );
                    foreach ($markers as $marker) { 
                        $str = str_replace(array("\n", "\r"), '', $marker['content']);?>
                    {
                        address: '<?php echo esc_js($marker['address']); ?>', // Your Adress Here
                        html: '<strong style="font-size: 14px;"><?php echo esc_js($marker['title']); ?></strong></br><?php echo wp_kses($str,$allowed_tags); ?>',
                        popup: true,
                    },
                    <?php }
                } ?>
                    ],
                });
    });
})(this.jQuery);


</script>
<?php } //eof is_page_template ?>
<?php wp_footer(); ?>

</body>
</html>


<script>
(function(e){e.fn.priceFormat=function(t){var n={prefix:"US$ ",suffix:"",centsSeparator:".",thousandsSeparator:",",limit:false,centsLimit:2,clearPrefix:false,clearSufix:false,allowNegative:false,insertPlusSign:false,clearOnEmpty:false};var t=e.extend(n,t);return this.each(function(){function m(e){if(n.is("input"))n.val(e);else n.html(e)}function g(){if(n.is("input"))r=n.val();else r=n.html();return r}function y(e){var t="";for(var n=0;n<e.length;n++){char_=e.charAt(n);if(t.length==0&&char_==0)char_=false;if(char_&&char_.match(i)){if(f){if(t.length<f)t=t+char_}else{t=t+char_}}}return t}function b(e){while(e.length<l+1)e="0"+e;return e}function w(t,n){if(!n&&(t===""||t==w("0",true))&&v)return"";var r=b(y(t));var i="";var f=0;if(l==0){u="";c=""}var c=r.substr(r.length-l,l);var h=r.substr(0,r.length-l);r=l==0?h:h+u+c;if(a||e.trim(a)!=""){for(var m=h.length;m>0;m--){char_=h.substr(m-1,1);f++;if(f%3==0)char_=a+char_;i=char_+i}if(i.substr(0,1)==a)i=i.substring(1,i.length);r=l==0?i:i+u+c}if(p&&(h!=0||c!=0)){if(t.indexOf("-")!=-1&&t.indexOf("+")<t.indexOf("-")){r="-"+r}else{if(!d)r=""+r;else r="+"+r}}if(s)r=s+r;if(o)r=r+o;return r}function E(e){var t=e.keyCode?e.keyCode:e.which;var n=String.fromCharCode(t);var i=false;var s=r;var o=w(s+n);if(t>=48&&t<=57||t>=96&&t<=105)i=true;if(t==8)i=true;if(t==9)i=true;if(t==13)i=true;if(t==46)i=true;if(t==37)i=true;if(t==39)i=true;if(p&&(t==189||t==109||t==173))i=true;if(d&&(t==187||t==107||t==61))i=true;if(!i){e.preventDefault();e.stopPropagation();if(s!=o)m(o)}}function S(){var e=g();var t=w(e);if(e!=t)m(t);if(parseFloat(e)==0&&v)m("")}function x(){n.val(s+g())}function T(){n.val(g()+o)}function N(){if(e.trim(s)!=""&&c){var t=g().split(s);m(t[1])}}function C(){if(e.trim(o)!=""&&h){var t=g().split(o);m(t[0])}}var n=e(this);var r="";var i=/[0-9]/;if(n.is("input"))r=n.val();else r=n.html();var s=t.prefix;var o=t.suffix;var u=t.centsSeparator;var a=t.thousandsSeparator;var f=t.limit;var l=t.centsLimit;var c=t.clearPrefix;var h=t.clearSuffix;var p=t.allowNegative;var d=t.insertPlusSign;var v=t.clearOnEmpty;if(d)p=true;n.bind("keydown.price_format",E);n.bind("keyup.price_format",S);n.bind("focusout.price_format",S);if(c){n.bind("focusout.price_format",function(){N()});n.bind("focusin.price_format",function(){x()})}if(h){n.bind("focusout.price_format",function(){C()});n.bind("focusin.price_format",function(){T()})}if(g().length>0){S();N();C()}})};e.fn.unpriceFormat=function(){return e(this).unbind(".price_format")};e.fn.unmask=function(){var t;var n="";if(e(this).is("input"))t=e(this).val();else t=e(this).html();for(var r in t){if(!isNaN(t[r])||t[r]=="-")n+=t[r]}return n}})(jQuery)



/*!
 * accounting.js v0.4.2, copyright 2014 Open Exchange Rates, MIT license, http://openexchangerates.github.io/accounting.js
 */




jQuery(document).ready(function(){




     var div=jQuery('#main-header');
    var start=jQuery(div).offset().top;

    jQuery.event.add(window,'scroll',function(){
	     
        var p=jQuery(window).scrollTop();
		if(p>start){
		jQuery('#main-header').addClass('sticky');
		}
		else{
		jQuery('#main-header').removeClass('sticky');
		}
		//jQuery(div).css('position',(p>start)?'fixed':'static');
        
        //jQuery(div).css('top',(p>start)?'0px':'');

    }); 

if(window.location.href.indexOf("job") > -1 && window.location.href.indexOf("post-a-job-2") == -1 && window.location.href.indexOf("browse-jobs") == -1 ) {

    var ob = jQuery('.fa-money').next();
var str = ob.find('span').html();
var regex = /[+-]?\d+(\.\d+)?/g;
var prices = str.match(regex).map(function(v) { return parseFloat(v); });
var i =0;
var num, str1='';
while(prices.length > i){
  num = '$' + prices[i].toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
  if(i==0){
    str1 += num;
  }
  else{
  str1 += ' - ' +num;
  }
  
   
  ++i;
  
}

ob.find('span').html(str1); 
       
    }






jQuery(window).load(function() 
{
  jQuery('#candidate_rate_min').priceFormat();
  
  jQuery('#candidate_rate_min').priceFormat({
    prefix: '$'
    });
	 jQuery('#rate_min').priceFormat();
  
  jQuery('#rate_min').priceFormat({
    prefix: '$'
    
});

 jQuery('#rate_max').priceFormat();
  
  jQuery('#rate_max').priceFormat({
    prefix: '$'
    
});
  jQuery('#salary_min').priceFormat();
  
  jQuery('#salary_min').priceFormat({
    prefix: '$'
    
});
 jQuery('#salary_max').priceFormat();
  
  jQuery('#salary_max').priceFormat({
    prefix: '$'
    
});



});
});



/* jQuery('#rate_min').load(function() 
{
  jQuery('#rate_min').priceFormat();
  
  jQuery('#rate_min').priceFormat({
    prefix: '$'
    
});
});

jQuery('#rate_max').load(function() 
{
  jQuery('#rate_max').priceFormat();
  
  jQuery('#rate_max').priceFormat({
    prefix: '$'
    
});
});



jQuery('#salary_min').load(function() 
{
  jQuery('#salary_min').priceFormat();
  
  jQuery('#salary_min').priceFormat({
    prefix: '$'
    
});
});

jQuery('#salary_max').load(function() 
{
  jQuery('#salary_max').priceFormat();
  
  jQuery('#salary_max').priceFormat({
    prefix: '$'
    
});
});




}); */

</script>


<style>
.checkboxes
{

display:none;
}
<style>

</style>
