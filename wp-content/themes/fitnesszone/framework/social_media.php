<?php
global $dt_theme_social_bookmarks; // Used in Blog single & page tab in BPanel
$dt_theme_social_bookmarks = array(array(
							"id"=>		"googleplus",
							"label"=>	__("Show Google+ One",'fitnesszone'),
							"options"=>	array(
								"standard"=>__("Standard",'fitnesszone'),
								"small"=>__("Small",'fitnesszone'),
								"medium"=>__("Medium",'fitnesszone'),
								"tall"=>__("Tall",'fitnesszone')),
							"lang"=>array(
								"ar" => __( "Arabic", 'fitnesszone' ),
								"bn" => __( "Bengali", 'fitnesszone' ),
								"bg" => __( "Bulgarian", 'fitnesszone' ),
								"ca" => __( "Catalan", 'fitnesszone' ),
								"zh" => __( "Chinese", 'fitnesszone' ),
								"zh_CN" => __( "Chinese (China)", 'fitnesszone' ),
								"zh_HK" => __( "Chinese (Hong Kong)", 'fitnesszone' ),
								"zh_TW" => __( "Chinese (Taiwan)", 'fitnesszone' ),
								"hr" => __( "Croation", 'fitnesszone' ),
								"cs" => __( "Czech", 'fitnesszone' ),
								"da" => __( "Danish", 'fitnesszone' ),
								"nl" => __( "Dutch", 'fitnesszone' ),
								"en_IN" => __( "English (India)", 'fitnesszone' ),
								"en_IE" => __( "English (Ireland)", 'fitnesszone' ),
								"en_SG" => __( "English (Singapore)", 'fitnesszone' ),
								"en_ZA" => __( "English (South Africa)", 'fitnesszone' ),
								"en_GB" => __( "English (United Kingdom)", 'fitnesszone' ),
								"fil" => __( "Filipino", 'fitnesszone' ),
								"fi" => __( "Finnish", 'fitnesszone' ),
								"fr" => __( "French", 'fitnesszone' ),
								"de" => __( "German", 'fitnesszone' ),
								"de_CH" => __( "German (Switzerland)", 'fitnesszone' ),
								"el" => __( "Greek", 'fitnesszone' ),
								"gu" => __( "Gujarati", 'fitnesszone' ),
								"iw" => __( "Hebrew", 'fitnesszone' ),
								"hi" => __( "Hindi", 'fitnesszone' ),
								"hu" => __( "Hungarian", 'fitnesszone' ),
								"in" => __( "Indonesian", 'fitnesszone' ),
								"it" => __( "Italian", 'fitnesszone' ),
								"ja" => __( "Japanese", 'fitnesszone' ),
								"kn" => __( "Kannada", 'fitnesszone' ),
								"ko" => __( "Korean", 'fitnesszone' ),
								"lv" => __( "Latvian", 'fitnesszone' ),
								"ln" => __( "Lingala", 'fitnesszone' ),
								"lt" => __( "Lithuanian", 'fitnesszone' ),
								"ms" => __( "Malay", 'fitnesszone' ),
								"ml" => __( "Malayalam", 'fitnesszone' ),
								"mr" => __( "Marathi", 'fitnesszone' ),
								"no" => __( "Norwegian", 'fitnesszone' ),
								"or" => __( "Oriya", 'fitnesszone' ),
								"fa" => __( "Persian", 'fitnesszone' ),
								"pl" => __( "Polish", 'fitnesszone' ),
								"pt_BR" => __( "Portugese (Brazil)", 'fitnesszone' ),
								"pt_PT" => __( "Portugese (Portugal)", 'fitnesszone' ),
								"ro" => __( "Romanian", 'fitnesszone' ),
								"ru" => __( "Russian", 'fitnesszone' ),
								"sr" => __( "Serbian", 'fitnesszone' ),
								"sk" => __( "Slovak", 'fitnesszone' ),
								"sl" => __( "Slovenian", 'fitnesszone' ),
								"es" => __( "Spanish", 'fitnesszone' ),
								"sv" => __( "Swedish", 'fitnesszone' ),
								"gsw" => __( "Swiss German", 'fitnesszone' ),
								"ta" => __( "Tamil", 'fitnesszone' ),
								"te" => __( "Telugu", 'fitnesszone' ),
								"th" => __( "Thai", 'fitnesszone' ),
								"tr" => __( "Turkish", 'fitnesszone' ),
								"uk" => __( "Ukranian", 'fitnesszone' ),
								"vi" => __( "Vietnamese", 'fitnesszone' ))
						),array(
							"id"=>		"fb_like",
							"label"=>	__("Show Facebook like",'fitnesszone'),
							"options"=>	array(
								"standard"=>__("Standard",'fitnesszone'),
								"box_count" =>__("Box Count",'fitnesszone'),
								"button_count" =>__("Button Count",'fitnesszone')),
							"color-scheme"=>array("dark","light")
						),array(
							"id"=>		"digg",
							"label"=>	__("Show Digg",'fitnesszone'),
							"options"=>	array(
									"DiggWide"=>__("Wide",'fitnesszone'),
									"DiggMedium"=>__("Medium",'fitnesszone'),
									"DiggCompact"=>__("Compact",'fitnesszone'),
									"DiggIcon"=>__("Icon",'fitnesszone'))
						),array(
							"id"=>		"stumbleupon",
							"label"=>	__("Show Stumbleupon",'fitnesszone'),
							"options"=>	array(
										"1"=>__("style1",'fitnesszone'),
										"2"=>__("style2",'fitnesszone'),
										"3"=>__("style3",'fitnesszone'),
										"4"=>__("style4",'fitnesszone'),
										"5"=>__("style5",'fitnesszone'),
										"6"=>__("style6",'fitnesszone'))
						),array("id"=>		"linkedin",
							"label"=>	__("Show LinkedIn",'fitnesszone'),
							"options"=>	array("1"=>"style1","2"=>"style2","3"=>"style3")
						),array(
							"id"=>		"pintrest",
							"label"=>	__("Show Pintrest",'fitnesszone'),
							"options"=>	array("none" =>__("None",'fitnesszone'),"vertical" =>__("Vertical",'fitnesszone'),"horizontal"=>__("Horizontal",'fitnesszone'))
						),array(
							"id"=>		"delicious",
							"label"=>	__("Show Delicious",'fitnesszone'),
							"text"=>""
						),array(
							"id"=>		"twitter",
							"label"=>	__("Show Twitter",'fitnesszone'),
							"options"=>	array(
								"none" => __("None",'fitnesszone'),
								"vertical" => __("Vertical",'fitnesszone')
								,"horizontal"=>__("Horizontal",'fitnesszone')),
							"username"=>'',
							"lang"=>	array(
							    ""	 => __("Select",'fitnesszone'),
								"fr" => __( "French",'fitnesszone' ),
								"de" => __( "German",'fitnesszone' ),
								"it" => __( "Italian",'fitnesszone' ),
								"ja" => __( "Japanese",'fitnesszone' ),
								"ko" => __( "Korean",'fitnesszone' ),
								"ru" => __( "Russian",'fitnesszone' ),
								"es" => __( "Spanish",'fitnesszone' ),
								"tr" => __( "Turkish",'fitnesszone' ))
						));?>