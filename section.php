<?php
/*
Section: BigText
Author: TourKick
Author URI: http://tourkick.com/?utm_source=pagelines&utm_medium=section&utm_content=authoruri&utm_campaign=bigtext_section
Plugin URI: http://www.pagelinestheme.com/bigtext-section?utm_source=pagelines&utm_medium=section&utm_content=pluginuri&utm_campaign=bigtext_section
Description: A <a href="https://github.com/zachleat/BigText" target="_blank">BigText</a> section that resizes text to fit one or more words on a line that fits the container, and is responsive which means it scales with different size browsers. Like <a href="www.pagelines.com/store/sections/fittext-section/" target="_blank">FitText</a> but more customizable!
Demo: http://www.pagelinestheme.com/bigtext-section?utm_source=pagelines&utm_medium=section&utm_content=demolink&utm_campaign=bigtext_section
Class Name: BigTextSection
Version: 2.20130829
Cloning: true
V3: true
Filter:misc
*/


class BigTextSection extends PageLinesSection {

	function section_scripts(){
		// BigText version 1.2, MIT License, from https://github.com/zachleat/BigText#releases
		wp_enqueue_script('bigtext', $this->base_url.'/bigtext.js', array('jquery'), '1.2', true);

	}


	function section_head(){
		if(function_exists('pl_has_editor') && pl_has_editor()){
			$clone_id = $this->get_the_id();
		} else {
	        global $pagelines_ID;
	        $oset = array('post_id' => $pagelines_ID);
			$clone_id = $this->oset['clone_id'];
		}


		// pull in the options, since they're from another function
		global $pagelines_ID;
        $oset = array('post_id' => $pagelines_ID);


		// commented out since the .js sets it to 528 already //$maxfontsize = $this->opt('bigtext-maxfontsize') ? $this->opt('bigtext-maxfontsize') : '528';
		$maxfontsize = $this->opt('bigtext-maxfontsize');
		$minfontsize = $this->opt('bigtext-minfontsize');

		// allow only numbers
		$maxfontsize = preg_replace("/[^0-9]/","",$maxfontsize);
		$minfontsize = preg_replace("/[^0-9]/","",$minfontsize);
		?>

		<script type="text/javascript">
		/*<![CDATA[*/
			jQuery(document).ready(function(){

				jQuery("#bigtext-<?php echo $clone_id ?>").bigtext({
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

		echo load_custom_font( $this->opt('bigtext-font'), ' #bigtext-'. $clone_id );
		echo load_custom_font( $this->opt('bigtext-font-0'), "#bigtext-$clone_id .btline0" );
		echo load_custom_font( $this->opt('bigtext-font-1'), "#bigtext-$clone_id .btline1" );
		echo load_custom_font( $this->opt('bigtext-font-2'), "#bigtext-$clone_id .btline2" );
		echo load_custom_font( $this->opt('bigtext-font-3'), "#bigtext-$clone_id .btline3" );
		echo load_custom_font( $this->opt('bigtext-font-4'), "#bigtext-$clone_id .btline4" );
		echo load_custom_font( $this->opt('bigtext-font-5'), "#bigtext-$clone_id .btline5" );
		echo load_custom_font( $this->opt('bigtext-font-6'), "#bigtext-$clone_id .btline6" );
		echo load_custom_font( $this->opt('bigtext-font-7'), "#bigtext-$clone_id .btline7" );
		echo load_custom_font( $this->opt('bigtext-font-8'), "#bigtext-$clone_id .btline8" );
		echo load_custom_font( $this->opt('bigtext-font-9'), "#bigtext-$clone_id .btline9" );

	}



	function section_optionator( $settings ){

		$settings = wp_parse_args($settings, $this->optionator_default);

		global $post_ID;
		$oset = array(
			'post_id'  => $post_ID,
			'clone_id' => $settings['clone_id'],
			'type'     => $settings['type']
		);

		$options = array();

		$options['bigtext-container'] = array(
			'docslink'	=> 'http://www.pagelinestheme.com/bigtext-section?utm_source=pagelines&utm_medium=section&utm_content=docslink&utm_campaign=bigtext_section',
			'type'		=> 'multi_option',
			'title'		=> __('BigText Container Settings.', $this->id),
			'shortexp'	=> __('Control it.', $this->id),
			'selectvalues'	=> array(
				'bigtext-color-bg'	=> array(
					'type'			=> 'color',
					'inputlabel' 	=> __('Background Color', $this->id)
				),
				'bigtext-image-bg'	=> array(
					'type'			=> 'image_upload',
					'inputlabel' 	=> __('Background Image', $this->id)
				),
				'bigtext-image-bg-size'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Background Image Size.<br/>&nbsp;&nbsp;&nbsp;Default = <em>None / Auto</em><br/><a href="https://developer.mozilla.org/en-US/docs/CSS/background-size" target="_blank">CSS background-size</a>', $this->id),
					'selectvalues' => array(
						'contain'	=> array('name' => 'Contain' ),
						'cover'		=> array('name' => 'Cover' )
						)
				),
				'bigtext-image-bg-position'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Background Image Position.<br/>&nbsp;&nbsp;&nbsp;Default = <em>center center</em><br/><a href="https://developer.mozilla.org/en-US/docs/CSS/background-position" target="_blank">CSS background-position</a>, <a href="http://www.w3schools.com/cssref/playit.asp?filename=playcss_background-position" target="_blank">Try It Out</a>', $this->id),
					'selectvalues' => array(
						'left top'		=> array('name' => __('Left Top', $this->id) ),
						'left center'	=> array('name' => __('Left Center', $this->id) ),
						'left bottom'	=> array('name' => __('Left Bottom', $this->id) ),
						'right top'		=> array('name' => __('Right Top', $this->id) ),
						'right center'	=> array('name' => __('Right Center', $this->id) ),
						'right bottom'	=> array('name' => __('Right Bottom', $this->id) ),
						'center top'	=> array('name' => __('Center Top', $this->id) ),
						'center bottom'	=> array('name' => __('Center Bottom', $this->id) )
					)
				),
				'bigtext-width'	=> array(
					'type'			=> 'text_small',
					'inputlabel'	=> __('Width of BigText area (any units: %, px, em, etc).<br/>&nbsp;&nbsp;&nbsp;Default = <em>100%</em><br/><a href="https://developer.mozilla.org/en-US/docs/CSS/width" target="_blank">CSS width</a>', $this->id)
				),
				'bigtext-max-width'	=> array(
					'type'			=> 'text_small',
					'inputlabel'	=> __('Max-Width of BigText area (any units: %, px, em, etc).<br/>&nbsp;&nbsp;&nbsp;Default = <em>100%</em> (which makes it responsive)<br/><a href="https://developer.mozilla.org/en-US/docs/CSS/max-width" target="_blank">CSS max-width</a>', $this->id)
				),
				'bigtext-maxfontsize'	=> array(
					'type'			=> 'text_small',
					'inputlabel'	=> __('Max Font-Size (MUST BE IN PX, with or w/o "px")<br/>&nbsp;&nbsp;&nbsp;Default = <em>528</em>', $this->id)
				),
				'bigtext-minfontsize'	=> array(
					'type'			=> 'text_small',
					'inputlabel'	=> __('Min Font-Size (MUST BE IN PX, with or w/o "px")<br/>&nbsp;&nbsp;&nbsp;Default = Null/Zero', $this->id)
				)
			)
		);

		$options['bigtext-defaults'] = array(
			'type'		=> 'multi_option',
			'title'		=> __('BigText Default Settings to set all line options.', $this->id),
			'shortexp'	=> __('Set once here and/or set line-by-line to override.', $this->id),
			'selectvalues'	=> array(
				'bigtext-font'	=> array(
					'type'			=> 'fonts',
					'inputlabel'	=> __('Default Font', $this->id)
				),
				'bigtext-text-align'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('BigText Text-Align<br/>&nbsp;&nbsp;&nbsp;Default = <em>center</em><br/><a href="https://developer.mozilla.org/en-US/docs/CSS/text-align" target="_blank">CSS text-align</a>', $this->id),
					'selectvalues' => array(
						'left'		=> array('name' => __('Left', $this->id) ),
						'right'		=> array('name' => __('Right', $this->id) ),
						'justify'	=> array('name' => __('Justify', $this->id) )
					)
				),
				'bigtext-text-decoration'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Text-Decoration.<br/>&nbsp;&nbsp;&nbsp;Default = <em>None</em><br/><a href="https://developer.mozilla.org/en-US/docs/CSS/text-decoration" target="_blank">CSS text-decoration</a>', $this->id),
					'selectvalues' => array(
						'underline'	=> array('name' => __('Underline', $this->id) ),
						'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
						'overline'		=> array('name' => __('Overline', $this->id) )
					)
				),
				'bigtext-line-height'	=> array(
					'type'			=> 'text_small',
					'inputlabel'	=> __('BigText Line-Height (e.g. 0.9).<br/>&nbsp;&nbsp;&nbsp;Default = <em>1</em><br/><a href="https://developer.mozilla.org/en-US/docs/CSS/line-height" target="_blank">CSS line-height</a>', $this->id)
				),
				'bigtext-small-caps'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Display in small-caps?', $this->id)
				),
				'bigtext-transparent-text'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Change text color to transparent. Warnings:<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Only works on Webkit browsers. Ignored on other browsers.<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Try setting text color to white or black as a backup for non-Webkit.<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Does not work as expected with Stroke/Outline or Shadow Colors.<br/><br/>', $this->id)
				),
				'bigtext-color'	=> array(
					'type'		    => 'color',
					'inputlabel' 	=> __('Default Text Color', $this->id)
				),
				'bigtext-color-stroke'	=> array(
					'type'			=> 'color',
					'inputlabel' 	=> __('Stroke Color<br/>(a 1px Outline)', $this->id)
				),
				'bigtext-color-shadow'	=> array(
					'type'		    => 'color',
					'inputlabel'	=> __('Default<br/>Shadow Color', $this->id)
				),
				'bigtext-color-shadow-length' 	=> array(
					'type'			=> 'text_small',
					'inputlabel' 	=> __('Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
				)
			)
		);

