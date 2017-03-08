@extends('layouts.frontend')

@section("title") {{$help_centre->question}} @endsection

@section('content')
	<style type="text/css">
		.help-centre-detail-page {
			margin-top: 50px;
	        margin-bottom: 60px;
		}
		#form_help_centre {
		    position: relative;
		    margin-bottom: 50px;
		}
		#form_help_centre input[type=text] {
		    width: 100%;
		    border: 1px solid;
		    padding: 5px 15px;
		    background: #fff;
		    box-shadow: 0 1px 0 0 rgba(0,0,0,0.12);
		    font-size: 16px;
		    height: 48px;
		    line-height: 48px;
		    transition: box-shadow .12s linear;
		}
		#form_help_centre input[type=text]:focus {
			box-shadow: 0 2px 0 0 #039be5;
		    outline: 0;
		}
		#form_help_centre input[type=submit] {
		    position: absolute;
		    top: 0;
		    right: 0;
		    height: 48px;
		    font-size: 18px;
		    font-weight: bold;
		    background-color: #e91e63;
		    border: 0;
		    border-radius: 0;
		    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.26);
		    color: #fff;
		    padding: 6px 12px;
		    text-transform: uppercase;
		}
		.navigation_help_centre {
		    margin-bottom: 10px;
		}
		.navigation_help_centre a {
		    color: #013888;
		    font-weight: bold;
		    font-size: 16px;
		    text-transform: capitalize;
		}
		.navigation_help_centre span {
		    font-size: 16px;
		    font-weight: bold;
		    margin: 0 10px;
		}
		.navigation_help_centre span:last-child {
		    text-transform: capitalize;
		    margin: 0;
		    color: #777777;
		}
		.sub_posts_about_us {
		    border: 1px solid #4b6088;
		    background: #fcfcfc;
		    padding: 20px;
		}
		h2 {
		    text-align: center;
		    color: #013888;
		    font-size: 28px;
		    font-weight: bold;
		    position: relative;
		    margin-bottom: 35px;
		    text-transform: uppercase;
		}
		h2:before {
		    position: absolute;
		    font-family: FontAwesome;
		    content: "";
		    display: inline-block;
		    left: 50%;
		    transform: translate(-50%);
		    font-size: 12px;
		    top: 40px;
		    background: url(/images/help-centre-line-bg.png);
		    width: 357px;
		    height: 19px;
		}
		.post_datetime {
		    text-align: center;
		    color: #000;
		    font-weight: bold;
		    font-size: 17px;
		    margin-bottom: 30px;
		    line-height: 28px;
		}
		.hcd_posts {
		    padding-bottom: 17px;
		    margin: 0;
		    background: none;
		}
		.type-post {
		    padding: 0;
		    box-shadow: none;
		    background-color: #fff;
		    border-bottom: 1px solid #f5f5f5;
	        margin: 0 0 30px 0;
	        color: #616161;
		    font-size: 15px;
		}
		.post-body {
		    border: 1px solid #cacaca;
		    padding: 20px;
		}
		.post-content {
		    margin-bottom: 60px;
		}
		.post-content ul {
			padding: 0;
		}
		textarea#comment {
			overflow: hidden; 
			word-wrap: break-word; 
			height: 96px; 
			border: 0; 
			box-shadow: 0 1px 0 0 rgba(0,0,0,0.12); 
			resize: none;
		}
		textarea#comment:focus, input[type=text]:focus, input[type=email]:focus {
			box-shadow: 0 2px 0 0 #039be5;
		    outline: 0;
		}
		input[type=submit] {
			background-color: #e91e63;
		    border: 0;
		    border-radius: 0;
		    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.26);
		    color: #fff;
		    font-size: 13px;
		    font-weight: 500;
		    padding: 6px 12px;
		    overflow: hidden;
		    position: relative;
		    text-transform: uppercase;
		    cursor: pointer;
		}

	</style>
	<div class="help-centre-detail-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<form action="" id="form_help_centre" class="ng-pristine ng-valid">
			            <input type="text" name="help_centre_search" placeholder="Search here..." id="help_centre_search" class="ui-autocomplete-input" autocomplete="off">
			            <input type="submit" value="Search">
			        </form>
			        <div class="navigation_help_centre">
					    <a href="/help-centre">Help centre</a><span>&gt;</span>
					    @php $categories = App\Http\Controllers\FrontendController::get_cat($help_centre->categories_id); @endphp
					    <a href="/help-centre/{{$categories->alias}}">{{$categories->name}}</a>
					    <span>&gt;</span>
					    <span>{{$help_centre->question}}</span>
					</div>
					<div class="page_realestate">
					    <div class="sub_posts_about_us">
				            <h2>{{$help_centre->question}}</h2>
				            <p class="post_datetime">
				                Dec 06, 2016 07:38AM </p>
				            <div class="hcd_posts">
				                <article id="post-12530" class="post-single post-12530 post type-post status-publish format-standard category-real-estate-important-questions-help-centre">
				                    <div class="post-body no-thumbnail">
				                        <div class="post-content">
				                            {!! $help_centre->answer !!}
				                        </div>
				                        <div id="comments" class="comments-area">
				                            <div id="respond" class="comment-respond">
				                                <h3 id="reply-title" class="comment-reply-title">Leave a Reply <small><a rel="nofollow" id="cancel-comment-reply-link" href="/information-will-lawyer-need-close-purchase/#respond" style="display:none;">Cancel reply</a></small></h3>
				                                <form action="" method="post" id="commentform" class="comment-form ng-pristine ng-valid">
				                                    <div class="oneall_social_login">
				                                        <div class="oneall_social_login_providers" id="oneall_social_login_providers_3169721">
				                                            <iframe id="oa_social_login_frame_39414" frameborder="0" scrolling="no" allowtransparency="true" data-processed="true" title="Login with Social Networks" name="OneAll Social Login" src="http://realestatehomula.api.oneall.com/socialize/login/frame/?oakk=39414&amp;oakv=eb65bad48e8cf24224108a98f14c7944e1c640ae4c5f979353225adc067dbd01774b1661f1ede3ce93759553345ff57e6d1fdfe8f87aedf004be59db21be71a73f26856bb5fee7e0dc92814f5a6432f0af1080d1d4c057f43f86e0862d2bb8790c8e9c5a7c205f38b96444f2ca3615083a9f80de23501662e9c2677ae4d2bc73a671dcfb856f4d2228b0d96c5a327da0ac64e21658bf0440037101b3f84acca154c221f3d5c00449e9d9e1bd9107844b3e89f667d071090d27b49101d0b4de17d448ea6f10e8d3a0cbbdbe4834d9e1936fd6561faef4366e2054669b4e4cfc7f62677e0ec4fdf02b45daaece9d64cd60a879f97073d09c2ef03c1119f167315ff7456bbf66519251896cadc93d07eae97e8d15ef7ab37f999bb78ee2f7689bbf96f042a976f8af9cc69ca3c2c4ac9ae7e432f83c78e997330185d55264793a10c7fbf1720fbf76e6f72404d645654edc413630287051cd8f17a7f44329a5eeec9881648b87d518b017ca98548db9ead437dac9b23fc2f03292920f4df221a675434942efd011f76da253c145544f5d3e0df9c9f63339800ffe54162cf883c7aa60ea8f7e86f95175240565116f2346677f464b20555cfa85c01b935c00af3ab946aa1aca569279cd6a5eca9c7ca2612f5554cb31733a1e770d4438c3783c72dc8d7514d490e5cfe5ed3771e65e883287831af095e3c30185f44e292eaddc3323322e40bd422d1365f7b7fcd79b21e39f8fd3ec8cc126bc62b766c8d205bb1f41d953ba33590867b6da84d92689f4cf21ea1b60e55050db8eac48fb7809e91820d3a4644d22729e32f33c7910ddfaf94a6a733fe98ed9783dda914b3eff5f07&amp;lang=vi" style="visibility: visible; background-color: transparent; border: 0px none; width: 1056px; height: 61px !important;"></iframe>
				                                        </div>
				                                        <script type="text/javascript">
				                                        var _oneall = _oneall || [];
				                                        _oneall.push(['social_login', 'set_providers', ['facebook', 'google', 'instagram', 'linkedin', 'pinterest', 'twitter']]);
				                                        _oneall.push(['social_login', 'set_callback_uri', (window.location.href + ((window.location.href.split('?')[1] ? '&amp;' : '?') + "oa_social_login_source=comments"))]);
				                                        _oneall.push(['social_login', 'set_custom_css_uri', 'http://public.oneallcdn.com/css/api/socialize/themes/wordpress/default.css']);
				                                        _oneall.push(['social_login', 'do_render_ui', 'oneall_social_login_providers_3169721']);
				                                        </script>
				                                    </div>
				                                    <p class="comment-notes"><span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span></p>
				                                    <p class="comment-form-comment">
				                                        <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="Your comment"></textarea>
				                                    </p>
				                                    <p class="comment-form-author">
				                                        <label for="author">Name <span class="required">*</span></label>
				                                        <input id="author" name="author" type="text" value="" size="30" maxlength="245" aria-required="true" required="required">
				                                    </p>
				                                    <p class="comment-form-email">
				                                        <label for="email">Email <span class="required">*</span></label>
				                                        <input id="email" name="email" type="text" value="" size="30" maxlength="100" aria-describedby="email-notes" aria-required="true" required="required">
				                                    </p>
				                                    <p class="comment-form-url">
				                                        <label for="url">Website</label>
				                                        <input id="url" name="url" type="text" value="" size="30" maxlength="200">
				                                    </p>
				                                    <p class="form-submit">
				                                        <input name="submit" type="submit" id="submit" class="submit" value="Post Comment">
				                                        <input type="hidden" name="comment_post_ID" value="12530" id="comment_post_ID">
				                                        <input type="hidden" name="comment_parent" id="comment_parent" value="0">
				                                    </p>
				                                </form>
				                            </div>
				                        </div>
				                    </div>
				                </article>
				            </div>
					    </div>
					</div>

				</div>
			</div>
		</div>
	</div>
@endsection