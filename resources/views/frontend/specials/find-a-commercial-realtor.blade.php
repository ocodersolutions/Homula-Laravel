@extends('layouts.frontend')

@section("title","Find A Commercial Realtor")

@section('content')
<style type="text/css">
    .search-agents h3 {
        background: none;
    }
    article.page {
        padding: 0;
        margin: 0;
        background: none;
    }
    h1.agents-content-title {
        background: #039be5;
        color: #fff;
        font-size: 32px;
        padding: 10px;
        text-transform: uppercase;
        margin-top: 50px;
    }
    @media (min-width: 1899px){
        body .container {
            width: 1140px;
    }

</style>
<div class="main">


<div id="outer-wrap" class="cover" data-background-image="/images/banner.jpg" style="background-image: url(&quot;/images/banner.jpg&quot;);"></div>

<div class="new-title-search">

    <form id="survey" method="post" action="" class="ng-pristine ng-valid">
        <div class="survey">
            <div class="shadow-box ask-1" style="margin-top: 45px;display: block; " data-ask="1">
                <h1>Find the best real estate agent for your needs.</h1>
                <p> Working with the right agent makes all the difference.
                    <br>100% Free. No obligation.</p>
                <div style="display: inline-block;">
                    <div class="button-row">
                        <input type="text" placeholder="Enter City or Postal code" required="" name="location" class="form-control">
                    </div>
                    <div class="button-row">
                        <button type="button" class="btn"><span class="ink animate" style="height: 202px; width: 202px; top: -70px; left: -25.4844px;"></span>FIND MY PERFECT AGENT</button>
                    </div>
                </div>
            </div>
        
            <div class="shadow-box ask-2" style="display: none;" data-ask="2">
                <h1>Are you looking to buy or sell?</h1>
                <div class="button">
                    <button type="button" class="btn btn-buy">BUY</button>
                    <input type="radio" name="buyorsell" value="buy">
                </div>
                <div class="button">
                    <button type="button" class="btn btn-sell">SELL</button>
                    <input type="radio" name="buyorsell" value="sell">
                </div>
                <div class="button">
                    <button type="button" class="btn btn-sell">RENT</button>
                    <input type="radio" name="buyorsell" value="rent">
                </div>
                <div class="back-button">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i><span>BACK</span>
                </div>
            </div>

            <div class="shadow-box ask-3" style="display: none;" data-ask="3">
                <h1>What do you plan to spend on your new home?</h1>
                
                <div class="button-row odd">
                    <button type="button" class="btn">Under 200K</button>
                    <input type="radio" name="price" value="0">
                </div>
                <div class="button-row even">
                    <button type="button" class="btn">$200K - $400K</button>
                    <input type="radio" name="price" value="200-400">
                </div>
                <div class="button-row odd">
                    <button type="button" class="btn">$400K - $600K</button>
                    <input type="radio" name="price" value="400-600">
                </div>
                <div class="button-row even">
                    <button type="button" class="btn">$600K - $800K</button>
                    <input type="radio" name="price" value="600-800">
                </div>
                <div class="button-row odd">
                    <button type="button" class="btn">$800K - $1M</button>
                    <input type="radio" name="price" value="800-1000">
                </div>
                <div class="button-row even">
                    <button type="button" class="btn">Over $1M</button>
                    <input type="radio" name="price" value="1000">
                </div>
                <div class="back-button">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i><span>BACK</span>
                </div>
            </div>

            <div class="shadow-box ask-4" style="display: none;" data-ask="4">
                <h1>What kind of home are you looking for?</h1>
                <div class="button-row odd">
                    <button type="button" class="btn">House</button>
                    <input type="radio" name="type" value="house">
                </div>
                <div class="button-row even">
                    <button type="button" class="btn">Condominium</button>
                    <input type="radio" name="type" value="condominium">
                </div>
                <div class="button-row odd">
                    <button type="button" class="btn">Townhouse</button>
                    <input type="radio" name="type" value="townhouse">
                </div>
                <div class="button-row even">
                    <button type="button" class="btn">Commercial</button>
                    <input type="radio" name="type" value="commercial">
                </div>
                <div class="button-row odd">
                    <button type="button" class="btn">Land</button>
                    <input type="radio" name="type" value="land">
                </div>
                <div class="button-row even">
                    <button type="button" class="btn">Business</button>
                    <input type="radio" name="type" value="business">
                </div>
                <div class="back-button">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i><span>BACK</span>
                </div>
            </div>

            <div class="shadow-box ask-5" style="display: none;" data-ask="5">
                <h1>It's most important to me that my agent...</h1>

                <div class="button">
                    <button type="button" class="btn">Has lots of experience</button>
                    <input type="radio" name="important" value="experience">
                </div>
                <div class="button">
                    <button type="button" class="btn">Gets me the best price</button>
                    <input type="radio" name="important" value="price">
                </div>
                <div class="button">
                    <button type="button" class="btn">Spends lots of time with me</button>
                    <input type="radio" name="important" value="time">
                </div>
                <div class="button">
                    <button type="button" class="btn">Can close fast</button>
                    <input type="radio" name="important" value="fast">
                </div>
                <div class="back-button">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i><span>BACK</span>
                </div>
            </div>   
            <div class="shadow-box ask-6" data-ask="6" style="display: none;">
                <h1>We value your privacy. How can your agent reach you?</h1>
                <h3 style="margin-top: -12px;">We'll search our database of participating agents to find an agent with:</h3>
                <dl>
                    <dd><i class="fa fa-check" aria-hidden="true"></i> A verified license to work in</dd>
                    <dd><i class="fa fa-check" aria-hidden="true"></i> Positive customer reviews</dd>
                    <dd><i class="fa fa-check" aria-hidden="true"></i> Availability</dd>
                </dl>
                <div class="button-row">
                    <label> Full Name: </label>
                    <input type="text" required="" name="fullname" class="form-control">
                </div>
                <div class="button-row">
                    <label> Phone: </label>
                    <input type="number" required="" name="phone" maxlength="18" class="form-control">
                </div>
                <div class="button-row">
                    <label> Email:  </label>
                    <input type="email" required="" name="email" class="form-control">
                </div>
                <div class="button-row">
                    <label> Best time to contact?  </label>
                    <select name="time" class="form-control">
                      <option value="" disabled="" selected="">Please Select a Time</option>
                      <option value="rightnow">Right Now</option>
                      <option value="morning">Morning</option>
                      <option value="afternoon">Afternoon</option>
                      <option value="evening">Evening</option>
                    </select>
                </div>
                <div class="button-row">
                    <button type="submit" class="btn">FIND THE BEST AGENT NOW</button>
                </div>
                <div class="back-button">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i><span>BACK</span>
                </div>
            </div>
        </div>
    </form>
</div>
</div>


<div class="search-agents">
    <div class="container"><h3></h3></div>
    <div class="search-agents-main">
        <div class="search-agents-content">
            <form action="">
                <input type="text" placeholder="Search here...">
                <button><i class="fa fa-search" aria-hidden="true"></i> SEARCH</button>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
    <div class="col-sm-12">
        <article id="page-596" class="post-596 page type-page status-publish">
            <h2 class="page-header test-homula1">Find a commercial realtor</h2>
            <p><span style="font-weight: 400;">The top </span>Toronto real estate <span style="font-weight: 400;">agents</span> <span style="font-weight: 400;">are on the Homula team! We have agents that are experts in both commercial and </span>residential real estate ,<span style="font-weight: 400;"> as well as agents who specialize in one industry. Finding a commercial realtor with the ability to get you a great deal is extremely easy with Homula. Our agents will guide you through the </span>MLS listing <span style="font-weight: 400;">software in hopes of locating your future space.</span>
                <br>
                <img class="img-responsive" src="/images/find-a-commercial-realtor-img-main.jpg" alt="">
            </p>
            <h3>The Benefits of Hiring a Commercial Realtor</h3>
            <p><span style="font-weight: 400;">Buying or selling your commercial property is a huge deal. It is important that you consider hiring a realtor to aid you through the confusing process of home buying or selling. When you hire one of our experts, their fiduciary responsibility is you. They are contractually bound to protect you and look out for your best interests. Our </span><a href="http://realestate.homula.com/agents/">real estate agents </a><span style="font-weight: 400;">&nbsp;have the expertise and experience to help sellers protect their investment, and help buyers acquire theirs. </span>
            </p>
            <p><span style="font-weight: 400;">Another great reason to hire a realtor is due to ever-changing, complex real estate regulations and rules. The knowledge and skillet that a realtor can provide is irreplaceable. It is their job to know the laws, contracts and practices so that they can best serve you. Our realtors know important details about the properties you may be considering. An expert commercial real estate agent uses their knowledge of the current real estate market in order to figure out what the true value of your property is. They will often give you a price range that they feel is accurate and allow you to decide what the final price point is. </span>
            </p>
            <p><span style="font-weight: 400;">Contracts can be tricky and very long documents. Our experts are trained to easily navigate through and understand contracts. In addition, when it comes to negotiation time, your realtor or </span><a href="http://realestate.homula.com/real-estate-lawyer/">real estate lawyer </a><span style="font-weight: 400;">&nbsp;can be your liaison to help you through the process. When you work with representation, you are ensuring you are working with someone who is bound by a code of ethics. </span>
            </p>
            <p><span style="font-weight: 400;">You can expect to be treated with fairness and respect once you connect with one of our agents. Our agents possess intimate knowledge of neighborhoods or at the very least, can find the industry buzz about where you are looking. A realtor can identify comparable sales in the area to help you establish a price point if you are selling, or gauge prices if you are buying. For example, you may know that a home down the street from you was listed for $405,000 but an agent will know that it sold for only $365,000 because it was in need of repairs. </span>
            </p>
            <p><span style="font-weight: 400;">Our experts have information about the<a href="http://realestate.homula.com/latest-trends-sweeping-real-estate-market-toronto/"> market conditions</a> such as average days on the market, average home prices per square foot, and more. Having an agent is also very beneficial because of their ability to network. A realtor will know of companies in the area, and may have worked with some of them. They offer suggestions and provide you with a list of references from which you can do your own research. Agents are known for their negotiation skills and confidentiality. </span>
            </p>
            <p><span style="font-weight: 400;">There are mounds of paperwork when it comes to buying or selling a home and an agent’s job is to guide you through the process. Your realtor is there to answer any questions or concerns you might have during the home buying or selling process. Agents will do their best when working with you because their business is built upon reputation. If you want to receive guidance during the home buying, selling or investing processes, then you need to </span><a href="http://realestate.homula.com/contact-us/">hire a professional realtor through Homula </a>&nbsp;<span style="font-weight: 400;">today.</span>
            </p>
            <p>&nbsp;</p>
        </article>
    </div>
</div>
</div>

@php 
    $agents = App\Models\Agents::all();
    $properties = App\Models\Properties::orderBy('id','desc')->take(10)->get();
@endphp
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="agents-content-title">Agents</h1>
        </div>
        <div class="agents-content col-sm-12">
            @foreach($agents as $agent)
                <div class="col-sm-6">
                    <div class="agents-item">
                        <div class="agents-item-content">
                            <div class="aic-image">
                                <div class="aic-image-inner">
                                    <a href="/agents/{{$agent->alias}}">
                                        @if ($agent->thumbnail != '')
                                            <img src="{{$agent->thumbnail}}" alt="">
                                        @else 
                                            <img src="/images/agent_no_thum.jpg" alt="">
                                        @endif
                                    </a>
                                </div>
                            </div>
                            <div class="aic-information">
                                <h2><a href="/agents/{{$agent->alias}}">{{$agent->name}}</a></h2>
                                <div class="aic-infor-area-work">
                                    <h3>AREAS YOU WORK IN</h3>
                                    <span>{!!$agent->area_work!!}</span>
                                </div>
                                <div class="aic-infor-spoken-lang">
                                    <h3>SPOKEN LANGUAGES</h3>
                                    <span>{!! $agent->spoken_language !!}</span>
                                </div>
                                <div class="aic-infor-exp">
                                    <h3>EXPERIENCE</h3>
                                    <span>{!! $agent->experience !!}</span>
                                </div>
                                <div class="aic-infor-link">
                                    <a href="" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                    <a href="" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <form action="" class="agents-content-form">
                <button>Ask a question</button>
            </form>
        </div>
        
    </div>
</div>
<div class="top_agents">
    <h2 class="title_hasline">TOP AGENTS</h2>
    <div class="main_top_agents">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="owl-demo-agent" class="owl-carousel owl-theme">    
                        @foreach ($agents as $agent)
                            <div class="item">
                                <div class="top_agents_content">
                                    <div class="avartar_agents">
                                        <a href="/agents/{{$agent->alias}}" target="_blank"><img width="225" height="300" src="{{$agent->thumbnail}}" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="{{$agent->name}} real estate professional on Homula"></a>
                                    </div>
                                    <div class="detail_agents">
                                        <p><a href="/agents/{{$agent->alias}}" target="_blank">
                                        <b>{{$agent->name}}</b></a></p>
                                        <p>{{$agent->spoken_language}}</p>
                                        <p>{!!$agent->email!!}</p><p></p>
                                    </div>
                                    <div class="foot-agent-content" style="">
                                        <a href="/agents/{{$agent->alias}}" target="_blank" class="btn btn-primary">Contact now</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="hot_properties">
    <h2 class="title_hasline">HOT PROPERTIES</h2>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="hot_properties_overflow">
                    <div class="content_one_ads">
                        <div id="owl-demo-home" class="owl-carousel owl-theme">
                            @foreach ($properties as $post)
                                <div class="item">
                                    <div class="hot_properties_item">
                                        <a href="/properties/{{$post->alias}}" target="_blank">
                                            <div class="hot_properties_item_top">
                                                <div class="item_img"><img width="480" height="320" src="{{URL::asset($post->thumbnail)}}" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="image-C3615220-9.jpg">                                                      </div>
                                                <div class="visite_libre">
                                                    <p>VISIT NOW</p>
                                                </div>
                                                <p class="tag_p">+</p>
                                            </div>
                                        </a>
                                        <div class="hot_properties_item_bot">
                                            <b>{{$post->price}}</b>
                                            <p class="main_p">{{$post->content}}</p>
                                            <p><a href="/properties/{{$post->alias}}" target="_blank">{{$post->address}}</a>
                                            </p>
                                            <p class="min_p">{!!$post->location!!}</p>
                                        </div>
                                    </div>
                                </div>  
                            @endforeach 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>








@endsection

@section('script')
@endsection