		$options['bigtext-text'] = array(
			'type'		=> 'multi_option',
			'title'		=> __('Enter your BigText here.', $this->id),
			'shortexp'	=> __('Everything you enter per line will resize to fill the entire width. Blank lines will be skipped.<br/>You may enter HTML code and/or use shortcodes.<br/>Consider entering one or more <em>nbsp;</em> on each side of a line of text to pseudo-indent it.', $this->id),
			'selectvalues'	=> array(
				'bigtext-text-0'	=> array(
					'type'			=> 'text',
					'inputlabel'	=> __('Line 0 Text <em>(Required)</em>', $this->id)
				),
				'bigtext-text-1'	=> array(
					'type'			=> 'text',
					'inputlabel'	=> __('Line 1 Text', $this->id)
				),
				'bigtext-text-2'	=> array(
					'type'			=> 'text',
					'inputlabel'	=> __('Line 2 Text', $this->id)
				),
				'bigtext-text-3'	=> array(
					'type'			=> 'text',
					'inputlabel'	=> __('Line 3 Text', $this->id)
				),
				'bigtext-text-4'	=> array(
					'type'			=> 'text',
					'inputlabel'	=> __('Line 4 Text', $this->id)
				),
				'bigtext-text-5'	=> array(
					'type'			=> 'text',
					'inputlabel'	=> __('Line 5 Text', $this->id)
				),
				'bigtext-text-6'	=> array(
					'type'			=> 'text',
					'inputlabel'	=> __('Line 6 Text', $this->id)
				),
				'bigtext-text-7'	=> array(
					'type'			=> 'text',
					'inputlabel'	=> __('Line 7 Text', $this->id)
				),
				'bigtext-text-8'	=> array(
					'type'			=> 'text',
					'inputlabel'	=> __('Line 8 Text', $this->id)
				),
				'bigtext-text-9'	=> array(
					'type'			=> 'text',
					'inputlabel'	=> __('Line 9 Text', $this->id)
				),
			  )
			);

		$options['bigtext-exempt'] = array(
			'type'		=> 'multi_option',
			'title'		=> __('You may exempt specific lines from the BigText re-sizing effect.', $this->id),
			'shortexp'	=> __('Exempt lines will be displayed at the sitewide font size.', $this->id),
			'selectvalues'	=> array(
				'bigtext-exempt-0'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Exempt Line 0', $this->id)
				),
				'bigtext-exempt-1'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Exempt Line 1', $this->id)
				),
				'bigtext-exempt-2'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Exempt Line 2', $this->id)
				),
				'bigtext-exempt-3'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Exempt Line 3', $this->id)
				),
				'bigtext-exempt-4'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Exempt Line 4', $this->id)
				),
				'bigtext-exempt-5'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Exempt Line 5', $this->id)
				),
				'bigtext-exempt-6'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Exempt Line 6', $this->id)
				),
				'bigtext-exempt-7'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Exempt Line 7', $this->id)
				),
				'bigtext-exempt-8'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Exempt Line 8', $this->id)
				),
				'bigtext-exempt-9'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Exempt Line 9', $this->id)
				),
			)
		);


		$options['bigtext-options-controller'] = array(
			'title'					=> __( 'BigText Options Controller', $this->id ),
			'shortexp'				=> __( 'Control which BigText options are displayed.', $this->id ),
			'exp'					=> __( 'To show the new options:<br/>1) Check the box<br/>2) Save<br/>3) Refresh', $this->id ),
			'type' => 'check_multi',
			'selectvalues'=> array(
				'bigtext-options-line-by-line' => array(
					'inputlabel' 	=> __('Show Line-by-Line Styling?<br/>(e.g. font picker, alignment, small-caps, colors, etc.)', $this->id)
				)
			)
		);

		$line_by_line = !$this->opt('bigtext-options-line-by-line') ? true : false;

		$options['bigtext-0'] = array(
			'type'		=> 'multi_option',
			'title'		=> __('BigText Line 0', $this->id),
			'shortexp'	=> __('These line-by-line settings are optional.', $this->id),
			'disabled' => $line_by_line,
			'selectvalues'	=> array(
				'bigtext-font-0'	=> array(
					'type'			=> 'fonts',
					'inputlabel'	=> __('Line 0 Font', $this->id)
				),
				'bigtext-text-align-0'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Line 0 Text-Align', $this->id),
					'selectvalues' => array(
						'center'	=> array('name' => __('Center', $this->id) ),
						'left'		=> array('name' => __('Left', $this->id) ),
						'right'		=> array('name' => __('Right', $this->id) ),
						'justify'	=> array('name' => __('Justify', $this->id) )
					)
				),
				'bigtext-text-decoration-0'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Line 0 Text-Decoration', $this->id),
					'selectvalues' => array(
						'none'	=> array('name' => __('None', $this->id) ),
						'underline'	=> array('name' => __('Underline', $this->id) ),
						'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
						'overline'		=> array('name' => __('Overline', $this->id) )
					)
				),
				'bigtext-line-height-0'	=> array(
					'type'			=> 'text_small',
					'inputlabel'	=> __('Line 0 Line-Height', $this->id)
				),
				'bigtext-small-caps-0'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Line 0 in Small-Caps<br/><br/>', $this->id)
				),
