<?php
/*
Section: BigText
Author: Clifford Paulick
Author URI: http://tourkick.com/?utm_source=pagelines&utm_medium=section&utm_content=authoruri&utm_campaign=bigtext_section
Plugin URI: http://www.pagelinestheme.com/bigtext-section?utm_source=pagelines&utm_medium=section&utm_content=pluginuri&utm_campaign=bigtext_section
Version: 1.0.20130320
Description: A <a href="https://github.com/zachleat/BigText" target="_blank">BigText</a> section that resizes text to fit one or more words on a line that fits the container, and is responsive which means it scales with different size browsers. Like <a href="www.pagelines.com/store/sections/fittext-section/" target="_blank">FitText</a> but more customizable! <a href="http://www.zachleat.com/web/fittext-and-bigtext/" target="_blank">BigText vs FitText</a>
Demo: http://www.pagelinestheme.com/bigtext-section?utm_source=pagelines&utm_medium=section&utm_content=demolink&utm_campaign=bigtext_section
External: http://tourkick.com/?utm_source=pagelines&utm_medium=section&utm_content=externallink&utm_campaign=bigtext_section
Class Name: BigTextSection
Workswith: templates, main, sidebar1, sidebar2, sidebar_wrap, header, footer, morefoot
Cloning: false
*/

class BigTextSection extends PageLinesSection {


	function section_styles(){
		// BigText version 1.2, from https://github.com/zachleat/BigText#releases
		wp_enqueue_script('bigtext', $this->base_url.'/bigtext.js', array( 'jquery' ), '1.2');

	}


	function section_head( $clone_id ){


		$prefix = ($clone_id != '') ? '.clone_'.$clone_id : ''; //cloning = false because I noticed issues during testing, but it would fix itself once you click to Inspect Element

		// pull in the options, since they're from another function
        global $pagelines_ID;
        $oset = array('post_id' => $pagelines_ID);


		// commented out since the .js sets it to 528 already //$maxfontsize = ploption('bigtext-maxfontsize', $this->oset) ? ploption('bigtext-maxfontsize', $this->oset) : '528';
		$maxfontsize = ploption('bigtext-maxfontsize', $this->oset);
		$minfontsize = ploption('bigtext-minfontsize', $this->oset);

		// allow only numbers
		$maxfontsize = preg_replace("/[^0-9]/","",$maxfontsize);
		$minfontsize = preg_replace("/[^0-9]/","",$minfontsize);
		?>

		<script type="text/javascript">
		/*<![CDATA[*/
			jQuery(document).ready(function(){

				jQuery('<?php echo $prefix;?> #bigtext').bigtext({
					<?php
					// FYI: https://github.com/zachleat/BigText#change-the-default-min-starting-font-size

					if(empty($maxfontsize) && empty($minfontsize)) {
						echo "";
					} elseif(!empty($maxfontsize) && !empty($minfontsize)) {
						echo "maxfontsize: $maxfontsize, minfontsize: $minfontsize";
					} elseif(!empty($maxfontsize)) {
						echo "maxfontsize: $maxfontsize";
					} else{
						echo "minfontsize: $minfontsize";
					}
					?>
				});

			});
		/*]]>*/</script>

		<?php

		echo load_custom_font( ploption('bigtext-font', $this->oset), $prefix.' #bigtext' );

	}



