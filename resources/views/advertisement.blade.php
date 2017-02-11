@extends('layouts.admin')

@section('content')
	<div class="advertisement">
		<div class="header_ads">
			<div class="header_ads_left">
				<div class="header_ads_left_form">
					<input type="text" value="Untitled Campaign Create 2017/02/01" readonly>
					<i class="fa fa-pencil" aria-hidden="true"></i>
				</div>
			</div>
			<div class="header_ads_right">
				<div class="header_ads_right_menu">
					<span class="harm_save"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</span>
					<span class="harm_undo"><i class="fa fa-undo" aria-hidden="true"></i> Undo</span>
					<span class="harm_redo"><i class="fa fa-repeat" aria-hidden="true"></i> Redo</span>
					<span class="harm_preview">Preview</span>
					<span class="harm_continue">Continue</span>
				</div>
			</div>
		</div>
		<div class="content_ads">
			<div class="content_ads_left">
				<div class="content_ads_left_nav">
					<span class="calv_build active">Build</span>
					<span class="calv_images">Images</span>
					<span class="calv_design">Design</span>
					<div class="clr"></div>
				</div>
				<div class="content_ads_left_galileo">
					<div class="calg_content_1">
						<div class="calg_content_1_block_1">
							<ul>
								<li>
									<span><img src="https://static.ctctcdn.com/h/galileo-basic-image-editor/3.13.5/img/image.svg" draggable="false"></span>
									<div>Image</div>
								</li>
								<li>
									<span><img src="https://static.ctctcdn.com/h/galileo-aloha-text-editor/2.26.10/img/text.svg" draggable="false"></span>
									<div>Text</div>
								</li>
								<li>
									<span><img src="https://static.ctctcdn.com/h/galileo-button-editor/1.11.3/img/button.svg" draggable="false"></span>
									<div>Button</div>
								</li>
								<li>
									<span><img src="https://static.ctctcdn.com/h/galileo-divider-editor/3.0.12/img/divider.svg" draggable="false"></span>
									<div>Divider</div>
								</li>
								<li>
									<span><img src="https://static.ctctcdn.com/h/galileo-spacer-editor/1.1.4/img/spacer.svg" draggable="false"></span>
									<div>Spacer</div>
								</li>
								<li>
									<span><img src="https://static.ctctcdn.com/h/galileo-social-button-editor/1.4.25/img/Social.svg" draggable="false"></span>
									<div>Social</div>
								</li>
								<li>
									<span><img src="https://static.ctctcdn.com/h/galileo-video-editor/1.0.15/img/video.svg" draggable="false"></span>
									<div>Video</div>
								</li>
								<li class="calg_build_add">
									<span><i class="fa fa-plus" aria-hidden="true"></i></span>
									<div>Add-Ons</div>
								</li>
							</ul>
						</div>
						<div class="calg_content_1_block_2">
							<h3>Layouts</h3>
							<div class="calgc1b2_content">
								<ul>
									<li>
										<span><img src="https://static.ctctcdn.com/galileo/images/templates/Galileo-Build-Palette/Headline-V2.svg" draggable="false"></span>
									</li>
									<li>
										<span><img src="https://static.ctctcdn.com/galileo/images/templates/Galileo-Build-Palette/SectionHeadline-V2.svg" draggable="false"></span>
									</li>
									<li>
										<span><img src="https://static.ctctcdn.com/galileo/images/templates/Galileo-Build-Palette/Article.svg" draggable="false"></span>
									</li>
									<li>
										<span><img src="https://static.ctctcdn.com/galileo/images/templates/Galileo-Build-Palette/FeatureArticle-V2.svg" draggable="false"></span>
									</li>
									<li>
										<span><img src="https://static.ctctcdn.com/galileo/images/templates/Galileo-Build-Palette/TwoColumn-V2.svg" draggable="false"></span>
									</li>
									<li>
										<span><img src="https://static.ctctcdn.com/galileo/images/templates/Galileo-Build-Palette/Feature-TwoColumn-Split.svg" draggable="false"></span>
									</li>
									<li>
										<span><img src="https://static.ctctcdn.com/galileo/images/templates/Galileo-Build-Palette/TwoColumnMixed-V2.svg" draggable="false"></span>
									</li>
									<li>
										<span><img src="https://static.ctctcdn.com/galileo/images/templates/Galileo-Build-Palette/Coupon-V2.svg" draggable="false"></span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="calg_content_2">
						<div class="calg_content_2_block_1">
							<div class="calg_c2b1_left">
								<div class="calg_c2b1_left_inner">
									<span>All (1)</span>
									<i class="fa fa-chevron-down" aria-hidden="true"></i>
								</div>
								<ul>
									<li>All (1)</li>
								</ul>
							</div>
							<div class="calg_c2b1_left">
								<div class="calg_c2b1_left_inner">
									<span>New to Old</span>
									<i class="fa fa-chevron-down" aria-hidden="true"></i>
								</div>
								<ul class="calg_c2b1_left_no_bg">
									<li>Name A-Z</li>
									<li>Name Z-A</li>
									<li>New to Old</li>
									<li>Old to New</li>
								</ul>
							</div>
						</div>
						<div class="calg_content_2_block_2">
							<p><span>Upload</span> images here</p>
							<img title="Click and drag to add Chrysanthemum.jpg" src="https://mlsvc01-prod.s3.amazonaws.com/f958ef46601/6630c99c-4863-4d76-8b6d-74112d808418-thumbnail.jpg">
						</div>
					</div>
					<div class="calg_content_3">
						<div class="calg_content_3_block_1">
							<div class="calg_c3b1_inner">
								<h3>Backgrounds</h3>
								<div class="calg_c3b1_content">
									<div class="calg_b3_div_public">
										<p>Outer Background</p>
										<span>&nbsp;</span>
									</div>
									<div class="calg_c3b1_hcn">
										<span>Change Pattern</span>
									</div>
									<div class="calg_b3_div_public">
										<p>Inner Background</p>
										<span class="hv_inner">&nbsp;</span>
									</div>
								</div>
							</div>
						</div>
						<div class="calg_content_3_block_1">
							<div class="calg_c3b1_inner">
								<h3>Styles</h3>
								<div class="calg_c3b1_content">
									<div class="calg_b3_div_public">
										<p>Button & Dividers</p>
										<span class="hv_button">&nbsp;</span>
									</div>
									<div class="calg_b3_div_public">
										<p>Headlines</p>
										<span class="hv_head">&nbsp;</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="content_ads_right">
				<div class="content_ads_right_top">
					<p><span>Form: </span>AS Special Events Party and Tent Rentals (bobby@asspecialevents.com) </p>
					<p><span>Reply: </span>bobby@asspecialevents.com</p>
					<p><span>Subject: </span><strong>The latest news for you</strong></p>
					<p><span>Preheader: </span><strong>You don't want to miss this.</strong></p>
				</div>
				<div class="content_ads_right_bottom">
					<div class="cadsrb_content">
						<div class="cadsrb_content_inner">
							<p class="cadsrb_content_title">Volume XX | Month Day 20XX</p>
							<div class="cadsrb_content_block_1">
								<img image-type="logo-image" alt="" class="" style="" width="220" border="0" hspace="0" vspace="0" src="https://static.ctctcdn.com/galileo/images/templates/Galileo_ImagePlaceholder/340x165.png"     onclick="BrowseServer('cadsrb_img_1', '{{URL::asset('/filemanager/index.html')}}')">
								<input type="hidden"  id="cadsrb_img_1">
								<div>
									<input class="cadsrb_input_focus" type="text" value="Your monthly news & updates">
								</div>
								<p>
									<textarea class="cadsrb_input_focus">Get readers excited about your newsletter with a quick introduction that highlights your main topic, and let the rest of the email cover the details.</textarea>
								</p>
								<span><input class="cadsrb_input_focus" type="text" value="Visit our Website"></span>
								<p class="h_line"></p>
							</div>
							<div class="cadsrb_content_block_2">
								<div class="cadsrb_cb2_left">
									<span><input class="cadsrb_input_focus" type="text" value="Upcoming Events"></span>
									<p><textarea class="cadsrb_input_focus" name="" id="">Keep your message brief, friendly, and to the point. If readers need to know more than you can fit here, add a link to an outside resource that covers the rest.</textarea></p>
									<a href="javascript:;"><input class="cadsrb_input_focus" type="text" value="Link to Additional Resources"></a>
								</div>
								<div class="cadsrb_cb2_right">
									<img image-type="" alt="" class="" style="" width="260" border="0" hspace="0" vspace="0" src="https://static.ctctcdn.com/galileo/images/templates/Galileo_ImagePlaceholder/340x205.png" onclick="BrowseServer('cadsrb_img_1', '{{URL::asset('/filemanager/index.html')}}')">
								</div>
								<div class="clr"></div>
								<p class="h_line"></p>
							</div>
							<div class="cadsrb_content_block_2">
								<div class="cadsrb_cb2_left">
									<span><input type="text" class="cadsrb_input_focus" value="Service Spotlight"></span>
									<p><textarea name="" id="" class="cadsrb_input_focus">Think about the purpose of your email: You want readers to respond in a certain way, so use specific call-to-actions such as visit our website, shop the sale now, or sign up for specials.</textarea></p>
									<a href="javascript:;"><input type="text" class="cadsrb_input_focus" value="Link to Additional Resources"></a>
								</div>
								<div class="cadsrb_cb2_right">
									<img image-type="" alt="" class="" style="" width="260" border="0" hspace="0" vspace="0" src="https://static.ctctcdn.com/galileo/images/templates/Galileo_ImagePlaceholder/340x205.png" onclick="BrowseServer('cadsrb_img_1', '{{URL::asset('/filemanager/index.html')}}')">
								</div>
								<div class="clr"></div>
							</div>
							<div class="cadsrb_content_block_4">
								<p class="cadsrb_pb4_first">Name | Company | Phone | Fax | Email | Website</p>
								<p class="cadsrb_pb4_last">STAY CONNECTED</p>
								<div class="cards_cb4_icon">
									<i class="fa fa-facebook" aria-hidden="true"></i>
									<i class="fa fa-twitter" aria-hidden="true"></i>
									<i class="fa fa-linkedin" aria-hidden="true"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clr"></div>
		</div>
	</div>
@endsection