/*
				'bigtext-transparent-text-0'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Line 0 Transparent Text. (Read warnings in Default Settings above.)<br/><br/>', $this->id)
				),
*/
				'bigtext-color-0'	=> array(
					'type'		    => 'color',
					'inputlabel' 	=> __('Line 0 Text Color', $this->id)
				),
				'bigtext-color-0-stroke'	=> array(
					'type'			=> 'color',
					'inputlabel' 	=> __('Line 0 Stroke<br/>(a 1px Outline)', $this->id)
				),
				'bigtext-color-0-shadow'	=> array(
					'type'		    => 'color',
					'inputlabel'	=> __('Line 0<br/>Shadow Color', $this->id)
				),
				'bigtext-color-0-shadow-length' 	=> array(
					'type'			=> 'text_small',
					'inputlabel' 	=> __('Line 0 Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
				)
			  )
			);

		$options['bigtext-1'] = array(
			'type'		=> 'multi_option',
			'title'		=> __('BigText Line 1', $this->id),
			'shortexp'	=> __('These line-by-line settings are optional.', $this->id),
			'disabled' => $line_by_line,
			'selectvalues'	=> array(
				'bigtext-font-1'	=> array(
					'type'			=> 'fonts',
					'inputlabel'	=> __('Line 1 Font', $this->id)
				),
				'bigtext-text-align-1'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Line 1 Text-Align', $this->id),
					'selectvalues' => array(
						'center'	=> array('name' => __('Center', $this->id) ),
						'left'		=> array('name' => __('Left', $this->id) ),
						'right'		=> array('name' => __('Right', $this->id) ),
						'justify'	=> array('name' => __('Justify', $this->id) )
					)
				),
				'bigtext-text-decoration-1'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Line 1 Text-Decoration', $this->id),
					'selectvalues' => array(
						'none'	=> array('name' => __('None', $this->id) ),
						'underline'	=> array('name' => __('Underline', $this->id) ),
						'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
						'overline'		=> array('name' => __('Overline', $this->id) )
					)
				),
				'bigtext-line-height-1'	=> array(
					'type'			=> 'text_small',
					'inputlabel'	=> __('Line 1 Line-Height', $this->id)
				),
				'bigtext-small-caps-1'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Line 1 in Small-Caps<br/><br/>', $this->id)
				),
/*
				'bigtext-transparent-text-1'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Line 1 Transparent Text. (Read warnings in Default Settings above.)<br/><br/>', $this->id)
				),
*/
				'bigtext-color-1'	=> array(
					'type'		    => 'color',
					'inputlabel' 	=> __('Line 1 Text Color', $this->id)
				),
				'bigtext-color-1-stroke'	=> array(
					'type'			=> 'color',
					'inputlabel' 	=> __('Line 1 Stroke<br/>(a 1px Outline)', $this->id)
				),
				'bigtext-color-1-shadow'	=> array(
					'type'		    => 'color',
					'inputlabel'	=> __('Line 1<br/>Shadow Color', $this->id)
				),
				'bigtext-color-1-shadow-length' 	=> array(
					'type'			=> 'text_small',
					'inputlabel' 	=> __('Line 1 Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
				)
			  )
			);

		$options['bigtext-2'] = array(
			'type'		=> 'multi_option',
			'title'		=> __('BigText Line 2', $this->id),
			'shortexp'	=> __('These line-by-line settings are optional.', $this->id),
			'disabled' => $line_by_line,
			'selectvalues'	=> array(
				'bigtext-font-2'	=> array(
					'type'			=> 'fonts',
					'inputlabel'	=> __('Line 2 Font', $this->id)
				),
				'bigtext-text-align-2'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Line 2 Text-Align', $this->id),
					'selectvalues' => array(
						'center'	=> array('name' => __('Center', $this->id) ),
						'left'		=> array('name' => __('Left', $this->id) ),
						'right'		=> array('name' => __('Right', $this->id) ),
						'justify'	=> array('name' => __('Justify', $this->id) )
					)
				),
				'bigtext-text-decoration-2'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Line 2 Text-Decoration', $this->id),
					'selectvalues' => array(
						'none'	=> array('name' => __('None', $this->id) ),
						'underline'	=> array('name' => __('Underline', $this->id) ),
						'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
						'overline'		=> array('name' => __('Overline', $this->id) )
					)
				),
				'bigtext-line-height-2'	=> array(
					'type'			=> 'text_small',
					'inputlabel'	=> __('Line 2 Line-Height', $this->id)
				),
				'bigtext-small-caps-2'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Line 2 in Small-Caps<br/><br/>', $this->id)
				),
/*
				'bigtext-transparent-text-2'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Line 2 Transparent Text. (Read warnings in Default Settings above.)<br/><br/>', $this->id)
				),
*/
				'bigtext-color-2'	=> array(
					'type'		    => 'color',
					'inputlabel' 	=> __('Line 2 Text Color', $this->id)
				),
				'bigtext-color-2-stroke'	=> array(
					'type'			=> 'color',
					'inputlabel' 	=> __('Line 2 Stroke<br/>(a 1px Outline)', $this->id)
				),
				'bigtext-color-2-shadow'	=> array(
					'type'		    => 'color',
					'inputlabel'	=> __('Line 2<br/>Shadow Color', $this->id)
				),
				'bigtext-color-2-shadow-length' 	=> array(
					'type'			=> 'text_small',
					'inputlabel' 	=> __('Line 2 Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
				)
			  )
			);

		$options['bigtext-3'] = array(
			'type'		=> 'multi_option',
			'title'		=> __('BigText Line 3', $this->id),
			'shortexp'	=> __('These line-by-line settings are optional.', $this->id),
			'disabled' => $line_by_line,
			'selectvalues'	=> array(
				'bigtext-font-3'	=> array(
					'type'			=> 'fonts',
					'inputlabel'	=> __('Line 3 Font', $this->id)
				),
				'bigtext-text-align-3'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Line 3 Text-Align', $this->id),
					'selectvalues' => array(
						'center'	=> array('name' => __('Center', $this->id) ),
						'left'		=> array('name' => __('Left', $this->id) ),
						'right'		=> array('name' => __('Right', $this->id) ),
						'justify'	=> array('name' => __('Justify', $this->id) )
					)
				),
				'bigtext-text-decoration-3'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Line 3 Text-Decoration', $this->id),
					'selectvalues' => array(
						'none'	=> array('name' => __('None', $this->id) ),
						'underline'	=> array('name' => __('Underline', $this->id) ),
						'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
						'overline'		=> array('name' => __('Overline', $this->id) )
					)
				),
				'bigtext-line-height-3'	=> array(
					'type'			=> 'text_small',
					'inputlabel'	=> __('Line 3 Line-Height', $this->id)
				),
				'bigtext-small-caps-3'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Line 3 in Small-Caps<br/><br/>', $this->id)
				),
/*
				'bigtext-transparent-text-3'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Line 3 Transparent Text. (Read warnings in Default Settings above.)<br/><br/>', $this->id)
				),
*/
				'bigtext-color-3'	=> array(
					'type'		    => 'color',
					'inputlabel' 	=> __('Line 3 Text Color', $this->id)
				),
				'bigtext-color-3-stroke'	=> array(
					'type'			=> 'color',
					'inputlabel' 	=> __('Line 3 Stroke<br/>(a 1px Outline)', $this->id)
				),
				'bigtext-color-3-shadow'	=> array(
					'type'		    => 'color',
					'inputlabel'	=> __('Line 3<br/>Shadow Color', $this->id)
				),
				'bigtext-color-3-shadow-length' 	=> array(
					'type'			=> 'text_small',
					'inputlabel' 	=> __('Line 3 Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
				)
			  )
			);

		$options['bigtext-4'] = array(
			'type'		=> 'multi_option',
			'title'		=> __('BigText Line 4', $this->id),
			'shortexp'	=> __('These line-by-line settings are optional.', $this->id),
			'disabled' => $line_by_line,
			'selectvalues'	=> array(
				'bigtext-font-4'	=> array(
					'type'			=> 'fonts',
					'inputlabel'	=> __('Line 4 Font', $this->id)
				),
				'bigtext-text-align-4'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Line 4 Text-Align', $this->id),
					'selectvalues' => array(
						'center'	=> array('name' => __('Center', $this->id) ),
						'left'		=> array('name' => __('Left', $this->id) ),
						'right'		=> array('name' => __('Right', $this->id) ),
						'justify'	=> array('name' => __('Justify', $this->id) )
					)
				),
				'bigtext-text-decoration-4'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Line 4 Text-Decoration', $this->id),
					'selectvalues' => array(
						'none'	=> array('name' => __('None', $this->id) ),
						'underline'	=> array('name' => __('Underline', $this->id) ),
						'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
						'overline'		=> array('name' => __('Overline', $this->id) )
					)
				),
				'bigtext-line-height-4'	=> array(
					'type'			=> 'text_small',
					'inputlabel'	=> __('Line 4 Line-Height', $this->id)
				),
				'bigtext-small-caps-4'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Line 4 in Small-Caps<br/><br/>', $this->id)
				),