	function section_optionator( $settings ){

		$settings = wp_parse_args($settings, $this->optionator_default);

		$options = array(
		'bigtext-text' => array(
			'type'		=> 'multi_option',
			'title'		=> 'Enter your BigText here',
			'shortexp'	=> 'Everything you enter per line will resize to fill the entire width. Blank lines will be skipped.',
			'selectvalues'	=> array(
				'bigtext-text-0'	=> array(
					'type'			=> 'text',
					'inputlabel'	=> 'Line 0 Text <em>(Required)</em>'
				),
				'bigtext-text-1'	=> array(
					'type'			=> 'text',
					'inputlabel'	=> 'Line 1 Text'
				),
				'bigtext-text-2'	=> array(
					'type'			=> 'text',
					'inputlabel'	=> 'Line 2 Text'
				),
				'bigtext-text-3'	=> array(
					'type'			=> 'text',
					'inputlabel'	=> 'Line 3 Text'
				),
				'bigtext-text-4'	=> array(
					'type'			=> 'text',
					'inputlabel'	=> 'Line 4 Text'
				),
				'bigtext-text-5'	=> array(
					'type'			=> 'text',
					'inputlabel'	=> 'Line 5 Text'
				),
				'bigtext-text-6'	=> array(
					'type'			=> 'text',
					'inputlabel'	=> 'Line 6 Text'
				),
				'bigtext-text-7'	=> array(
					'type'			=> 'text',
					'inputlabel'	=> 'Line 7 Text'
				),
				'bigtext-text-8'	=> array(
					'type'			=> 'text',
					'inputlabel'	=> 'Line 8 Text'
				),
				'bigtext-text-9'	=> array(
					'type'			=> 'text',
					'inputlabel'	=> 'Line 9 Text'
				)
			  )
			),
		'bigtext-colors' => array(
			'type'		=> 'color_multi',
			'title'		=> 'Choose the color of each BigText line <em>(Optional)</em>',
			'shortexp'	=> 'If there is no value set above, this will be disregarded',
			'selectvalues'	=> array(
				'bigtext-color-0'	=> array(
					'css_prop'		=> 'color',
					'cssgroup'		=> 'bigtextcolor',
					'inputlabel' 	=> 'Line 0 Color'
				),
				'bigtext-color-1'	=> array(
					'css_prop'		=> 'color',
					'cssgroup'		=> 'bigtextcolor',
					'inputlabel' 	=> 'Line 1 Color'
				),
				'bigtext-color-2'	=> array(
					'css_prop'		=> 'color',
					'cssgroup'		=> 'bigtextcolor',
					'inputlabel' 	=> 'Line 2 Color'
				),
				'bigtext-color-3'	=> array(
					'css_prop'		=> 'color',
					'cssgroup'		=> 'bigtextcolor',
					'inputlabel' 	=> 'Line 3 Color'
				),
				'bigtext-color-4'	=> array(
					'css_prop'		=> 'color',
					'cssgroup'		=> 'bigtextcolor',
					'inputlabel' 	=> 'Line 4 Color'
				),
				'bigtext-color-5'	=> array(
					'css_prop'		=> 'color',
					'cssgroup'		=> 'bigtextcolor',
					'inputlabel' 	=> 'Line 5 Color'
				),
				'bigtext-color-6'	=> array(
					'css_prop'		=> 'color',
					'cssgroup'		=> 'bigtextcolor',
					'inputlabel' 	=> 'Line 6 Color'
				),
				'bigtext-color-7'	=> array(
					'css_prop'		=> 'color',
					'cssgroup'		=> 'bigtextcolor',
					'inputlabel' 	=> 'Line 7 Color'
				),
				'bigtext-color-8'	=> array(
					'css_prop'		=> 'color',
					'cssgroup'		=> 'bigtextcolor',
					'inputlabel' 	=> 'Line 8 Color'
				),
				'bigtext-color-9'	=> array(
					'css_prop'		=> 'color',
					'cssgroup'		=> 'bigtextcolor',
					'inputlabel' 	=> 'Line 9 Color'
				)
			  )
			),
		'bigtext-exempt' => array(
			'type'		=> 'multi_option',
			'title'		=> 'You may exempt specific lines, if you choose',
			'shortexp'	=> 'Check the box next to the line(s) you want to exempt from applying BigText.<br/>They will still be colored, just not have the BigText font sizing.',
			'selectvalues'	=> array(
				'bigtext-exempt-0'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> 'Exempt Line 0'
				),
				'bigtext-exempt-1'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> 'Exempt Line 1'
				),
				'bigtext-exempt-2'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> 'Exempt Line 2'
				),
				'bigtext-exempt-3'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> 'Exempt Line 3'
				),
				'bigtext-exempt-4'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> 'Exempt Line 4'
				),
				'bigtext-exempt-5'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> 'Exempt Line 5'
				),
				'bigtext-exempt-6'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> 'Exempt Line 6'
				),
				'bigtext-exempt-7'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> 'Exempt Line 7'
				),
				'bigtext-exempt-8'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> 'Exempt Line 8'
				),
				'bigtext-exempt-9'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> 'Exempt Line 9'
				)
			  )
			),
		'bigtext-configure' => array(
			'type'		=> 'multi_option',
			'title'		=> 'Enter your BigText configuration settings here',
			'shortexp'	=> 'Control it',
			'selectvalues'	=> array(
				'bigtext-font'	=> array(
					'type'			=> 'fonts',
					'inputlabel'	=> 'Choose Font',
					'exp'			=> 'This font will be used in this BigText area. If left blank, the default font will be used.',
					'shortexp'		=> 'Select BigText Font'
				),
				'bigtext-width'	=> array(
					'type'			=> 'text_small',
					'inputlabel'	=> 'Width of BigText area.<br/>Default = <em>100%</em><br/><a href="https://developer.mozilla.org/en-US/docs/CSS/width" target="_blank">CSS width</a>'
				),
				'bigtext-max-width'	=> array(
					'type'			=> 'text_small',
					'inputlabel'	=> 'Max-Width of BigText area.<br/>Default = <em>100%</em> (which makes it responsive)<br/><a href="https://developer.mozilla.org/en-US/docs/CSS/max-width" target="_blank">CSS max-width</a>'
				),
				'bigtext-line-height'	=> array(
					'type'			=> 'text_small',
					'inputlabel'	=> 'BigText Line-Height (e.g. 0.9).<br/>Default = <em>1</em><br/><a href="https://developer.mozilla.org/en-US/docs/CSS/line-height" target="_blank">CSS line-height</a>'
				),
				'bigtext-margin'	=> array(
					'type'			=> 'text_small',
					'inputlabel'	=> 'BigText area margin (e.g. 0).<br/>Default = <em>auto</em> (which makes it centered to its page/container)<br/><a href="https://developer.mozilla.org/en-US/docs/CSS/margin" target="_blank">CSS margin</a>'
				),
				'bigtext-text-align'	=> array(
					'type'			=> 'text_small',
					'inputlabel'	=> 'BigText Text-Align (e.g. justify).<br/>Default = <em>center</em><br/><a href="https://developer.mozilla.org/en-US/docs/CSS/text-align" target="_blank">CSS text-align</a>'
				),
				'bigtext-maxfontsize'	=> array(
					'type'			=> 'text_small',
					'inputlabel'	=> 'Max Font-Size (MUST BE IN PX, with or w/o "px")<br/>Default = <em>528</em>'
				),
				'bigtext-minfontsize'	=> array(
					'type'			=> 'text_small',
					'inputlabel'	=> 'Min Font-Size (MUST BE IN PX, with or w/o "px")<br/>Default = Null/Zero'
				)
			  )
			)
		);

		$tab_settings = array(
			'id'		=> 'bigtext-options',
			'name'		=> 'BigText',
			'icon'		=> $this->icon,
			'clone_id'	=> $settings['clone_id'],
			'active'	=> $settings['active']
		);

		register_metatab($tab_settings, $options, $this->class_name);

	}


	function section_template(){

		if(!ploption('bigtext-text-0', $this->oset)){
			echo setup_section_notify($this, __('Please set up BigText text by at least entering a value for "BigText Line 0 Text".'));
			return;
		}

		// text
		// cannot do esc_html() to protect input on all these because then HTML will not work -- so do not insert your own malicious scripts ;-)
		$text0 = ploption('bigtext-text-0', $this->oset);
			$text0 = do_shortcode($text0);
		$text1 = ploption('bigtext-text-1', $this->oset);
			$text1 = do_shortcode($text1);
		$text2 = ploption('bigtext-text-2', $this->oset);
			$text2 = do_shortcode($text2);
		$text3 = ploption('bigtext-text-3', $this->oset);
			$text3 = do_shortcode($text3);
		$text4 = ploption('bigtext-text-4', $this->oset);
			$text4 = do_shortcode($text4);
		$text5 = ploption('bigtext-text-5', $this->oset);
			$text5 = do_shortcode($text5);
		$text6 = ploption('bigtext-text-6', $this->oset);
			$text6 = do_shortcode($text6);
		$text7 = ploption('bigtext-text-7', $this->oset);
			$text7 = do_shortcode($text7);
		$text8 = ploption('bigtext-text-8', $this->oset);
			$text8 = do_shortcode($text8);
		$text9 = ploption('bigtext-text-9', $this->oset);
			$text9 = do_shortcode($text9);

		// colors
		$color0 = ploption('bigtext-color-0', $this->oset);
		$color1 = ploption('bigtext-color-1', $this->oset);
		$color2 = ploption('bigtext-color-2', $this->oset);
		$color3 = ploption('bigtext-color-3', $this->oset);
		$color4 = ploption('bigtext-color-4', $this->oset);
		$color5 = ploption('bigtext-color-5', $this->oset);
		$color6 = ploption('bigtext-color-6', $this->oset);
		$color7 = ploption('bigtext-color-7', $this->oset);
		$color8 = ploption('bigtext-color-8', $this->oset);
		$color9 = ploption('bigtext-color-9', $this->oset);

		// exempt
		$exempt0 = ploption('bigtext-exempt-0', $this->oset);
		$exempt1 = ploption('bigtext-exempt-1', $this->oset);
		$exempt2 = ploption('bigtext-exempt-2', $this->oset);
		$exempt3 = ploption('bigtext-exempt-3', $this->oset);
		$exempt4 = ploption('bigtext-exempt-4', $this->oset);
		$exempt5 = ploption('bigtext-exempt-5', $this->oset);
		$exempt6 = ploption('bigtext-exempt-6', $this->oset);
		$exempt7 = ploption('bigtext-exempt-7', $this->oset);
		$exempt8 = ploption('bigtext-exempt-8', $this->oset);
		$exempt9 = ploption('bigtext-exempt-9', $this->oset);


		// sizing and positioning
		$width = ploption('bigtext-width', $this->oset) ? ploption('bigtext-width', $this->oset) : '100%';
			$width = esc_html($width);
		$maxwidth = ploption('bigtext-max-width', $this->oset) ? ploption('bigtext-max-width', $this->oset) : '100%';
			$maxwidth = esc_html($maxwidth);
		$lineheight = ploption('bigtext-line-height', $this->oset) ? ploption('bigtext-line-height', $this->oset) : '1';
			$lineheight = esc_html($lineheight);
		$margin = ploption('bigtext-margin', $this->oset) ? ploption('bigtext-margin', $this->oset) : 'auto';
			$margin = esc_html($margin);
		$textalign = ploption('bigtext-text-align', $this->oset) ? ploption('bigtext-text-align', $this->oset) : 'center';
			$textalign = esc_html($textalign);


		//start BigText Area
		echo "<div id='bigtext' style='width: $width; max-width: $maxwidth; line-height: $lineheight; margin: $margin; text-align: $textalign;'>";
		//text0
			echo "<div class='bigtext btline0";
				if(empty($exempt0)){ echo "'"; } else { echo " bigtext-exempt'"; }
				if(!empty($color0)){ echo " style='color: $color0;'"; }
			echo ">$text0</div>";
		//text1
		if(!empty($text1)) {
			echo "<div class='bigtext btline1";
				if(empty($exempt1)){ echo "'"; } else { echo " bigtext-exempt'"; }
				if(!empty($color1)){ echo " style='color: $color1;'"; }
			echo ">$text1</div>";
		}
		//text2
		if(!empty($text2)) {
			echo "<div class='bigtext btline2";
				if(empty($exempt2)){ echo "'"; } else { echo " bigtext-exempt'"; }
				if(!empty($color2)){ echo " style='color: $color2;'"; }
			echo ">$text2</div>";
		}
		//text3
		if(!empty($text3)) {
			echo "<div class='bigtext btline3";
				if(empty($exempt3)){ echo "'"; } else { echo " bigtext-exempt'"; }
				if(!empty($color3)){ echo " style='color: $color3;'"; }
			echo ">$text3</div>";
		}
		//text4
		if(!empty($text4)) {
			echo "<div class='bigtext btline4";
				if(empty($exempt4)){ echo "'"; } else { echo " bigtext-exempt'"; }
				if(!empty($color4)){ echo " style='color: $color4;'"; }
			echo ">$text4</div>";
		}
		//text5
		if(!empty($text5)) {
			echo "<div class='bigtext btline5";
				if(empty($exempt5)){ echo "'"; } else { echo " bigtext-exempt'"; }
				if(!empty($color5)){ echo " style='color: $color5;'"; }
			echo ">$text5</div>";
		}
		//text6
		if(!empty($text6)) {
			echo "<div class='bigtext btline6";
				if(empty($exempt6)){ echo "'"; } else { echo " bigtext-exempt'"; }
				if(!empty($color6)){ echo " style='color: $color6;'"; }
			echo ">$text6</div>";
		}
		//text7
		if(!empty($text7)) {
			echo "<div class='bigtext btline7";
				if(empty($exempt7)){ echo "'"; } else { echo " bigtext-exempt'"; }
				if(!empty($color7)){ echo " style='color: $color7;'"; }
			echo ">$text7</div>";
		}
		//text8
		if(!empty($text8)) {
			echo "<div class='bigtext btline8";
				if(empty($exempt8)){ echo "'"; } else { echo " bigtext-exempt'"; }
				if(!empty($color8)){ echo " style='color: $color8;'"; }
			echo ">$text8</div>";
		}
		//text9
		if(!empty($text9)) {
			echo "<div class='bigtext btline9";
				if(empty($exempt9)){ echo "'"; } else { echo " bigtext-exempt'"; }
				if(!empty($color9)){ echo " style='color: $color9;'"; }
			echo ">$text9</div>";
		}
		//end BigText Area
		echo "</div>";


	} // end of function



} // end of section