@extends('layouts.frontend')

@section('content')
	<style>
		.about-us-page *{
			font-size: 15px;
			padding: 0;
			margin: 0;
		}
		.about-us-page a{
			text-decoration: none;
		}
		.about-us-page a:hover{
			color: #3097D1;
		}
		.about_us_one, .about_us_three, .about_us_five {
		    background: #f1f1f1;
		}
		.about_us_two, .about_us_four {
		    background: #ffffff;
		}
		.about_us_public_css {
			width: 1110px;
			margin: 0 auto;
			padding-bottom: 50px;
		}
		.about_us_public_css > img {
		    display: inline-block;
		    float: left;
		    width: 30%;
		    margin-top: 100px;
		}
		.about_us_one .about_us_public_css > img, .about_us_three .about_us_public_css > img, .about_us_five .about_us_public_css > img {
		    display: inline-block;
		    float: right;
		    width: 30%;
		    margin-top: 155px;
		}
		.au_content_two, .au_content_four {
		    width: 70%;
		    text-align: justify;
		    padding: 50px 0px 0px 50px;
		    float: left;
		}
		.about_us_public_css h2 {
		    font-size: 24px;
		    font-weight: bold;
		    color: #0a368a;
		    margin-bottom: 20px;
		    text-transform: uppercase;
		}
		.clr {
		    clear: both;
		}
		.au_content_one, .au_content_three, .au_content_five {
		    width: 70%;
		    text-align: justify;
		    padding: 50px 50px 0px 0;
		}
	</style>
	<div class="about-us-page">
	    <div class="about_us_one">
	        <div class="about_us_public_css">
	            <img src="../images/about-us-img-1.png" alt="">
	            <p></p>
	            <div class="au_content_one">
	                <h2>About Us</h2>
	                <p>Homula is the most comprehensive Toronto real estate website in which serves the purpose of bringing all of your real estate needs under one roof. On this powerful website, consumers can easily locate vital information such as, buying or leasing a commercial or residential property, information regarding pre-construction properties, answers to <a class="content-interlink" href="http://realestate.homula.com/faq/" target="_blank">frequently asked question</a>, a free estimate on your properties’ value and news articles written by industry experts. In addition to the vast variety of services mentioned above, Homula also provides residents with a comprehensive list of the top realtors, lawyers, mortgage brokers, home inspectors, property managers, marketers and other industry experts. By navigating through this advanced search engine, residents have access to a wide selection of popular MLS listings. From purchasing your first home to inquiring about potential investment opportunities, Homula will surely assist you.</p>
	                <p>Residents are only provided with information that is factual, up to date and relevant to the real estate industry. Upon reading various articles, you can expect to be well versed in the most relevant topics such as; current mortgage rates, how to increase your properties’ value, how to invest in real estate, the status of the current real estate market, and more. Experts pride themselves in being the most knowledgeable, professional and devoted in their industry.</p>
	                <p>Vital information regarding buying, renting, selling, leasing, commercial and residential properties is currently scattered across thousands of platforms on the internet. With this advanced search engine, residents can avoid the often frustrating process of locating information about their real estate needs. Homula is an industry changing website that has finally put an end to both confusion and frustration. It is nearly impossible to locate a website that provides residents with not only updated real estate listings, but expert advice and relevant information as well.</p>
	                <p>Homula will continue to surpass competitors in the real estate industry due to their advanced technology and knowledge. The act of searching for crucial information in regards to real estate is now over. Each day, a large number of experts are added to this powerful real estate search engine for the purpose of granting residents with an even higher chance of becoming knowledgeable and remaining up to date in the real estate industry. &nbsp;Without a doubt, residents will receive the most updated, relevant and factual information.</p>
	                <p>The process of <a class="content-interlink" href="http://realestate.homula.com/canada-search/" target="_blank">searching for the perfect home</a>, selling your current home, receiving answers to your many questions, remaining up to date with the current real estate trends, connecting with world renowned experts and other vital information is now easier than it has ever been before.</p>
	            </div>
	            <div class="clr"></div>
	        </div>
	    </div>
	    <div class="about_us_two">
	        <div class="about_us_public_css">
	            <img src="../images/about-us-img-2.png" alt="">
	            <p></p>
	            <div class="au_content_two">
	                <h2>BEST REAL ESTATE SEARCH CANADA 2016</h2>
	                <p>The record real estate prices were skyrocketed with the boom in housing industry of Canada. This has also given rise to exceptional quantity of realtors in the GTA. In the first quarter of the year, there were 108,706 numbers of people who used to sell their real estate properties, said the CREA (Canadian Real Estate Association). If we sum it up, we come to know that out of 249 Canadians, their used to be one Realtor with the age of 19 years-age group. Amongst other cities in Canada, Toronto is considered as most significant city for the Global Real Estate Market with $1-million detached homes recorded-as per report. There is a bubble in the agents residing in Toronto as this city is becoming the hottest property in Canada.</p>
	                <p>TREB which is generally referred as Toronto Real Estate Board was unable to give the exact numbers as far as their members are concerned but considering the TREB’s boiler plate statement-the sell has reached 39,000 people that are near about 140 people in the GTA. In the year of 2012, December-the numbers were around 35,000. However in 2015, this number has reached 31,000.One of the member of TREB have said that their used to be 20,000 members in the community, a years ago and the number of people who used to sell houses were more than that of people making the houses. The Statistics of Canada have added fun to it by saying that there are 131,000 carpenters whereas the cooks in Canada are recorded to 202,200 in the labor force survey 2013.</p>
	            </div>
	            <div class="clr"></div>
	        </div>
	    </div>
	    <div class="about_us_three">
	        <div class="about_us_public_css">
	            <img src="../images/about-us-img-3.png" alt="">
	            <p></p>
	            <div class="au_content_three">
	                <h2>MARKET OPPORTUNITIES FOR EVERYONE</h2>
	                <p>1: The real estate agents have an incredible profit if the real estate market of Toronto would be like this. They will be in a search of person who is responsible to sell their house so that the agents will get some extra buck as commission which is around 5% of the total house price. This will be the career of the agent in case the market price is high in Toronto. The rates of commission are 5% in states like Ontario, whereas other states have slightly higher rates than this.</p>
	                <p>2: The prices of single family houses are raising high in GTA, further giving an opportunity for all the realtors and brokers to make business in real estate housing properties. As per the report from TREB, $965,670 was the total price that received after selling the homes last month. It is almost 13.25 high as compared to the percentage of last year. The realtors are planning to split $50,000 at $1-million.</p>
	                <p>3: Mr. Dale who is the president of Zolo-the search engine for real estate search has said that the strength of the market is giving rise to allure of the market. It is a logical fact that zolo can never beat the 1.2 million implemented data site for real estate -Homula.</p>
	                <p>4: It greatly depends on the rules of different states that how many of them can involve in the global real estate market and make money for their state. The Ontario’s is said to be the largest market of real estate in which Ontario Real Estate Association is responsible for providing trainings but the regulation is done by Real Estate Council of Ontario.</p>
	                <p>5: Canada’s experience in the real estate market is better as compared to the U.S. This is not the only reason that should be considered for doing business in real estate in Canada, because some of the experienced members in Canada real estate are speculating that the increasing number of debt level will give rise to increase in housing prices. This clearly gives a signal that the golden days of Canada are on higher risk if the debt levels are not maintained. Time will only decide the future of Canada real estate market potential in comparison with bubble bust of U.S.</p>
	            </div>
	            <div class="clr"></div>
	        </div>
	    </div>
	    <div class="about_us_four">
	        <div class="about_us_public_css">
	            <img src="../images/about-us-img-4.png" alt="">
	            <p></p>
	            <div class="au_content_four">
	                <h2>HOW HOMULA DIFFERENTIATES FROM ALL OTHER SEARCH ENGINES</h2>
	                <p>1: Homula is the best platform for all entrepreneurs to do business in Real estate Market. It is referred by most of the people who reside in Toronto, for their public version of the MLS listings. This is the largest site with almost 1.2 million data being implemented in search. The database of this site is registered with the licensed brokers and agents. Your search for new home becomes easy with Homula as it provides you the accessibility to search, further providing all the components that you expect in the MLS listing.</p>
	                <p>2: The most significant thing about this site is it’s free app that can be used anytime and anywhere. The major platforms where you can use this app include Windows, Blackberry, iPhone, iPad and Android. This app will help you to leverage the GPS of your smartphone so that it finds open houses and properties along with driving directions in your area. The site is far better than Realtor –which is search engine site for real estate having search option 1.2 million data records, whereas Homula’s search has over 1.2 million property data search option.</p>
	                <p>3: Toronto real estate listings help the potential buyers to give all updates that were quite impossible few years ago. Gone are the days when you used to be dependent on the licensed broker or the agent for buying properties. With the launch of Homula site, you can easily access all the info regarding real estate from tip of your finger. The buyers are getting more opportunity to buy home online with the access of real estate data that is stored in the huge database of Homula. In Toronto you will get multiple options for buying the Toronto real estate property with Homula. This site is far greater than Zolo-which is n search engine for real estate. Zolo only has 120 thousand options for property search whereas Homula’s database is far bigger than zolo.</p>
	                <p>4: Zoocasa is another search engine for real estate having good search options for property. The Homula is very superior to Zoocasa as Real estate search can be done quickly with access to all the demographic info such as most common occupations, average household income and educational background that are very difficult to get on any other Real estate site. The clear view of the room size including the property description makes the site unique with all such features. You will eventually get all the smarter elements in the Homula site. The social media connection provides you to get connected with the new updates that you can share or post on your Facebook, so that your friends and relatives will come to know about the recent properties.</p>
	                <p>5: Those who are extremely new in the real estate market for homes and condos should opt for Homula site in the first place. This is the most complete search website in Canada for your real estate needs. The site is very functional and straightforward. It has almost 7,000 listings related to Canada’s latest housing listings. Other features include one handy access that gives you the accessibility to sign-up for the alerts so that you can get new listings in very efficient manner. The alert will be delivered to your inbox, further giving you more convenience to buy homes. The GPS of your phone will show all the details regarding the location of that specific property. This way your task of finding the home will be surprisingly reduced.</p>
	            </div>
	            <div class="clr"></div>
	        </div>
	    </div>
	    <div class="about_us_five">
	        <div class="about_us_public_css">
	            <img src="../images/about-us-img-5.png" style="margin-top: 50px;" alt="">
	            <p></p>
	            <div class="au_content_five">
	                <h2>CONCLUSION</h2>
	                <p>The Real estate home will be found more easily with Homula website as the site provides all essential elements required for buying the home. You will be getting every update about the MLS listing through your phone. The Real estate market in Toronto is gaining momentum and in such scenario, Homula will help you incredibly with its smart features and handy access to property info. Homula is the best real estate search in Canada, 2016. People of Toronto will become more up to date and they will have great opportunity in their business through this site. Your real estate search will become quite convenient with Homula.
	                </p>
	            </div>
	            <div class="clr"></div>
	        </div>
	    </div>
    </div>
@endsection