/*
				'bigtext-transparent-text-4'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Line 4 Transparent Text. (Read warnings in Default Settings above.)<br/><br/>', $this->id)
				),
*/
				'bigtext-color-4'	=> array(
					'type'		    => 'color',
					'inputlabel' 	=> __('Line 4 Text Color', $this->id)
				),
				'bigtext-color-4-stroke'	=> array(
					'type'			=> 'color',
					'inputlabel' 	=> __('Line 4 Stroke<br/>(a 1px Outline)', $this->id)
				),
				'bigtext-color-4-shadow'	=> array(
					'type'		    => 'color',
					'inputlabel'	=> __('Line 4<br/>Shadow Color', $this->id)
				),
				'bigtext-color-4-shadow-length' 	=> array(
					'type'			=> 'text_small',
					'inputlabel' 	=> __('Line 4 Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
				)
			  )
			);

		$options['bigtext-5'] = array(
			'type'		=> 'multi_option',
			'title'		=> __('BigText Line 5', $this->id),
			'shortexp'	=> __('These line-by-line settings are optional.', $this->id),
			'disabled' => $line_by_line,
			'selectvalues'	=> array(
				'bigtext-font-5'	=> array(
					'type'			=> 'fonts',
					'inputlabel'	=> __('Line 5 Font', $this->id)
				),
				'bigtext-text-align-5'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Line 5 Text-Align', $this->id),
					'selectvalues' => array(
						'center'	=> array('name' => __('Center', $this->id) ),
						'left'		=> array('name' => __('Left', $this->id) ),
						'right'		=> array('name' => __('Right', $this->id) ),
						'justify'	=> array('name' => __('Justify', $this->id) )
					)
				),
				'bigtext-text-decoration-5'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Line 5 Text-Decoration', $this->id),
					'selectvalues' => array(
						'none'	=> array('name' => __('None', $this->id) ),
						'underline'	=> array('name' => __('Underline', $this->id) ),
						'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
						'overline'		=> array('name' => __('Overline', $this->id) )
					)
				),
				'bigtext-line-height-5'	=> array(
					'type'			=> 'text_small',
					'inputlabel'	=> __('Line 5 Line-Height', $this->id)
				),
				'bigtext-small-caps-5'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Line 5 in Small-Caps<br/><br/>', $this->id)
				),
/*
				'bigtext-transparent-text-5'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Line 5 Transparent Text. (Read warnings in Default Settings above.)<br/><br/>', $this->id)
				),
*/
				'bigtext-color-5'	=> array(
					'type'		    => 'color',
					'inputlabel' 	=> __('Line 5 Text Color', $this->id)
				),
				'bigtext-color-5-stroke'	=> array(
					'type'			=> 'color',
					'inputlabel' 	=> __('Line 5 Stroke<br/>(a 1px Outline)', $this->id)
				),
				'bigtext-color-5-shadow'	=> array(
					'type'		    => 'color',
					'inputlabel'	=> __('Line 5<br/>Shadow Color', $this->id)
				),
				'bigtext-color-5-shadow-length' 	=> array(
					'type'			=> 'text_small',
					'inputlabel' 	=> __('Line 5 Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
				)
			  )
			);

		$options['bigtext-6'] = array(
			'type'		=> 'multi_option',
			'title'		=> __('BigText Line 6', $this->id),
			'shortexp'	=> __('These line-by-line settings are optional.', $this->id),
			'disabled' => $line_by_line,
			'selectvalues'	=> array(
				'bigtext-font-6'	=> array(
					'type'			=> 'fonts',
					'inputlabel'	=> __('Line 6 Font', $this->id)
				),
				'bigtext-text-align-6'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Line 6 Text-Align', $this->id),
					'selectvalues' => array(
						'center'	=> array('name' => __('Center', $this->id) ),
						'left'		=> array('name' => __('Left', $this->id) ),
						'right'		=> array('name' => __('Right', $this->id) ),
						'justify'	=> array('name' => __('Justify', $this->id) )
					)
				),
				'bigtext-text-decoration-6'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Line 6 Text-Decoration', $this->id),
					'selectvalues' => array(
						'none'	=> array('name' => __('None', $this->id) ),
						'underline'	=> array('name' => __('Underline', $this->id) ),
						'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
						'overline'		=> array('name' => __('Overline', $this->id) )
					)
				),
				'bigtext-line-height-6'	=> array(
					'type'			=> 'text_small',
					'inputlabel'	=> __('Line 6 Line-Height', $this->id)
				),
				'bigtext-small-caps-6'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Line 6 in Small-Caps<br/><br/>', $this->id)
				),
/*
				'bigtext-transparent-text-6'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Line 6 Transparent Text. (Read warnings in Default Settings above.)<br/><br/>', $this->id)
				),
*/
				'bigtext-color-6'	=> array(
					'type'		    => 'color',
					'inputlabel' 	=> __('Line 6 Text Color', $this->id)
				),
				'bigtext-color-6-stroke'	=> array(
					'type'			=> 'color',
					'inputlabel' 	=> __('Line 6 Stroke<br/>(a 1px Outline)', $this->id)
				),
				'bigtext-color-6-shadow'	=> array(
					'type'		    => 'color',
					'inputlabel'	=> __('Line 6<br/>Shadow Color', $this->id)
				),
				'bigtext-color-6-shadow-length' 	=> array(
					'type'			=> 'text_small',
					'inputlabel' 	=> __('Line 6 Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
				)
			  )
			);

		$options['bigtext-7'] = array(
			'type'		=> 'multi_option',
			'title'		=> __('BigText Line 7', $this->id),
			'shortexp'	=> __('These line-by-line settings are optional.', $this->id),
			'disabled' => $line_by_line,
			'selectvalues'	=> array(
				'bigtext-font-7'	=> array(
					'type'			=> 'fonts',
					'inputlabel'	=> __('Line 7 Font', $this->id)
				),
				'bigtext-text-align-7'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Line 7 Text-Align', $this->id),
					'selectvalues' => array(
						'center'	=> array('name' => __('Center', $this->id) ),
						'left'		=> array('name' => __('Left', $this->id) ),
						'right'		=> array('name' => __('Right', $this->id) ),
						'justify'	=> array('name' => __('Justify', $this->id) )
					)
				),
				'bigtext-text-decoration-7'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Line 7 Text-Decoration', $this->id),
					'selectvalues' => array(
						'none'	=> array('name' => __('None', $this->id) ),
						'underline'	=> array('name' => __('Underline', $this->id) ),
						'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
						'overline'		=> array('name' => __('Overline', $this->id) )
					)
				),
				'bigtext-line-height-7'	=> array(
					'type'			=> 'text_small',
					'inputlabel'	=> __('Line 7 Line-Height', $this->id)
				),
				'bigtext-small-caps-7'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Line 7 in Small-Caps<br/><br/>', $this->id)
				),
/*
				'bigtext-transparent-text-7'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Line 7 Transparent Text. (Read warnings in Default Settings above.)<br/><br/>', $this->id)
				),
*/
				'bigtext-color-7'	=> array(
					'type'		    => 'color',
					'inputlabel' 	=> __('Line 7 Text Color', $this->id)
				),
				'bigtext-color-7-stroke'	=> array(
					'type'			=> 'color',
					'inputlabel' 	=> __('Line 7 Stroke<br/>(a 1px Outline)', $this->id)
				),
				'bigtext-color-7-shadow'	=> array(
					'type'		    => 'color',
					'inputlabel'	=> __('Line 7<br/>Shadow Color', $this->id)
				),
				'bigtext-color-7-shadow-length' 	=> array(
					'type'			=> 'text_small',
					'inputlabel' 	=> __('Line 7 Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
				)
			  )
			);

		$options['bigtext-8'] = array(
			'type'		=> 'multi_option',
			'title'		=> __('BigText Line 8', $this->id),
			'shortexp'	=> __('These line-by-line settings are optional.', $this->id),
			'disabled' => $line_by_line,
			'selectvalues'	=> array(
				'bigtext-font-8'	=> array(
					'type'			=> 'fonts',
					'inputlabel'	=> __('Line 8 Font', $this->id)
				),
				'bigtext-text-align-8'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Line 8 Text-Align', $this->id),
					'selectvalues' => array(
						'center'	=> array('name' => __('Center', $this->id) ),
						'left'		=> array('name' => __('Left', $this->id) ),
						'right'		=> array('name' => __('Right', $this->id) ),
						'justify'	=> array('name' => __('Justify', $this->id) )
					)
				),
				'bigtext-text-decoration-8'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Line 8 Text-Decoration', $this->id),
					'selectvalues' => array(
						'none'	=> array('name' => __('None', $this->id) ),
						'underline'	=> array('name' => __('Underline', $this->id) ),
						'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
						'overline'		=> array('name' => __('Overline', $this->id) )
					)
				),
				'bigtext-line-height-8'	=> array(
					'type'			=> 'text_small',
					'inputlabel'	=> __('Line 8 Line-Height', $this->id)
				),
				'bigtext-small-caps-8'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Line 8 in Small-Caps<br/><br/>', $this->id)
				),
/*
				'bigtext-transparent-text-8'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Line 8 Transparent Text. (Read warnings in Default Settings above.)<br/><br/>', $this->id)
				),
*/
				'bigtext-color-8'	=> array(
					'type'		    => 'color',
					'inputlabel' 	=> __('Line 8 Text Color', $this->id)
				),
				'bigtext-color-8-stroke'	=> array(
					'type'			=> 'color',
					'inputlabel' 	=> __('Line 8 Stroke<br/>(a 1px Outline)', $this->id)
				),
				'bigtext-color-8-shadow'	=> array(
					'type'		    => 'color',
					'inputlabel'	=> __('Line 8<br/>Shadow Color', $this->id)
				),
				'bigtext-color-8-shadow-length' 	=> array(
					'type'			=> 'text_small',
					'inputlabel' 	=> __('Line 8 Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
				)
			  )
			);

		$options['bigtext-9'] = array(
			'type'		=> 'multi_option',
			'title'		=> __('BigText Line 9', $this->id),
			'shortexp'	=> __('These line-by-line settings are optional.', $this->id),
			'disabled' => $line_by_line,
			'selectvalues'	=> array(
				'bigtext-font-9'	=> array(
					'type'			=> 'fonts',
					'inputlabel'	=> __('Line 9 Font', $this->id)
				),
				'bigtext-text-align-9'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Line 9 Text-Align', $this->id),
					'selectvalues' => array(
						'center'	=> array('name' => __('Center', $this->id) ),
						'left'		=> array('name' => __('Left', $this->id) ),
						'right'		=> array('name' => __('Right', $this->id) ),
						'justify'	=> array('name' => __('Justify', $this->id) )
					)
				),
				'bigtext-text-decoration-9'=> array(
					'type' 			=> 'select',
					'inputlabel'	=> __('Line 9 Text-Decoration', $this->id),
					'selectvalues' => array(
						'none'	=> array('name' => __('None', $this->id) ),
						'underline'	=> array('name' => __('Underline', $this->id) ),
						'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
						'overline'		=> array('name' => __('Overline', $this->id) )
					)
				),
				'bigtext-line-height-9'	=> array(
					'type'			=> 'text_small',
					'inputlabel'	=> __('Line 9 Line-Height', $this->id)
				),
				'bigtext-small-caps-9'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Line 9 in Small-Caps<br/><br/>', $this->id)
				),
/*
				'bigtext-transparent-text-9'	=> array(
					'type'			=> 'check',
					'inputlabel'	=> __('Line 9 Transparent Text. (Read warnings in Default Settings above.)<br/><br/>', $this->id)
				),
*/
				'bigtext-color-9'	=> array(
					'type'		    => 'color',
					'inputlabel' 	=> __('Line 9 Text Color', $this->id)
				),
				'bigtext-color-9-stroke'	=> array(
					'type'			=> 'color',
					'inputlabel' 	=> __('Line 9 Stroke<br/>(a 1px Outline)', $this->id)
				),
				'bigtext-color-9-shadow'	=> array(
					'type'		    => 'color',
					'inputlabel'	=> __('Line 9<br/>Shadow Color', $this->id)
				),
				'bigtext-color-9-shadow-length' 	=> array(
					'type'			=> 'text_small',
					'inputlabel' 	=> __('Line 9 Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
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

		if(function_exists('pl_has_editor') && pl_has_editor()){
			$clone_id = $this->get_the_id();
		} else {
	        global $pagelines_ID;
	        $oset = array('post_id' => $pagelines_ID);
			$clone_id = $this->oset['clone_id'];
		}


		if(!$this->opt('bigtext-text-0')){
			echo setup_section_notify($this, __('Get started with BigText by entering a value for "BigText Line 0 Text".'));
			return;
		}


		// classes and controls
		$wrapperclass = $this->opt('bigtext-wrapper-class');
			$wrapperclass = esc_html($wrapperclass);
			$wrapperclass = str_replace(",", " ", $wrapperclass); // replace commas with spaces
	$this->special_classes .= $wrapperclass;

		$contentclass = $this->opt('bigtext-content-class');
			$contentclass = esc_html($contentclass);
			$contentclass = str_replace(",", " ", $contentclass); // replace commas with spaces
		$width = $this->opt('bigtext-width') ? $this->opt('bigtext-width') : '100%';
			$width = esc_html($width);
		$maxwidth = $this->opt('bigtext-max-width') ? $this->opt('bigtext-max-width') : '100%';
			$maxwidth = esc_html($maxwidth);


		//background color
		$colorbg = pl_hashify($this->opt('bigtext-color-bg'));

		//background image
		$bgimage = $this->opt('bigtext-image-bg');
			if(!empty($bgimage)) {
				$bgimagesize = $this->opt('bigtext-image-bg-size') ? $this->opt('bigtext-image-bg-size') : 'auto';
				$bgimageposition = $this->opt('bigtext-image-bg-position') ? $this->opt('bigtext-image-bg-position') : 'center center';
				$bgimagecode = "background: url(\"$bgimage\") no-repeat; background-position: $bgimageposition; -webkit-background-size: $bgimagesize; -moz-background-size: $bgimagesize; background-size: $bgimagesize;";
			}


		// text
		// cannot do esc_html() to protect input on all these because then HTML will not work -- so do not insert your own malicious scripts ;-)
		$text0 = $this->opt('bigtext-text-0');
			$text0 = do_shortcode($text0);
		$text1 = $this->opt('bigtext-text-1');
			$text1 = do_shortcode($text1);
		$text2 = $this->opt('bigtext-text-2');
			$text2 = do_shortcode($text2);
		$text3 = $this->opt('bigtext-text-3');
			$text3 = do_shortcode($text3);
		$text4 = $this->opt('bigtext-text-4');
			$text4 = do_shortcode($text4);
		$text5 = $this->opt('bigtext-text-5');
			$text5 = do_shortcode($text5);
		$text6 = $this->opt('bigtext-text-6');
			$text6 = do_shortcode($text6);
		$text7 = $this->opt('bigtext-text-7');
			$text7 = do_shortcode($text7);
		$text8 = $this->opt('bigtext-text-8');
			$text8 = do_shortcode($text8);
		$text9 = $this->opt('bigtext-text-9');
			$text9 = do_shortcode($text9);


		//same code applies to all of them
		$smallcapscode = "font-variant:small-caps;";
		//
		$smallcaps = $this->opt('bigtext-small-caps');
		$smallcaps0 = $this->opt('bigtext-small-caps-0');
		$smallcaps1 = $this->opt('bigtext-small-caps-1');
		$smallcaps2 = $this->opt('bigtext-small-caps-2');
		$smallcaps3 = $this->opt('bigtext-small-caps-3');
		$smallcaps4 = $this->opt('bigtext-small-caps-4');
		$smallcaps5 = $this->opt('bigtext-small-caps-5');
		$smallcaps6 = $this->opt('bigtext-small-caps-6');
		$smallcaps7 = $this->opt('bigtext-small-caps-7');
		$smallcaps8 = $this->opt('bigtext-small-caps-8');
		$smallcaps9 = $this->opt('bigtext-small-caps-9');

		//same code applies to all of them
		$transparenttextcode = "-webkit-background-clip:text; -webkit-text-fill-color:transparent;";
		// transparent text
		$transparenttext = $this->opt('bigtext-transparent-text');
		// line-by-line
		// DOES NOT WORK LINE-BY-LINE UNLESS BACKGROUND IS LINE-BY-LINE
/*
		$transparenttext0 = $this->opt('bigtext-transparent-text-0');
		$transparenttext1 = $this->opt('bigtext-transparent-text-1');
		$transparenttext2 = $this->opt('bigtext-transparent-text-2');
		$transparenttext3 = $this->opt('bigtext-transparent-text-3');
		$transparenttext4 = $this->opt('bigtext-transparent-text-4');
		$transparenttext5 = $this->opt('bigtext-transparent-text-5');
		$transparenttext6 = $this->opt('bigtext-transparent-text-6');
		$transparenttext7 = $this->opt('bigtext-transparent-text-7');
		$transparenttext8 = $this->opt('bigtext-transparent-text-8');
		$transparenttext9 = $this->opt('bigtext-transparent-text-9');
*/

		//text color
		$color = pl_hashify($this->opt('bigtext-color'));
		// line-by-line color
		$color0 = pl_hashify($this->opt('bigtext-color-0'));
		$color1 = pl_hashify($this->opt('bigtext-color-1'));
		$color2 = pl_hashify($this->opt('bigtext-color-2'));
		$color3 = pl_hashify($this->opt('bigtext-color-3'));
		$color4 = pl_hashify($this->opt('bigtext-color-4'));
		$color5 = pl_hashify($this->opt('bigtext-color-5'));
		$color6 = pl_hashify($this->opt('bigtext-color-6'));
		$color7 = pl_hashify($this->opt('bigtext-color-7'));
		$color8 = pl_hashify($this->opt('bigtext-color-8'));
		$color9 = pl_hashify($this->opt('bigtext-color-9'));

		//stroke
		$colorstroke = pl_hashify($this->opt('bigtext-color-stroke'));
			if(!empty($colorstroke)) {
				$stroketextcode = "text-shadow: -1px -1px 0 $colorstroke, 1px -1px 0 $colorstroke, -1px 1px 0 $colorstroke, 1px 1px 0 $colorstroke;";
			}
		// line-by-line stroke
		$colorstroke0 = pl_hashify($this->opt('bigtext-color-0-stroke'));
			if(!empty($colorstroke0)) {
				$stroketextcode0 = "text-shadow: -1px -1px 0 $colorstroke0, 1px -1px 0 $colorstroke0, -1px 1px 0 $colorstroke0, 1px 1px 0 $colorstroke0;";
			}
		$colorstroke1 = pl_hashify($this->opt('bigtext-color-1-stroke'));
			if(!empty($colorstroke1)) {
				$stroketextcode1 = "text-shadow: -1px -1px 0 $colorstroke1, 1px -1px 0 $colorstroke1, -1px 1px 0 $colorstroke1, 1px 1px 0 $colorstroke1;";
			}
		$colorstroke2 = pl_hashify($this->opt('bigtext-color-2-stroke'));
			if(!empty($colorstroke2)) {
				$stroketextcode2 = "text-shadow: -1px -1px 0 $colorstroke2, 1px -1px 0 $colorstroke2, -1px 1px 0 $colorstroke2, 1px 1px 0 $colorstroke2;";
			}
		$colorstroke3 = pl_hashify($this->opt('bigtext-color-3-stroke'));
			if(!empty($colorstroke3)) {
				$stroketextcode3 = "text-shadow: -1px -1px 0 $colorstroke3, 1px -1px 0 $colorstroke3, -1px 1px 0 $colorstroke3, 1px 1px 0 $colorstroke3;";
			}
		$colorstroke4 = pl_hashify($this->opt('bigtext-color-4-stroke'));
			if(!empty($colorstroke4)) {
				$stroketextcode4 = "text-shadow: -1px -1px 0 $colorstroke4, 1px -1px 0 $colorstroke4, -1px 1px 0 $colorstroke4, 1px 1px 0 $colorstroke4;";
			}
		$colorstroke5 = pl_hashify($this->opt('bigtext-color-5-stroke'));
			if(!empty($colorstroke5)) {
				$stroketextcode5 = "text-shadow: -1px -1px 0 $colorstroke5, 1px -1px 0 $colorstroke5, -1px 1px 0 $colorstroke5, 1px 1px 0 $colorstroke5;";
			}
		$colorstroke6 = pl_hashify($this->opt('bigtext-color-6-stroke'));
			if(!empty($colorstroke6)) {
				$stroketextcode6 = "text-shadow: -1px -1px 0 $colorstroke6, 1px -1px 0 $colorstroke6, -1px 1px 0 $colorstroke6, 1px 1px 0 $colorstroke6;";
			}
		$colorstroke7 = pl_hashify($this->opt('bigtext-color-7-stroke'));
			if(!empty($colorstroke7)) {
				$stroketextcode7 = "text-shadow: -1px -1px 0 $colorstroke7, 1px -1px 0 $colorstroke7, -1px 1px 0 $colorstroke7, 1px 1px 0 $colorstroke7;";
			}
		$colorstroke8 = pl_hashify($this->opt('bigtext-color-8-stroke'));
			if(!empty($colorstroke8)) {
				$stroketextcode8 = "text-shadow: -1px -1px 0 $colorstroke8, 1px -1px 0 $colorstroke8, -1px 1px 0 $colorstroke8, 1px 1px 0 $colorstroke8;";
			}
		$colorstroke9 = pl_hashify($this->opt('bigtext-color-9-stroke'));
			if(!empty($colorstroke9)) {
				$stroketextcode9 = "text-shadow: -1px -1px 0 $colorstroke9, 1px -1px 0 $colorstroke9, -1px 1px 0 $colorstroke9, 1px 1px 0 $colorstroke9;";
			}

		//shadow color
		$colorshadow = pl_hashify($this->opt('bigtext-color-shadow'));
			if(!empty($colorshadow)) {
				$shadowlength = $this->opt('bigtext-color-shadow-length') ? $this->opt('bigtext-color-shadow-length') : '2px';
				$shadowlength = esc_html($shadowlength);
				$shadowcode = "text-shadow: $shadowlength $shadowlength $colorshadow;";
			}
		// line-by-line shadow
		$colorshadow0 = pl_hashify($this->opt('bigtext-color-0-shadow'));
			if(!empty($colorshadow0)) {
				$shadowlength0 = $this->opt('bigtext-color-0-shadow-length') ? $this->opt('bigtext-color-0-shadow-length') : '2px';
				$shadowlength0 = esc_html($shadowlength0);
				$shadowcode0 = "text-shadow: $shadowlength0 $shadowlength0 $colorshadow0;";
			}
		$colorshadow1 = pl_hashify($this->opt('bigtext-color-1-shadow'));
			if(!empty($colorshadow1)) {
				$shadowlength1 = $this->opt('bigtext-color-1-shadow-length') ? $this->opt('bigtext-color-1-shadow-length') : '2px';
				$shadowlength1 = esc_html($shadowlength1);
				$shadowcode1 = "text-shadow: $shadowlength1 $shadowlength1 $colorshadow1;";
			}
		$colorshadow2 = pl_hashify($this->opt('bigtext-color-2-shadow'));
			if(!empty($colorshadow2)) {
				$shadowlength2 = $this->opt('bigtext-color-2-shadow-length') ? $this->opt('bigtext-color-2-shadow-length') : '2px';
				$shadowlength2 = esc_html($shadowlength2);
				$shadowcode2 = "text-shadow: $shadowlength2 $shadowlength2 $colorshadow2;";
			}
		$colorshadow3 = pl_hashify($this->opt('bigtext-color-3-shadow'));
			if(!empty($colorshadow3)) {
				$shadowlength3 = $this->opt('bigtext-color-3-shadow-length') ? $this->opt('bigtext-color-3-shadow-length') : '2px';
				$shadowlength3 = esc_html($shadowlength3);
				$shadowcode3 = "text-shadow: $shadowlength3 $shadowlength3 $colorshadow3;";
			}
		$colorshadow4 = pl_hashify($this->opt('bigtext-color-4-shadow'));
			if(!empty($colorshadow4)) {
				$shadowlength4 = $this->opt('bigtext-color-4-shadow-length') ? $this->opt('bigtext-color-4-shadow-length') : '2px';
				$shadowlength4 = esc_html($shadowlength4);
				$shadowcode4 = "text-shadow: $shadowlength4 $shadowlength4 $colorshadow4;";
			}
		$colorshadow5 = pl_hashify($this->opt('bigtext-color-5-shadow'));
			if(!empty($colorshadow5)) {
				$shadowlength5 = $this->opt('bigtext-color-5-shadow-length') ? $this->opt('bigtext-color-5-shadow-length') : '2px';
				$shadowlength5 = esc_html($shadowlength5);
				$shadowcode5 = "text-shadow: $shadowlength5 $shadowlength5 $colorshadow5;";
			}
		$colorshadow6 = pl_hashify($this->opt('bigtext-color-6-shadow'));
			if(!empty($colorshadow6)) {
				$shadowlength6 = $this->opt('bigtext-color-6-shadow-length') ? $this->opt('bigtext-color-6-shadow-length') : '2px';
				$shadowlength6 = esc_html($shadowlength6);
				$shadowcode6 = "text-shadow: $shadowlength6 $shadowlength6 $colorshadow6;";
			}
		$colorshadow7 = pl_hashify($this->opt('bigtext-color-7-shadow'));
			if(!empty($colorshadow7)) {
				$shadowlength7 = $this->opt('bigtext-color-7-shadow-length') ? $this->opt('bigtext-color-7-shadow-length') : '2px';
				$shadowlength7 = esc_html($shadowlength7);
				$shadowcode7 = "text-shadow: $shadowlength7 $shadowlength7 $colorshadow7;";
			}
		$colorshadow8 = pl_hashify($this->opt('bigtext-color-8-shadow'));
			if(!empty($colorshadow8)) {
				$shadowlength8 = $this->opt('bigtext-color-8-shadow-length') ? $this->opt('bigtext-color-8-shadow-length') : '2px';
				$shadowlength8 = esc_html($shadowlength8);
				$shadowcode8 = "text-shadow: $shadowlength8 $shadowlength8 $colorshadow8;";
			}
		$colorshadow9 = pl_hashify($this->opt('bigtext-color-9-shadow'));
			if(!empty($colorshadow9)) {
				$shadowlength9 = $this->opt('bigtext-color-9-shadow-length') ? $this->opt('bigtext-color-9-shadow-length') : '2px';
				$shadowlength9 = esc_html($shadowlength9);
				$shadowcode9 = "text-shadow: $shadowlength9 $shadowlength9 $colorshadow9;";
			}

		// text-align
		$textalign = $this->opt('bigtext-text-align') ? $this->opt('bigtext-text-align') : 'center' ;
		// line-by-line text-align
		$textalign0 = $this->opt('bigtext-text-align-0');
		$textalign1 = $this->opt('bigtext-text-align-1');
		$textalign2 = $this->opt('bigtext-text-align-2');
		$textalign3 = $this->opt('bigtext-text-align-3');
		$textalign4 = $this->opt('bigtext-text-align-4');
		$textalign5 = $this->opt('bigtext-text-align-5');
		$textalign6 = $this->opt('bigtext-text-align-6');
		$textalign7 = $this->opt('bigtext-text-align-7');
		$textalign8 = $this->opt('bigtext-text-align-8');
		$textalign9 = $this->opt('bigtext-text-align-9');

		// text-decoration
		$textdecoration = $this->opt('bigtext-text-decoration') ? $this->opt('bigtext-text-decoration') : 'none' ;
		// line-by-line text-decoration
		$textdecoration0 = $this->opt('bigtext-text-decoration-0') ? $this->opt('bigtext-text-decoration-0') : 'none' ;
		$textdecoration1 = $this->opt('bigtext-text-decoration-1') ? $this->opt('bigtext-text-decoration-1') : 'none' ;
		$textdecoration2 = $this->opt('bigtext-text-decoration-2') ? $this->opt('bigtext-text-decoration-2') : 'none' ;
		$textdecoration3 = $this->opt('bigtext-text-decoration-3') ? $this->opt('bigtext-text-decoration-3') : 'none' ;
		$textdecoration4 = $this->opt('bigtext-text-decoration-4') ? $this->opt('bigtext-text-decoration-4') : 'none' ;
		$textdecoration5 = $this->opt('bigtext-text-decoration-5') ? $this->opt('bigtext-text-decoration-5') : 'none' ;
		$textdecoration6 = $this->opt('bigtext-text-decoration-6') ? $this->opt('bigtext-text-decoration-6') : 'none' ;
		$textdecoration7 = $this->opt('bigtext-text-decoration-7') ? $this->opt('bigtext-text-decoration-7') : 'none' ;
		$textdecoration8 = $this->opt('bigtext-text-decoration-8') ? $this->opt('bigtext-text-decoration-8') : 'none' ;
		$textdecoration9 = $this->opt('bigtext-text-decoration-9') ? $this->opt('bigtext-text-decoration-9') : 'none' ;

		// line-height
		$lineheight = $this->opt('bigtext-line-height') ? $this->opt('bigtext-line-height') : '1';
			$lineheight = esc_html($lineheight);
		// line-by-line line-height
		$lineheight0 = $this->opt('bigtext-line-height-0');
			$lineheight0 = esc_html($lineheight0);
		$lineheight1 = $this->opt('bigtext-line-height-1');
			$lineheight1 = esc_html($lineheight1);
		$lineheight2 = $this->opt('bigtext-line-height-2');
			$lineheight2 = esc_html($lineheight2);
		$lineheight3 = $this->opt('bigtext-line-height-3');
			$lineheight3 = esc_html($lineheight3);
		$lineheight4 = $this->opt('bigtext-line-height-4');
			$lineheight4 = esc_html($lineheight4);
		$lineheight5 = $this->opt('bigtext-line-height-5');
			$lineheight5 = esc_html($lineheight5);
		$lineheight6 = $this->opt('bigtext-line-height-6');
			$lineheight6 = esc_html($lineheight6);
		$lineheight7 = $this->opt('bigtext-line-height-7');
			$lineheight7 = esc_html($lineheight7);
		$lineheight8 = $this->opt('bigtext-line-height-8');
			$lineheight8 = esc_html($lineheight8);
		$lineheight9 = $this->opt('bigtext-line-height-9');
			$lineheight9 = esc_html($lineheight9);

		// exempt
		$exempt0 = $this->opt('bigtext-exempt-0');
		$exempt1 = $this->opt('bigtext-exempt-1');
		$exempt2 = $this->opt('bigtext-exempt-2');
		$exempt3 = $this->opt('bigtext-exempt-3');
		$exempt4 = $this->opt('bigtext-exempt-4');
		$exempt5 = $this->opt('bigtext-exempt-5');
		$exempt6 = $this->opt('bigtext-exempt-6');
		$exempt7 = $this->opt('bigtext-exempt-7');
		$exempt8 = $this->opt('bigtext-exempt-8');
		$exempt9 = $this->opt('bigtext-exempt-9');




		//start BigText Area
		echo "<div id='bigtext-$clone_id' class='$contentclass bigtext' style='width: $width; max-width: $maxwidth; line-height: $lineheight; text-align: $textalign; text-decoration:$textdecoration;";
			if(!empty($color)){ echo " color: $color;"; }
			if(!empty($colorbg)){ echo " background-color: $colorbg;"; }
			if(!empty($bgimage)){ echo " $bgimagecode"; }
			if(!empty($colorstroke)){ " $stroketextcode"; }
			if(!empty($colorshadow)){ " $shadowcode"; }
			if(!empty($smallcaps)){ echo " $smallcapscode"; }
			if(!empty($transparenttext)){ echo " $transparenttextcode"; }
		echo "'>";

		//text0
			echo "<div class='bigtext btline0";
				if(empty($exempt0)){ echo "'"; } else { echo " bigtext-exempt'"; }
				echo " style='text-decoration:$textdecoration0;"; // just so style tag isn't empty
				if(!empty($lineheight0)){ echo " line-height: $lineheight0;"; }
				if(!empty($textalign0)){ echo " text-align: $textalign0;"; }
				if(!empty($color0)){ echo " color: $color0;"; }
				if(!empty($colorstroke0)){ echo " $stroketextcode0"; }
				if(!empty($colorshadow0)){ echo " $shadowcode0"; }
				if(!empty($smallcaps0)){ echo " $smallcapscode"; }
			echo "'>$text0</div>";
		//text1
		if(!empty($text1)) {
			echo "<div class='bigtext btline1";
				if(empty($exempt1)){ echo "'"; } else { echo " bigtext-exempt'"; }
				echo " style='text-decoration:$textdecoration1;";
				if(!empty($lineheight1)){ echo " line-height: $lineheight1;"; }
				if(!empty($textalign1)){ echo " text-align: $textalign1;"; }
				if(!empty($color1)){ echo " color: $color1;"; }
				if(!empty($colorstroke1)){ echo " $stroketextcode1"; }
				if(!empty($colorshadow1)){ echo " $shadowcode1"; }
				if(!empty($smallcaps1)){ echo " $smallcapscode"; }
			echo "'>$text1</div>";
		}
		//text2
		if(!empty($text2)) {
			echo "<div class='bigtext btline2";
				if(empty($exempt2)){ echo "'"; } else { echo " bigtext-exempt'"; }
				echo " style='text-decoration:$textdecoration2;";
				if(!empty($lineheight2)){ echo " line-height: $lineheight2;"; }
				if(!empty($textalign2)){ echo " text-align: $textalign2;"; }
				if(!empty($color2)){ echo " color: $color2;"; }
				if(!empty($colorstroke2)){ echo " $stroketextcode2"; }
				if(!empty($colorshadow2)){ echo " $shadowcode2"; }
				if(!empty($smallcaps2)){ echo " $smallcapscode"; }
			echo "'>$text2</div>";
		}
		//text3
		if(!empty($text3)) {
			echo "<div class='bigtext btline3";
				if(empty($exempt3)){ echo "'"; } else { echo " bigtext-exempt'"; }
				echo " style='text-decoration:$textdecoration3;";
				if(!empty($lineheight3)){ echo " line-height: $lineheight3;"; }
				if(!empty($textalign3)){ echo " text-align: $textalign3;"; }
				if(!empty($color3)){ echo " color: $color3;"; }
				if(!empty($colorstroke3)){ echo " $stroketextcode3"; }
				if(!empty($colorshadow3)){ echo " $shadowcode3"; }
				if(!empty($smallcaps3)){ echo " $smallcapscode"; }
			echo "'>$text3</div>";
		}
		//text4
		if(!empty($text4)) {
			echo "<div class='bigtext btline4";
				if(empty($exempt4)){ echo "'"; } else { echo " bigtext-exempt'"; }
				echo " style='text-decoration:$textdecoration4;";
				if(!empty($lineheight4)){ echo " line-height: $lineheight4;"; }
				if(!empty($textalign4)){ echo " text-align: $textalign4;"; }
				if(!empty($color4)){ echo " color: $color4;"; }
				if(!empty($colorstroke4)){ echo " $stroketextcode4"; }
				if(!empty($colorshadow4)){ echo " $shadowcode4"; }
				if(!empty($smallcaps4)){ echo " $smallcapscode"; }
			echo "'>$text4</div>";
		}
		//text5
		if(!empty($text5)) {
			echo "<div class='bigtext btline5";
				if(empty($exempt5)){ echo "'"; } else { echo " bigtext-exempt'"; }
				echo " style='text-decoration:$textdecoration5;";
				if(!empty($lineheight5)){ echo " line-height: $lineheight5;"; }
				if(!empty($textalign5)){ echo " text-align: $textalign5;"; }
				if(!empty($color5)){ echo " color: $color5;"; }
				if(!empty($colorstroke5)){ echo " $stroketextcode5"; }
				if(!empty($colorshadow5)){ echo " $shadowcode5"; }
				if(!empty($smallcaps5)){ echo " $smallcapscode"; }
			echo "'>$text5</div>";
		}
		//text6
		if(!empty($text6)) {
			echo "<div class='bigtext btline6";
				if(empty($exempt6)){ echo "'"; } else { echo " bigtext-exempt'"; }
				echo " style='text-decoration:$textdecoration6;";
				if(!empty($lineheight6)){ echo " line-height: $lineheight6;"; }
				if(!empty($textalign6)){ echo " text-align: $textalign6;"; }
				if(!empty($color6)){ echo " color: $color6;"; }
				if(!empty($colorstroke6)){ echo " $stroketextcode6"; }
				if(!empty($colorshadow6)){ echo " $shadowcode6"; }
				if(!empty($smallcaps6)){ echo " $smallcapscode"; }
			echo "'>$text6</div>";
		}
		//text7
		if(!empty($text7)) {
			echo "<div class='bigtext btline7";
				if(empty($exempt7)){ echo "'"; } else { echo " bigtext-exempt'"; }
				echo " style='text-decoration:$textdecoration7;";
				if(!empty($lineheight7)){ echo " line-height: $lineheight7;"; }
				if(!empty($textalign7)){ echo " text-align: $textalign7;"; }
				if(!empty($color7)){ echo " color: $color7;"; }
				if(!empty($colorstroke7)){ echo " $stroketextcode7"; }
				if(!empty($colorshadow7)){ echo " $shadowcode7"; }
				if(!empty($smallcaps7)){ echo " $smallcapscode"; }
			echo "'>$text7</div>";
		}
		//text8
		if(!empty($text8)) {
			echo "<div class='bigtext btline8";
				if(empty($exempt8)){ echo "'"; } else { echo " bigtext-exempt'"; }
				echo " style='text-decoration:$textdecoration8;";
				if(!empty($lineheight8)){ echo " line-height: $lineheight8;"; }
				if(!empty($textalign8)){ echo " text-align: $textalign8;"; }
				if(!empty($color8)){ echo " color: $color8;"; }
				if(!empty($colorstroke8)){ echo " $stroketextcode8"; }
				if(!empty($colorshadow8)){ echo " $shadowcode8"; }
				if(!empty($smallcaps8)){ echo " $smallcapscode"; }
			echo "'>$text8</div>";
		}
		//text9
		if(!empty($text9)) {
			echo "<div class='bigtext btline9";
				if(empty($exempt9)){ echo "'"; } else { echo " bigtext-exempt'"; }
				echo " style='text-decoration:$textdecoration9;";
				if(!empty($lineheight9)){ echo " line-height: $lineheight9;"; }
				if(!empty($textalign9)){ echo " text-align: $textalign9;"; }
				if(!empty($color9)){ echo " color: $color9;"; }
				if(!empty($colorstroke9)){ echo " $stroketextcode9"; }
				if(!empty($colorshadow9)){ echo " $shadowcode9"; }
				if(!empty($smallcaps9)){ echo " $smallcapscode"; }
			echo "'>$text9</div>";
		}
		//end BigText Area
		echo "</div>";


	} // end of function



} // end of section