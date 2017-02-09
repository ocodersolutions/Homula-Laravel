-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2017 at 04:51 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel-demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `area_work` varchar(255) NOT NULL,
  `spoken_language` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `name`, `email`, `alias`, `thumbnail`, `area_work`, `spoken_language`) VALUES
(1, 'Dany Azar', 'danyazar@realestate.homula.com', 'dany-azar', '/uploads/top_agents/agentphoto-1.png', 'First time buyers<br> York region', 'English Arabic some french'),
(2, 'Samir Arora', 'samirarora@realestate.homula.com', 'samir-arora', '/uploads/top_agents/agentphoto-2.png', 'Head Office<br> 211 Consumers Rd., Suite 105<br> Toronto ON M2J 4G8', ''),
(3, 'Sameer Amini', 'sameeramini@realestate.homula.com', 'sameer-amini', '/uploads/top_agents/agentphoto-3.png', 'Toronto + Durham Region', 'Farsi, Urdu, Dari, English'),
(4, 'John Redmond', 'johnredmond@realestate.homula.com', 'john-redmond', '', 'Effectivity Real Estate<br> Wardrobe Street 90210', ''),
(5, 'Bill Kaluski', 'billkaluski@realestate.homula.com', 'bill-kaluski', '/uploads/top_agents/agentphoto-4.jpg', 'Toronto York Region Simcoe Region Durham Region', 'English'),
(6, 'Sarah Zamanifar', 'sarahzamanifar@realestate.homula.com', 'sarah-zamanifar', '/uploads/top_agents/agentphoto-5.png', '211 Consumers Rd., Suite 105<br> Toronto ON M2J 4G8', ''),
(7, 'Alaadin Zahran', 'alaadinzahran@realestate.homula.com', 'alaadin-zahran', '/uploads/top_agents/agentphoto-6.png', '95 Queen Street South, Unit A<br> Mississauga ON L5M 1K7', ''),
(8, 'Nedi Vozis-Penev', 'vozispenev@realestate.homula.com', 'nedi-vozis-penev', '/uploads/top_agents/agentphoto-7.png', '211 Consumers Rd., Suite 105<br> Toronto ON M2J 4G8', ''),
(9, 'Paul Tobias', 'paultobias@realestate.homula.com', 'paul-tobias', '/uploads/top_agents/agentphoto-8.png', '211 Consumers Rd., Suite 105<br> Toronto ON M2J 4G8', ''),
(10, 'Frank Talaei', 'franktalaei@realestate.homula.com', 'frank-talaei', '/uploads/top_agents/agentphoto-9.png', '10 Royal Orchard Blvd, Suite 1<br> Thornhill ON L3T 3C3', ''),
(11, 'Ying-Ho Tam', 'yinghotam@realestate.homula.com', 'ying-ho-tam', '/uploads/top_agents/agentphoto-10.png', '10 Royal Orchard Blvd, Suite 1<br> Thornhill ON L3T 3C3', ''),
(12, 'Simone Sue-A-Quan', 'sueaquan@realestate.homula.com', 'simone-sue-a-quan', '/uploads/top_agents/agentphoto-11.png', '211 Consumers Rd., Suite 105<br> Toronto ON M2J 4G8', ''),
(13, 'Arun Sharma', 'arunsharma@realestate.homula.com', 'arun-sharma', '/uploads/top_agents/agentphoto-12.png', '10 Royal Orchard Blvd, Suite 1<br> Thornhill ON L3T 3C3', ''),
(14, 'Naz Sala', 'nazsala@realestate.homula.com', 'naz-sala', '', 'Markham, Richmond Hill, North York, Toronto, Stouffville, <br>', 'English, Farsi'),
(15, 'Fara Sadeghi', 'farasadeghi@realestate.homula.com', 'fara-sadeghi', '/uploads/top_agents/agentphoto-13.png', '10 Royal Orchard Blvd, Suite 1<br> Thornhill ON L3T 3C3', ''),
(16, 'Farah Ravji', 'farahravji@realestate.homula.com', 'farah-ravji', '/uploads/top_agents/agentphoto-14.png', '10 Royal Orchard Blvd, Suite 1<br> Thornhill ON L3T 3C3', ''),
(17, 'Rajiv Rajak', 'rajivrajak@realestate.homula.com', 'rajiv-rajak', '/uploads/top_agents/agentphoto-15.png', '211 Consumers Rd., Suite 105<br> Toronto ON M2J 4G8', ''),
(18, 'Brian Pcolinsky', 'brianpcolinsky@realestate.homula.com', 'brian-pcolinsky', '/uploads/top_agents/agentphoto-16.png', '95 Queen Street South, Unit A<br> Mississauga ON L5M 1K7', ''),
(19, 'Anda Panait-Rodgers', 'andapanaitrodgers@realestate.homula.com', 'anda-panait-rodgers', '/uploads/top_agents/agentphoto-17.png', '211 Consumers Rd., Suite 105<br> Toronto ON M2J 4G8', ''),
(20, 'Allen Naseri', 'allennaseri@realestate.homula.com', 'allen-naseri', '/uploads/top_agents/agentphoto-18.png', '211 Consumers Rd., Suite 105<br> Toronto ON M2J 4G8', ''),
(21, 'Joe Montimurro', 'joemontimurro@realestate.homula.com', 'joe-montimurro', '/uploads/top_agents/agentphoto-19.png', '10 Royal Orchard Blvd, Suite 1<br> Thornhill ON L3T 3C3', ''),
(22, 'Mihan Manteghi', 'mihanmanteghi@realestate.homula.com', 'mihan-manteghi', '/uploads/top_agents/agentphoto-20.png', '', ''),
(23, 'Silvia Moreno-IP', 'silviamoreno@realestate.homula.com', 'silvia-moreno-ip', '/uploads/top_agents/agentphoto-21.png', 'Greater Toronto Area with focus on York Region<br>', 'English, Spanish, French'),
(24, 'Jahleeki Lowe', 'jahleekilowe@realestate.homula.com', 'jahleeki-lowe', '/uploads/top_agents/agentphoto-22.png', '3082 Bloor St. West<br> Toronto ON M8X 1C8', ''),
(25, 'Mimi Long', 'mimilong@realestate.homula.com', 'mimi-long', '/uploads/top_agents/agentphoto-23.png', '10 Royal Orchard Blvd, Suite 1<br> Thornhill ON L3T 3C3', ''),
(26, 'Behnam Ghasemian', 'behnamghasemian@realestate.homula.com', 'behnam-ghasemian', '/uploads/top_agents/agentphoto-24.png', '10 Royal Orchard Blvd, Suite 1<br> Thornhill ON L3T 3C3', ''),
(27, 'Melissa Gholamhassani', 'melissagholamhassani@realestate.homula.com', 'melissa-gholamhassani', '/uploads/top_agents/agentphoto-25.png', 'Richmond Hill, New Market, North york', 'English, Persian, Turkish'),
(28, 'Eliza Hilario', 'elizahilario@realestate.homula.com', 'eliza-hilario', '/uploads/top_agents/agentphoto-26.png', '211 Consumers Rd., Suite 105<br> Toronto ON M2J 4G8', ''),
(29, 'Serge Jovicic', 'sergejovicic@realestate.homula.com', 'serge-jovicic', '/uploads/top_agents/agentphoto-27.png', '211 Consumers Rd., Suite 105<br> Toronto ON M2J 4G8', ''),
(30, 'John Jay Kim', 'johnjaykim@realestate.homula.com', 'john-jay-kim', '/uploads/top_agents/agentphoto-28.png', '10 Royal Orchard Blvd, Suite 1<br> Thornhill ON L3T 3C3', ''),
(31, 'Mahi Gholami', 'mahigholami@realestate.homula.com', 'mahi-gholami', '/uploads/top_agents/agentphoto-29.png', '211 Consumers Rd., Suite 105<br> Toronto ON M2J 4G8', ''),
(32, 'Matthew Dumouchel', 'matthewdumouchel@realestate.homula.com', 'matthew-dumouchel', '/uploads/top_agents/agentphoto-30.png', '10 Yonge St., Unit 113-115<br> Toronto ON M5E 1R4', ''),
(33, 'Janina Crone', 'janinacrone@realestate.homula.com', 'janina-crone', '/uploads/top_agents/agentphoto-31.png', '211 Consumers Rd., Suite 105<br> Toronto ON M2J 4G8', ''),
(34, 'Julia Crane', 'juliacrane@realestate.homula.com', 'julia-crane', '/uploads/top_agents/agentphoto-32.png', '10 Royal Orchard Blvd, Suite 1<br> Thornhill ON L3T 3C3', ''),
(35, 'Willie L. Christian', 'willielchristian@realestate.homula.com', 'willie-l-christian', '/uploads/top_agents/agentphoto-33.png', '211 Consumers Rd., Suite 105<br> Toronto ON M2J 4G8', ''),
(36, 'Harry Cardoso', 'harrycardoso@realestate.homula.com', 'harry-cardoso', '/uploads/top_agents/agentphoto-34.png', 'Thornhill Office<br>10 Royal Orchard Blvd, Suite 1<br> Thornhill ON L3T 3C3', '');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) NOT NULL,
  `title` varchar(200) NOT NULL,
  `alias` varchar(200) NOT NULL,
  `thumbnail` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `excerpt` varchar(500) NOT NULL,
  `categories_id` int(10) NOT NULL,
  `published` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `alias`, `thumbnail`, `link`, `content`, `excerpt`, `categories_id`, `published`, `created_at`, `updated_at`) VALUES
(1, 'What is Title Insurance and what does it cover?', 'what-is-title-insurance-and-what-does-it-cover', '', '', '<p>Title insurance is now widely accepted by mortgage lenders including the major banks, trust companies, credit unions and private lenders.</p>\r\n', '<p>Title insurance is now widely accepted by mortgage lenders including the major banks, trust companies, credit unions and private lenders</p>\r\n', 3, 1, '2016-11-30 17:00:00', '2017-02-07 20:55:45'),
(2, 'What if You Find a Realtor in Toronto and They’re Terrible?', 'what-if-you-find-a-realtor-in-toronto-and-they-are-terrible', '/uploads/articles_news/news-1.jpg', '', '<p>Everyone has advice when you&rsquo;re trying to <a href="http://realestate.homula.com/find-a-realtor/" target="_blank">find a Realtor in Toronto</a>. Everyone says, &ldquo;You have to work with my Realtor. They&rsquo;re the best.&rdquo; But they can&rsquo;t all be the best... Can they? Not only can a bad realtor cost you thousands of dollars, they can also cost you your dream home by mucking up the offer, or some other part of the process. Here are a few reasons why it&rsquo;s dangerous to work with the wrong Realtor. <img alt="Find A Realtor Toronto" src="http://realestate.homula.com/wp-content/uploads/2016/11/real-estate-gg.jpg" style="height:500px; width:600px" /></p>\r\n\r\n<h2>Because it&rsquo;s Actually TOO Easy to Find a Realtor in Toronto</h2>\r\n\r\n<p>It is so easy to open Google, click a few ads and think you&rsquo;ve found a world-class Realtor. The problem is that a Realtor can easily look the part, without delivering the goods. It&rsquo;s never been cheaper or easier for anyone to get a professional and amazing looking website, or great looking postcards. But great marketing from a Realtor does not necessarily equal great service. They may have more style than substance.</p>\r\n\r\n<h2>Because They Need to Close the Deal. Nothing Else Matters</h2>\r\n\r\n<p>Finding houses for you is only part of the job. Your Realtor could do the <a href="http://realestate.homula.com/realestate-search/">best real estate search in Canada</a>, but it doesn&rsquo;t help you unless they can actually close these homes for you. Of course, it takes skill to be able to showcase a home professionally and get the buyer excited about the property. But in the hyper-competitive Toronto real estate market, there is almost always going to be a bidding war. The price you see in the MLS listing is only the start. Your Realtor needs to put together a simple and compelling offer, with the price and conditions that your buyer will want. The offer and the process are where a truly great real estate agent will shine. Because There&rsquo;s So Much at Stake in the Toronto Real Estate Market Overpaying for a home in most markets may mean you paid a few extra thousand dollars. But in Toronto, that number can easily swell into the tens of thousands of dollars in a hurry. You&rsquo;ve scanned <a href="http://realestate.homula.com/history-mls-listings-toronto/">MLS listings</a>, you can see what&rsquo;s at stake. You need to ensure your Realtor is dialed into the <a href="http://realestate.homula.com/toronto-real-estate-market-booms-despite-warnings/">Toronto market</a>. That means they&rsquo;re not just aware of the current trends, they can predict where the market is heading.</p>\r\n\r\n<h2>Because You May Not Know They Were Bad Until Years Later</h2>\r\n\r\n<p>Here&rsquo;s a nightmare scenario that&rsquo;s a little too real for most buyers. You find a real estate agent. They suggest you skip the home inspection because the seller has other aggressive offers on the table. This could bring your offer to the top. They said they&rsquo;ve inspected the house themselves and it looks amazing. Fast forward a few years. You learn that the house actually has massive structural issues, and you&rsquo;re now on the hook for them financially. It happens all the time. The Realtor doesn&rsquo;t have your best interest in mind. They simply wanted to close the deal to make the commission and move on. Meanwhile, you thought they were hustling so you didn&rsquo;t lose out on your dream home. So when you&rsquo;re trying to <a href="http://realestate.homula.com/find-best-realtor-toronto-2016/">find a Realtor in Toronto</a>, make sure you do your homework. Look beyond their website or postcard and ask for references. Be sure to ask the references about the entire process they went through, especially the offer and the close!</p>\r\n', '<p>Everyone says, &ldquo;You have to work with my Realtor. They&rsquo;re the best.&rdquo; But they can&rsquo;t all be the best... Can they?</p>\r\n', 7, 1, '2016-11-30 17:00:00', '2017-02-07 20:55:20'),
(3, 'Latest trends sweeping the real estate market in Toronto', 'latest-trends-sweeping-the-real-estate-market-in-toronto', '/uploads/articles_news/news-2.jpg', '', '<p>https://www.youtube.com/embed/h0-1jgPmB_0?feature=oembed</p>\r\n<iframe width="500" height="281" src="https://www.youtube.com/embed/h0-1jgPmB_0?feature=oembed" frameborder="0" allowfullscreen=""></iframe>\r\n\r\n<p>Recently, the Toronto Real Estate has witnessed some very disturbing drifts in terms of price fluctuations. The pricing trends in the housing market have constantly been on a rise with no end in sight of these prices falling in the near future. This Toronto Real Estate price trend is quite perturbing as it could be the target for taxing foreign investors.</p>\r\n\r\n<h2>Statistics</h2>\r\n\r\n<p>The statistics which prove that there are ample causes of worry with regards to the Toronto real estate market are: &bull; There were more than 10,000 homes, <a href="http://realestate.homula.com/ontario-real-estate-search/">which were resold in the Greater Toronto Area in July 2016</a>. &bull; The number of homes that changed hands in July 2016 was higher than any recorded number for July in any of the previous years. The sales in October 2016 were 11.5% higher than those of October 2015. &bull; The resale price average of homes increased by 16.6%. &bull; The price of detached homes increased by 21%. In fact, there has been a constant sales increase by 10% year on year for these detached home sales. &bull; The Home Price Index MLS Composite Benchmark increased by 19.7% year on year. &bull; There were new listings in October 2016 which showed a marginal increase over the previous year&rsquo;s October, however, this was not enough to balance the sales growth and the seller&#39;s market prevailed. &bull; The semi-detached, as well as townhouses, also saw annualized price gains which were in double digit numbers. &bull; The price of Condos increased greater than 9% as compared to the previous year during the same month. &bull; The new listings decreased by 7% in the last month. &bull; Implications of the increase in prices of Houses for sale Toronto <img alt="Toronto Real Estate" src="http://realestate.homula.com/wp-content/uploads/2016/11/Graph2-2.jpg" style="height:300px; width:600px" /> There are various implications with regards the increase in prices of resale homes. &bull; The first is that the Ontario government has imposed a 15% tax on residential properties which are purchased in the Vancouver area by the nonpermanent residents. This could affect the Toronto housing demands &amp; foreign buyers will choose to rather invest in the Greater Toronto Area instead of choosing the Vancouver area. &bull; <a href="http://realestate.homula.com/lawyers-firms/">According to Ontario government and legislations</a>, in order to decrease foreign speculation, a tax was implemented and this increased the prices of real- estate by 30% in the metro area of GTA. &bull; Due to the tax imposed, fierce bidding wars and increased price gains, there is more trouble on the horizon. The trend makes it hard for those who want to <a href="http://realestate.homula.com/realestate-agent/">Find a real estate agent Toronto</a> &nbsp;in order to purchase their homes. The reason is due to the decreasing supply of homes which are on the resale market. &bull; There is also a lot of unease when people are conducting a <a href="http://realestate.homula.com/ontario-real-estate-search">Real estate search</a>. &nbsp;In fact, even the Bank of Canada has warned that the growth is unsustainable. Housing policy is being looked at in different levels of the government. The Federal government too has started a working group in order to come up with the various recommendations in order to ensure that the housing in Toronto &amp; Vancouver is more affordable. &bull; Another reason why there is unease is that the sellers who are going to sell to those who are overseas or going to sell to investors have more angst as they are not sure if there will be a tax imposed on foreign buyers or on buyers who are not permanent residents of the area. &bull; In fact, there is a lot of uncertainty as the Mayor John Tory, as well as the Finance Minister, wants to see how the tax imposed Ontario,Toronto, GTA area has an effect. &bull; It is believed however that this trend is set to slow down in the near future and in fact, during the second half of the year it will cool down considerably due to the general belief that the rates of the mortgage will remain low as a result of the Brexit. &bull; The advice which perhaps is the most pertinent in the given circumstances with regard to the <a href="http://realestate.homula.com/ontario-real-estate-search/">MIS listing search</a>, &nbsp;is in case there is no pressing need to buy real estate, you should not do so and rather prefer to sit tight and not move, as there is a holding pattern which is currently found among homeowners. This advice is especially pertinent as there are policy makers at different levels who are brainstorming on different solutions as regard the lacking of low rise inventory which is all over the Greater Toronto Area. <img alt="mls listings toronto" src="http://realestate.homula.com/wp-content/uploads/2016/11/graph-2.jpg" style="height:300px; width:600px" /> &bull; Reasons for the high Toronto&rsquo;s Real estate market The reasons why Toronto&rsquo;s real estate market is so high are: &bull; The foreign and domestic investors are pushing up the local prices. In fact, in the Toronto area, the domestic investors contribute to 25% &amp; foreign investors contribute between 5% to 10% of the total home purchases. &bull; There are extra buyers in the market who are competing due to the amount of data which is available to them to help them in understanding the market. Due to the interest in investors, there are several people who are entering the buyers market &bull; There are people who even are ordinary homeowners who are buying houses just so as to capitalize on the market as they see the prices are increasing by 10%-20% &bull; The investor in the Toronto Real Estate market does not need to make a conditional offer on selling the home and normally bypasses inspections as he or she is only doing it for the sake of the profit. &bull; The investor&rsquo;s mortgage interest payments &amp; the renovation costs are tax deductible. These are deducted from the income they earn when they rent the house and therefore, they are more interested in to find a real estate agent Toronto, to help them in purchasing houses, especially with the price increase which they are seeing which give them a good return on their investments. &bull; Investors in the <a href="http://realestate.homula.com/">Toronto Real Estate</a> can bid higher than those who are purchasing the house to live in. The reason is that the buyers who want to live in the home usually do not go very high as they have to set aside money for the renovations.</p>\r\n', '<p>Recently, the Toronto Real Estate has witnessed some very disturbing drifts in terms of price fluctuations.</p>\r\n', 5, 1, '2016-11-30 17:00:00', '2017-02-07 21:25:09'),
(4, 'TORONTO REAL ESTATE UTILITIES', 'toronto-real-estate-utilities', '/uploads/articles_news/news-6.jpg', '', '<p><a href="http://realestate.homula.com/utility-companies/">Utilities</a> are services provided by the public that is paid for in form of a utility bill that is mailed to the owner or tenant. Utilities include water, electricity, sewerage and phone utilities. Some of these are taken care of by the authorities like the municipal councils. The bill for utilities is billed according to the usage of the amenities. When a tenant moves in to a residential property, an agreement is drawn and signed between the landlord and tenant to agree on who gets the utility bill for the utilities. This agreement is crucial so that there is no blame and lack of provision for these very important utilities. Each utility carries its charge, and no utility is charged like another since they are all different things. Depending on how much utility is used, billings are issued every month or in some cases, they are issued three times a year. There are many payment options that can be used to settle a utility bill in Toronto including the pre-authorized utility bill payment program. Other payment options include:</p>\r\n\r\n<ul>\r\n	<li>Internet banking</li>\r\n	<li>Mobile payments</li>\r\n	<li>Mail</li>\r\n	<li>Drop boxes for payments</li>\r\n</ul>\r\n\r\n<h1>1.&nbsp;&nbsp; The pre authorized utility bill payment program</h1>\r\n\r\n<p>This program applies to residents of Toronto who must first enroll to the city of Toronto&rsquo;s pre-authorized utility payment program that allows financial institutions that the owner has provided in PUP to withdraw utility payments every payment date. After the withdrawal and settlement of the utility bill, an electronic receipt is sent to the owner as proof of payment and the amount paid for what bill. This program cannot be transferred or used for another property beside the one it is registered for. This means that when a tenant moves out of t a house, the utilities are gone, and they need to cancel their pre-authorized utility bill payment program. The earlier signed agreement between the landlord and that tenant ceases to be binding until another tenant moves in and another agreement is signed. When one purchases a new property in Toronto after selling the previous property, the utility payments do not transfer to the new home, every property gets its own utility bills and utilities. The only requirement is that you ensure to change.</p>\r\n\r\n<h1>2.&nbsp;&nbsp; Types of utility bills in Toronto</h1>\r\n\r\n<h2>&nbsp;&nbsp;&nbsp;&nbsp; i.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Electricity or hydro bill</h2>\r\n\r\n<p>Even when electric appliances are switched off, they still consume power which accounts for the total electricity power and is featured in the bill. Most electric bills range between $ 30 and $ 50 per month. There are ways that one can reduce this charge by cutting down on their power usage when they do not need it and using more energy efficient bulbs in houses.</p>\r\n\r\n<h2>&nbsp;&nbsp; ii.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Water bill</h2>\r\n\r\n<p>Water is essential for survival and is therefore very important. Paying the water utility bill ensures that water supply is not cut off or reduced. A water meter is mostly installed to take water usage readings and calculate the expected bill. The average payment per month for water is $80.</p>\r\n\r\n<h2>iii.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Waste and sewerage bill</h2>\r\n\r\n<p>The removal and disposal of dirt from residential areas and into the appropriate dumping sites is a utility that attracts a monthly charge of up to $322.</p>\r\n\r\n<h2>&nbsp; iv.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Phone utility bill</h2>\r\n\r\n<p>Since the digital era has erupted, phone bills are not as popular as cell phones that are much more preferred for their portability, advancement, and ease of use. However, all homes with a home phone have to pay a monthly phone utility bill. When a payment is late, a fine is applied to the late fees and may also be accompanied by a discontinuation of the pre-authorized utility bill payment program. When a utility is discontinued for lack of pay, after completing the payment, an extra fee is charged for the reconnection of <a href="http://realestate.homula.com/utility-companies/">the utility</a>. &nbsp;</p>\r\n', '<p>When a tenant moves in to a residential property, an agreement is drawn and signed between the landlord and tenant</p>\r\n', 6, 1, '2016-11-30 17:00:00', '2017-02-07 03:31:50'),
(5, 'MLS LISTINGS TRADEMARK', 'mls-listings-trademark', '/uploads/articles_news/news-8.jpg', '', '<p>A trademark is the identifying factor of any single thing, the industry of franchise. The MLS listing trademark is a very important part of the system that ensures the exclusivity of the system and the rights that the MLS system holds on their name, services and building blocks. A trademark will identify the system and ensure that no other company can come up with the same name and exact services. This helps protect the system. The trademark is not just used as anyone pleases. Whether by members or non-members, the MLS trademark is to be respect and used in adherence to all the requirements that are stated for the use of this service and the trademark. The MLS trademark should be used as an adjective and not a noun as it is used to describe the standard of MLS services, not the listing system. The MLS trademark can be used in marketing merchandise like t-shirts and caps that are aimed at popularizing or spreading a particular message on behalf of the <a href="http://realestate.homula.com/mls-listing/">MLS listing</a> service. These are most popular in MLS listing events and any rallies held by or on behalf of the MLS. Registration of trademarks is not compulsory but is important in protecting ownership of the business. The kind of symbol that is used on a trademark has a different use. The MLS&reg; system means that the trademark has been successfully registered.</p>\r\n\r\n<h2>Requirements for the use of the MLS trademark</h2>\r\n\r\n<h2>Must be permitted to use the MLS trademark</h2>\r\n\r\n<p>This is covered under license and agreement which is an elaborate term of the MLS that states, only associations of realtors are freely allowed the use of the MLS trademark. Only with special permission that is written and signed can a non-member use the trademark. Members of associations of realtors are allowed use under the guidance of their respective association that ensures they uphold the requirements and rules attached to the use of the MLS trademark.</p>\r\n\r\n<h2>Must always be used in capital letters</h2>\r\n\r\n<p>The MLS trademark is in capital letters and must always be used in capital letters so that it is used correctly. If the trademark is used in small letters or one of the letters is in small letters, then that is not the MLS trademark and represents something entirely different. Anyone found in violation risks being stripped off their use of the trademark privileges.</p>\r\n\r\n<h2>Must always have the trademark sign</h2>\r\n\r\n<p>The trademark sign may not ring as important to most people but without this sign, it is not clear that it is a trademark or just and abbreviation of the multiple listings service. The MLS&reg; is important to denote the standard of the service. The symbol is the most important part in identifying a trademark from any other denotations.</p>\r\n\r\n<h2>The trademark should not be combined with anything else</h2>\r\n\r\n<p>It is required that no other words or symbols are combined with the trademark as it makes the trademark less commanding. This makes the standard that the trademark represents less effective and respectable. A trademark is sufficiently capable of representing itself and does not need to be introduced or overly decorated to be noticeable.</p>\r\n\r\n<h2>Do not use the trademark in domain names</h2>\r\n\r\n<p>The realtor associations and the Canadian Real Estate Association (CREA) that is responsible for managing the MLS trademark strictly prohibits all members or anyone using the trademark from using it in their domain names.</p>\r\n\r\n<h2>The MLS trademark should not be used in meta tags</h2>\r\n\r\n<p>People will want to associated and identified with the MLS and end up using the MLS trademark in their page descriptions or titles. This is not allowed as only the MLS service has rights to the trademark and no individual or entity should try to identify themselves with the MLS listing system.</p>\r\n\r\n<h2>Benefits of a trademark</h2>\r\n\r\n<h2>Defines a business</h2>\r\n\r\n<p>The trademark is what defines a business and its products. The trademark is used on all products and service documentations to explicitly show that source and the business responsible for the products.</p>\r\n\r\n<h2>Exclusive ownership rights</h2>\r\n\r\n<p>The trademark symbol may seem insignificant but it is a very powerful tool that gives exclusive ownership rights to the individual or entity that filed for the trademark. Once the trademark has been approved, there is no other person that can claim ownership. There is a system that is used to check for availability of the trademark selected. Once it is confirmed that no other companies have registered under that trademark it is issued. A trademark is unique to every business and no two companies can share a similar trademark even if in different parts of the world as this could cause confusion.</p>\r\n\r\n<h2>Protects the owner and the business</h2>\r\n\r\n<p>Competitors cannot use a similar mark as a trademark to try and dupe their way into stealing clients from the original holder of the trademark. If the holder of a trademark suspects this is the case that a competitor is using their trademark, they have the right to take legal action against the competitor where they will both be required to provide documents proving their ownership of the trademark. The trademark helps a business be able to sue for damages depending on the situation or on what the damage to the business name or trademark is. The protection that the business and the owner is given by registering a trademark is usually forever because trademarks have no expiration dates on them.</p>\r\n', '<p>A trademark is the identifying factor of any single thing, the industry of franchise.</p>\r\n', 4, 1, '2016-11-30 17:00:00', '2017-02-07 03:31:33'),
(8, '109 Holmes Ave, Toronto, M2N4M3, Ontario', '$ 2388000', '/uploads/hot_properties/hot_properties_item_1.jpg', 'http://realestate.homula.com/properties/109-holmes-ave-toronto-m2n4m3-ontario-4/', '', '<p>Toronto</p>\r\n', 0, 1, '2016-12-29 18:58:48', '2016-12-29 20:37:35'),
(9, '113 Laughton Ave, Toronto, M6N2X1, Ontario', '$ 729900', '/uploads/hot_properties/hot_properties_item_2.jpg', 'http://realestate.homula.com/properties/113-laughton-ave-toronto-m6n2x1-ontario-4/', '', '<p>Toronto</p>\r\n', 0, 1, '2016-12-29 19:03:58', '2016-12-29 20:37:44'),
(10, '170 Owen Blvd, Toronto, M2P1G7, Ontario', '$ 4280000', '/uploads/hot_properties/hot_properties_item_3.jpg', 'http://realestate.homula.com/properties/170-owen-blvd-toronto-m2p1g7-ontario-4/', '', '<p>Toronto</p>\r\n', 0, 1, '2016-12-29 19:05:44', '2016-12-29 20:37:49'),
(11, '38 Daniels St, Toronto, M8Y1M1, Ontario', '$ 1599900', '/uploads/hot_properties/hot_properties_item_4.jpg', 'http://realestate.homula.com/properties/38-daniels-st-toronto-m8y1m1-ontario-4/', '', '<p>Toronto</p>\r\n', 0, 1, '2016-12-29 19:06:52', '2016-12-29 20:37:54'),
(12, '8 Fernside Crt, Toronto, M2N6A1, Ontario', '$ 1880000', '/uploads/hot_properties/hot_properties_item_5.jpg', 'http://realestate.homula.com/properties/8-fernside-crt-toronto-m2n6a1-ontario-4/', '', '<p>Toronto</p>\r\n', 0, 1, '2016-12-29 19:17:52', '2016-12-29 20:37:59'),
(13, '5 Swansea Meadows Dr Brampton, ON, L7A 1M5', '', '/uploads/hot_properties/hot_properties_item_6.jpg', 'http://realestate.homula.com/properties/5-swansea-meadows-dr-brampton-on-l7a-1m5-2/', '', '', 0, 1, '2016-12-29 19:19:27', '2016-12-29 20:38:06'),
(14, '5 Swansea Meadows Dr Brampton, ON, L7A 1M5', '', '/uploads/hot_properties/hot_properties_item_7.jpg', 'http://realestate.homula.com/properties/5-swansea-meadows-dr-brampton-on-l7a-1m5-2/', '', '', 0, 1, '2016-12-29 19:20:55', '2016-12-29 20:38:11'),
(15, '32 Valleyside Trail Brampton, ON, L6P 2G4', '', '/uploads/hot_properties/hot_properties_item_1.jpg', 'http://realestate.homula.com/properties/32-valleyside-trail-brampton-on-l6p-2g4/', '', '', 0, 1, '2016-12-29 19:21:33', '2016-12-29 20:38:16'),
(16, 'Brampton', '', '/uploads/hot_properties/hot_properties_item_2.jpg', 'http://realestate.homula.com/properties/brampton-3/', '', '', 0, 1, '2016-12-29 19:22:08', '2016-12-29 20:38:21'),
(17, '5 Swansea Meadows Dr	Brampton, ON, L7A 1M5', '', '/uploads/hot_properties/hot_properties_item_3.jpg', 'http://realestate.homula.com/properties/5-swansea-meadows-dr-brampton-on-l7a-1m5/', '', '', 0, 1, '2016-12-29 19:22:42', '2016-12-29 20:38:27'),
(18, 'Dany Azar', 'English Arabic some french', '/uploads/top_agents/agentphoto-1.png', 'http://realestate.homula.com/agents/dany-azar/', '<p>danyazar@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:12:41', '2016-12-29 20:39:15'),
(19, 'Samir Arora', '', '/uploads/top_agents/agentphoto-2.png', 'http://realestate.homula.com/agents/samir-arora/', '<p>samirarora@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:13:24', '2016-12-29 20:39:21'),
(20, 'Sameer Amini', 'Farsi, Urdu, Dari, English', '/uploads/top_agents/agentphoto-3.png', 'http://realestate.homula.com/agents/sameer-amini/', '<p>sameeramini@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:14:11', '2016-12-29 20:39:26'),
(21, 'John Redmond', '', '', 'http://realestate.homula.com/agents/john-redmond/', '<p>johnredmond@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:14:40', '2016-12-29 20:14:44'),
(22, 'Bill Kaluski', 'English', '/uploads/top_agents/agentphoto-4.jpg', 'http://realestate.homula.com/agents/bill-kaluski/', '<p>billkaluski@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:15:19', '2016-12-29 20:39:38'),
(23, 'Sarah Zamanifar', '', '/uploads/top_agents/agentphoto-5.png', 'http://realestate.homula.com/agents/sarah-zamanifar/', '<p>sarahzamanifar@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:15:53', '2016-12-29 20:39:44'),
(24, 'Alaadin Zahran', '', '/uploads/top_agents/agentphoto-6.png', 'http://realestate.homula.com/agents/alaadin-zahran/', '<p>alaadinzahran@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:16:31', '2016-12-29 20:39:50'),
(25, 'Nedi Vozis-Penev', '', '/uploads/top_agents/agentphoto-7.png', 'http://realestate.homula.com/agents/nedi-vozis-penev/', '<p>vozispenev@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:17:33', '2016-12-29 20:39:55'),
(26, 'Paul Tobias', '', '/uploads/top_agents/agentphoto-8.png', 'http://realestate.homula.com/agents/paul-tobias/', '<p>paultobias@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:18:07', '2016-12-29 20:40:00'),
(27, 'Frank Talaei', '', '/uploads/top_agents/agentphoto-9.png', 'http://realestate.homula.com/agents/frank-talaei/', '<p>franktalaei@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:18:41', '2016-12-29 20:40:07'),
(28, 'Ying-Ho Tam', '', '/uploads/top_agents/agentphoto-10.png', 'http://realestate.homula.com/agents/ying-ho-tam/', '<p>yinghotam@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:19:15', '2016-12-29 20:40:13'),
(29, 'Simone Sue-A-Quan', '', '/uploads/top_agents/agentphoto-11.png', 'http://realestate.homula.com/agents/simone-sue-a-quan/', '<p>sueaquan@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:19:53', '2016-12-29 20:40:17'),
(30, 'Arun Sharma', '', '/uploads/top_agents/agentphoto-12.png', 'http://realestate.homula.com/agents/arun-sharma/', '<p>arunsharma@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:21:03', '2016-12-29 20:40:25'),
(31, 'Naz Sala', 'English, Farsi', '', 'http://realestate.homula.com/agents/naz-sala/', '<p>nazsala@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:21:41', '2016-12-29 20:21:41'),
(32, 'Fara Sadeghi', '', '/uploads/top_agents/agentphoto-13.png', 'http://realestate.homula.com/agents/fara-sadeghi/', '<p>farasadeghi@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:22:12', '2016-12-29 20:40:34'),
(33, 'Farah Ravji', '', '/uploads/top_agents/agentphoto-14.png', 'http://realestate.homula.com/agents/farah-ravji/', '<p>farahravji@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:22:49', '2016-12-29 20:41:13'),
(34, 'Rajiv Rajak', '', '/uploads/top_agents/agentphoto-15.png', 'http://realestate.homula.com/agents/rajiv-rajak/', '<p>rajivrajak@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:23:25', '2016-12-29 20:41:20'),
(35, 'Brian Pcolinsky', '', '/uploads/top_agents/agentphoto-16.png', 'http://realestate.homula.com/agents/brian-pcolinsky/', '<p>brianpcolinsky@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:23:59', '2016-12-29 20:41:24'),
(36, 'Anda Panait-Rodgers', '', '/uploads/top_agents/agentphoto-17.png', 'http://realestate.homula.com/agents/anda-panait-rodgers/', '<p>andapanaitrodgers@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:24:38', '2016-12-29 20:41:29'),
(37, 'Allen Naseri', '', '/uploads/top_agents/agentphoto-18.png', 'http://realestate.homula.com/agents/allen-naseri/', '<p>allennaseri@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:25:10', '2016-12-29 20:41:33'),
(38, 'Joe Montimurro', '', '/uploads/top_agents/agentphoto-19.png', 'http://realestate.homula.com/agents/joe-montimurro/', '<p>joemontimurro@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:25:43', '2016-12-29 20:41:38'),
(39, 'Mihan Manteghi', '', '/uploads/top_agents/agentphoto-20.png', 'http://realestate.homula.com/agents/mihan-manteghi/', '<p>mihanmanteghi@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:26:13', '2016-12-29 20:41:43'),
(40, 'Silvia Moreno-IP', 'English, Spanish, French', '/uploads/top_agents/agentphoto-21.png', 'http://realestate.homula.com/agents/silvia-moreno-ip/', '<p>silviamoreno@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:26:47', '2016-12-29 20:41:48'),
(41, 'Jahleeki Lowe', '', '/uploads/top_agents/agentphoto-22.png', 'http://realestate.homula.com/agents/jahleeki-lowe/', '<p>jahleekilowe@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:27:59', '2016-12-29 20:41:52'),
(42, 'Mimi Long', '', '/uploads/top_agents/agentphoto-23.png', 'http://realestate.homula.com/agents/mimi-long/', '<p>mimilong@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:28:29', '2016-12-29 20:41:57'),
(43, 'Behnam Ghasemian', '', '/uploads/top_agents/agentphoto-24.png', 'http://realestate.homula.com/agents/behnam-ghasemian/', '<p>behnamghasemian@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:29:01', '2016-12-29 20:42:13'),
(44, 'Melissa Gholamhassani', 'English, Persian, Turkish', '/uploads/top_agents/agentphoto-25.png', 'http://realestate.homula.com/agents/melissa-gholamhassani/', '<p>melissagholamhassani@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:29:39', '2016-12-29 20:42:18'),
(45, 'Eliza Hilario', '', '/uploads/top_agents/agentphoto-26.png', 'http://realestate.homula.com/agents/eliza-hilario/', '<p>elizahilario@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:30:05', '2016-12-29 20:42:22'),
(46, 'Serge Jovicic', '', '/uploads/top_agents/agentphoto-27.png', 'http://realestate.homula.com/agents/serge-jovicic/', '<p>sergejovicic@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:30:47', '2016-12-29 20:42:26'),
(47, 'John Jay Kim', '', '/uploads/top_agents/agentphoto-28.png', 'http://realestate.homula.com/agents/john-jay-kim/', '<p>johnjaykim@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:31:25', '2016-12-29 20:42:31'),
(48, 'Mahi Gholami', '', '/uploads/top_agents/agentphoto-29.png', 'http://realestate.homula.com/agents/mahi-gholami/', '<p>mahigholami@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:32:00', '2016-12-29 20:42:36'),
(49, 'Matthew Dumouchel', '', '/uploads/top_agents/agentphoto-30.png', 'http://realestate.homula.com/agents/matthew-dumouchel/', '<p>matthewdumouchel@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:33:13', '2016-12-29 20:42:40'),
(50, 'Janina Crone', '', '/uploads/top_agents/agentphoto-31.png', 'http://realestate.homula.com/agents/janina-crone/', '<p>janinacrone@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:33:43', '2016-12-29 20:42:44'),
(51, 'Julia Crane', '', '/uploads/top_agents/agentphoto-32.png', 'http://realestate.homula.com/agents/julia-crane/', '<p>juliacrane@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:34:13', '2016-12-29 20:42:49'),
(52, 'Willie L. Christian', '', '/uploads/top_agents/agentphoto-33.png', 'http://realestate.homula.com/agents/willie-l-christian/', '<p>willielchristian@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:34:44', '2016-12-29 20:42:55'),
(53, 'Harry Cardoso', '', '/uploads/top_agents/agentphoto-34.png', 'http://realestate.homula.com/agents/harry-cardoso/', '<p>harrycardoso@realestate.homula.com</p>\r\n', '', 0, 1, '2016-12-29 20:35:21', '2016-12-29 20:43:12'),
(54, '10 Effective Tips for Finding the Right Realtor in Toronto', '', '/uploads/real_estate_new/new-1.jpg', 'http://realestate.homula.com/10-effective-tips-finding-right-realtor-toronto/', '', '', 0, 1, '2016-12-29 21:18:10', '2016-12-29 21:18:13'),
(55, 'TORONTO REAL ESTATE UTILITIES', '', '/uploads/real_estate_new/new-2.jpg', 'http://realestate.homula.com/toronto-real-estate-utilities/', '', '', 0, 1, '2016-12-29 21:18:41', '2016-12-29 21:18:45'),
(56, 'TORONTO REAL ESTATE STUDIES', '', '/uploads/real_estate_new/new-3.jpg', 'http://realestate.homula.com/toronto-real-estate-studies/', '', '', 0, 1, '2016-12-29 21:19:12', '2016-12-29 21:19:15'),
(57, 'TORONTO REAL ESTATE SOCIAL', '', '/uploads/real_estate_new/new-4.jpg', 'http://realestate.homula.com/toronto-real-estate-social/', '', '', 0, 1, '2016-12-29 21:19:39', '2016-12-29 21:19:43'),
(58, 'Five things to expect from Canadian real estate in 2017', '', '/uploads/real_estate_new/new-5.jpg', 'http://realestate.homula.com/five-things-expect-canadian-real-estate-2017/', '', '', 0, 1, '2016-12-29 21:20:14', '2016-12-29 21:20:17'),
(59, '4 Illegal Tactics You Need to Beware of in Toronto Real Estate', '', '/uploads/real_estate_new/new-5.jpg', 'http://realestate.homula.com/4-illegal-tactics-need-beware-toronto-real-estate/', '', '', 0, 1, '2016-12-29 21:20:45', '2016-12-29 21:20:48'),
(60, 'The 5 Biggest Risks You Will Face in the Toronto Real Estate Market in 2016', '', '/uploads/real_estate_new/new-6.jpg', 'http://realestate.homula.com/5-biggest-risks-will-face-toronto-real-estate-market-2016/', '', '', 0, 1, '2016-12-29 21:21:10', '2016-12-29 21:21:14'),
(61, 'What if You Find a Realtor in Toronto and They’re Terrible?', '', '/uploads/real_estate_new/new-7.jpg', 'http://realestate.homula.com/find-realtor-toronto-theyre-terrible/', '', '', 0, 1, '2016-12-29 21:21:39', '2016-12-29 21:21:47'),
(62, 'Top 10 key factors you must know about the Toronto real estate Market', '', '/uploads/real_estate_new/new-2.jpg', 'http://realestate.homula.com/top-10-key-factors-must-know-toronto-real-estate-market/', '', '', 0, 1, '2016-12-29 21:22:38', '2016-12-29 21:22:42'),
(63, 'Latest trends sweeping the real estate market in Toronto', '', '/uploads/real_estate_new/new-8.png', 'http://realestate.homula.com/latest-trends-sweeping-real-estate-market-toronto/', '', '', 0, 1, '2016-12-29 21:23:06', '2016-12-29 21:23:09'),
(64, '10 Effective Tips for Finding the Right Realtor in Toronto', '', '/uploads/real_estate_new/new-1.jpg', 'http://realestate.homula.com/10-effective-tips-finding-right-realtor-toronto/', '', '', 0, 1, '2016-12-29 21:23:32', '2016-12-29 21:23:35'),
(65, 'TORONTO REAL ESTATE UTILITIES', '', '/uploads/real_estate_new/new-2.jpg', 'http://realestate.homula.com/toronto-real-estate-utilities/', '', '', 0, 1, '2016-12-29 21:23:58', '2016-12-29 21:24:12'),
(66, 'TORONTO REAL ESTATE STUDIES', '', '/uploads/real_estate_new/new-3.jpg', 'http://realestate.homula.com/toronto-real-estate-studies/', '', '', 0, 1, '2016-12-29 21:24:32', '2016-12-29 21:24:35'),
(67, 'TORONTO REAL ESTATE SOCIAL', '', '/uploads/real_estate_new/new-4.jpg', 'http://realestate.homula.com/toronto-real-estate-social/', '', '', 0, 1, '2016-12-29 21:24:57', '2016-12-29 21:25:00'),
(68, 'Five things to expect from Canadian real estate in 2017', '', '/uploads/real_estate_new/new-5.jpg', 'http://realestate.homula.com/five-things-expect-canadian-real-estate-2017/', '', '', 0, 1, '2016-12-29 21:25:26', '2016-12-29 21:25:32'),
(69, '4 Illegal Tactics You Need to Beware of in Toronto Real Estate', '', '/uploads/real_estate_new/new-5.jpg', 'http://realestate.homula.com/4-illegal-tactics-need-beware-toronto-real-estate/', '', '', 0, 1, '2016-12-29 21:25:58', '2016-12-29 21:26:01'),
(70, 'The 5 Biggest Risks You Will Face in the Toronto Real Estate Market in 2016', '', '/uploads/real_estate_new/new-6.jpg', 'http://realestate.homula.com/5-biggest-risks-will-face-toronto-real-estate-market-2016/', '', '', 0, 1, '2016-12-29 21:26:26', '2016-12-29 21:26:28'),
(71, 'What if You Find a Realtor in Toronto and They’re Terrible?', '', '/uploads/real_estate_new/new-7.jpg', 'http://realestate.homula.com/find-realtor-toronto-theyre-terrible/', '', '', 0, 1, '2016-12-29 21:27:00', '2016-12-29 21:27:03'),
(72, 'What does Toronto real estate have in store for the year 2017', 'what-does-toronto-real-estate-have-in-store-for-the-year-2017', '/uploads/articles_news/news-1.jpg', '', '<h1>Toronto!!! Yes, the city feels great in this New Year.</h1>\r\nReasons can be varied, but one thing is for sure; the real estate market of the city is all time high and getting larger with every passing year. Designated as the most populous city of Canada, house for sale Toronto is making all news these days. Predictions after predictions, real estate gurus have been eagerly waiting for the latest development in the market prices. Realtors, Buyers, and sellers all have geared up the in anticipation of better future in this New Year, especially in the Greater Toronto Area. House for sale or rent in Toronto is majorly driving real estate prices to double-digit at the start of 2017.\r\n<h2>A small pond with too many fishes.</h2>\r\nLack of house on sale in Toronto is the major rider driving the soaring real estate prices in the city. The end of the year 2016 marked the lowest number of listings as indicated by Jason Mercer, TREB’s director of Market analysis. This was the lowest in the past 16 years.\r\n\r\n<img class="alignnone size-full wp-image-13378" src="http://realestate.homula.com/wp-content/uploads/2017/02/graph1-2.jpg" alt="graph1-2" width="1600" height="1200" />\r\n\r\nMoving forward in this regards, assumptions of a shortage of listings is expected, hence a rise in prices again. The TREB further predicted the soar in average housing prices from the last year could be as high as $95,078 with impact mainly on the low-rise type housing. The double-digit rise in the property prices could fall anywhere in between 10-16 percent.\r\nThe board has called for all sorts of firms to fuel the supply of property in Toronto.\r\n<h2>Involvement of foreign flock of investors seems Jittery!!!</h2>\r\nFolks, whether sooner or later, there is some buzz of the introduction of Foreign Buyers tax for the GTA region.\r\nLet’s Flashback to Last August at Vancouver; introduction of Foreign Buyers tax. Well, the city did witness a fall in sale of houses to a rather concrete level, to be very precise 30-40 percent decline in monthly sales. So, it is imaginable that such buzz in GTA would send wrong signals to foreign buyers who constituted 4.9% of last year’s sale, thereby affecting the real estate market in a not so favorable way.\r\n\r\nThe Building Industry land Development Association’s take is no different from that TREB says and it backs the latter’s view owing to the lack of inventory.\r\n<h2>The Past is the foundation of the future</h2>\r\nLet us have a look at property prices report of TREB for December 2016 which will trace the road map for 2017\r\nAverage property price for\r\na. Detached houses &gt;&gt;&gt; $ 1,286,605\r\nb. Semi-Detached. &gt;&gt;&gt;&gt;&gt; $808,920\r\nc. Row/Town &gt;&gt;&gt;&gt;&gt; $927,471\r\nd. Condo Town &gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt; $569,864\r\ne. Condo APT &gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt; $466,592\r\n\r\n<img class="alignnone size-full wp-image-13379" src="http://realestate.homula.com/wp-content/uploads/2017/02/graph12.png" alt="graph12" width="966" height="561" />\r\nAny aspiring purchasers/investors in real estate can predict what’s in store using the suggested rate of increase i.e. 10-16%\r\nThe Toronto and GTA market is all red hot in this New Year. The TREB is concerned with the fewer options available. For keeping right track and analysis of the real estate market it hired the survey firm, Ipsos. The poll made it clear that foreign investors took a 5% share of the market and 2% of them were driven by a tax levied on Vancouver.\r\n\r\nThe lack of space in the city has to be dealt, for this association and leaders from Ontario are laying down suggestions, the latest being by Mr. Hudak who called for a reassessment of the Greenbelt Expansion plan by the government on the outskirts of GTA. The proposed expansion did impose an unsaid restriction on the Builders who could help increase the housing inventory.\r\nOverall, amongst the hazy situation on laws and policies, rate shoot is guaranteed. The drive to buy or rent property in Toronto is high and sellers are definitely going to profit the way road map of the housing industry is being carved.\r\nLest double-digit rates increase lead to the dreaded bubble burst. The lawmakers must be cautious with every step they take, just a thought!', '<p>Reasons can be varied, but one thing is for sure; the real estate market of the city is all time high and getting larger with every passing year.</p>\r\n', 5, 1, '2017-02-07 03:13:41', '2017-02-07 03:13:41'),
(73, 'Foreign Investors Want You To Know More About The Toronto Real Estate Market', 'foreign-investors-want-you-to-know-more-about-the-toronto-real-estate-market', '/uploads/articles_news/news-3.jpg', '', '<p>The most hotly debated topic on the <a href="http://realestate.homula.com/realestate-search/" target="_blank">Toronto real estate</a> scene is the true impact that foreign investors have on the market. Are they really driving prices up? They don&rsquo;t think so, and they don&rsquo;t want you to think so either. It&rsquo;s easy to feel that way, in such a competitive market. You work hard to <a href="http://realestate.homula.com/agents/" target="_blank">find a Realtor in Toronto</a>, you make your bid, and you lose out to the foreign investor. It can be frustrating. The whole process can really leave you feeling sour, and lead you to think that they&rsquo;re eating into the Toronto&rsquo;s supply of homes for sale, and perhaps even bringing up the prices. <img alt="Toronto Real Estate" src="http://realestate.homula.com/wp-content/uploads/2017/01/graph10.png" style="height:561px; width:966px" /> But let&rsquo;s take a closer look at foreign investors&rsquo; real impact on the Toronto real estate market.</p>\r\n\r\n<h2>Foreign Investors and Toronto Real Estate: Fact vs. Fiction</h2>\r\n\r\n<p>There is a popular idea these days that foreign investors are swooping in and taking all the good properties. However, a recent <a href="http://dailycommercialnews.com/Economic/News/2016/11/Local-investors-outnumber-foreign-buyers-in-Toronto-condo-market-1019518W/" target="_blank">study from Urbanisation</a> recently reported that foreign buyers, (With their primary residence being outside Canada) made up only five percent of the sales of new units in condo buildings.</p>\r\n\r\n<h2>They also found that:</h2>\r\n\r\n<p>Canadian investors who don&#39;t plan on living in the unit made up 52 percent of the sales The remaining 43 percent of new condos sold in the Toronto area went to locals who plan to live in the properties At the same time, Canada Mortgage and Housing Corp reported that only 3.3 per cent of Toronto condos are owned by foreigners. The CBC also recently reported that: <img alt="find a Realtor in Toronto" src="http://realestate.homula.com/wp-content/uploads/2017/01/graph3.png" style="height:561px; width:966px" /> According, the recent survey of Toronto-area real estate agents, domestic investors now make up 25 percent of their client base Overall, in Toronto home prices jumped 21 percent from a year ago and now average $762,975.</p>\r\n\r\n<h2>The Recent Rule Changes and Foreign Investors</h2>\r\n\r\n<p>Foreign investors were recently dealt <a href="http://business.financialpost.com/personal-finance/mortgages-real-estate/federal-government-closing-tax-loophole-used-by-foreign-home-buyers">a rule change</a> that makes it harder for them to invest in Canada, from afar. In October, it was announced that foreign investors could no longer utilize a tax loophole that helped some to avoid paying capital gains taxes as their homes appreciated in value. Now, however, buyers who were not residents at the time a home was bought will no longer be able to claim a principal residence exemption. Finance Minister Bill Morneau announced the changes without calling out foreign investors by name and said all of the new rules (which included implementing mortgage stress tests for all insured borrowers as well ) are in the name of making sure Canada&rsquo;s housing market remains stable and affordable for Canadian buyers.</p>\r\n\r\n<h2>Not All Foreign Investors are Looking to &ldquo;Flip&rdquo; a House</h2>\r\n\r\n<p>A lot of foreign investors want to fight the belief that they&rsquo;re just sitting back from afar, and are going to just turn around and sell the property for a profit. Peter Walsh and his wife own three houses and two condos, and rent them to people they claim may not be able to get quality housing from most landlords or property owners. &quot;What I feel we&#39;ve done is perhaps help people,&quot; Walsh <a href="http://www.cbc.ca/news/business/toronto-real-estate-investment-market-prices-1.3834959">told the CBC</a>. &quot;I can justify it to myself in saying I don&#39;t think I&#39;m hosting anybody or demanding excessive rents.&quot; He even accepted a painting from one of his tenants who makes their living as an artist, as a way of helping with the rent. So if you&rsquo;re trying to find a Realtor in Toronto, be sure to ask them if they have a strategy when bidding against investors (be it foreign or domestic). You should also make sure they have a history of winning bids.</p>\r\n', '<p>Are they really driving prices up? They don&rsquo;t think so, and they don&rsquo;t want you to think so either.</p>\r\n', 7, 1, '2017-02-07 03:20:42', '2017-02-07 03:20:42');
INSERT INTO `articles` (`id`, `title`, `alias`, `thumbnail`, `link`, `content`, `excerpt`, `categories_id`, `published`, `created_at`, `updated_at`) VALUES
(74, 'TORONTO REAL ESTATE STUDIES', 'toronto-real-estate-studies', '/uploads/articles_news/news-7.jpg', '', '<p>In the recent past, more universities across Canada have opened up their doors to students who wish to study all matters real estate. Toronto real estate studies are available to interested students right from college to undergraduate and postgraduate levels. Growth in the real estate sector in Toronto has arguably led to this increase. Students can study various courses that touch on the real estate industry such as <a href="http://realestate.homula.com/real-estate-lawyer/">real estate property law</a>, <a href="http://realestate.homula.com/property-management/">property management</a>, and investment analysis. The following is a list of the schools in Toronto that offer studies in real estate</p>\r\n\r\n<h1>Ontario Real Estate College</h1>\r\n\r\n<p>This school is located in Ontario and is an arm of the Ontario Real Estate Association (OREA). The school has a unique program designed for those people interested in becoming real estate salespeople. The Salesperson Registration Education Program offered by the institution equips the learner with adequate knowledge about all matters real estate. The course is divided into two parts, pre-registration and articling. In the pre-registration, students are introduced to topics that touch on real estate transactions, real estate trading and real property law. It takes 18 months to complete this segment. In the articling part, students can choose from one of the several elective courses that are completed within 24 months. This course is the prerequisite to getting licensed. Nevertheless, the knowledge acquired is essential for any<a href="http://realestate.homula.com/agents"> realtor</a>.</p>\r\n\r\n<h1>University Of Toronto</h1>\r\n\r\n<p>The Rotman School of Management at the University of Toronto offers a real estate major option in the MBA programs that they have. The Major in Real Estate is a unique option for people who already have some foundation in the real estate sector. Professionals who have graduated in such disciplines as economics, entrepreneurship, law, building construction or even investment banking could find the program quite useful. The core courses within the program are real estate development, economics and development. After successfully completing this program, one can have first-hand knowledge of matters to do with real estate law, estate finance, and property development within the residential and commercial property segments.</p>\r\n\r\n<h1>Ryerson University Toronto</h1>\r\n\r\n<p>Ryerson University offers a major in Real Estate Management at the Ted Rogers School of Business Management. The program imparts skills to business students to work in the commercial and residential property segment. After graduating with this major, one can work in various positions across the real estate industry in Toronto and Canada as a whole.</p>\r\n\r\n<h1>Real Estate Institute of Canada (REIC)</h1>\r\n\r\n<p>Located in Toronto, REIC offers continuous quality professional education to players in the real estate industry. REIC provides certifications and advanced learning courses that cover the length and breadth of the real estate sector. With REIC certifications, students have the chance to become specialists in their fields. Some of the certifications offered by the institute include Certified Property Manager (CPM), Accredited Residential Manager (ARM) and Certified in Real Estate Finance (CRF).</p>\r\n\r\n<h1>Seneca College</h1>\r\n\r\n<p>This school offers the Ontario Continuing Course for <a href="http://realestate.homula.com/mortgage-broker/">Mortgage Brokers</a> and <a href="http://realestate.homula.com/agents/">Agents</a>. This is a unique program designed for mortgage agents and brokers. It equips the learner with requisite skills to work in the mortgage segment of the real estate industry. It is also mandatory for all mortgage agents and<a href="http://realestate.homula.com/mortgage-broker/"> brokers </a>to undertake this course if they wish to renew their licenses.</p>\r\n\r\n<h1>York University</h1>\r\n\r\n<p>York University offers certificate and masters courses in real estate. The professional certificate course is offered by the Liberal Arts and Professional Studies department of the University. If you wish to get acquainted with all details in real estate management as part of your degree course, you can opt for this professional certificate. The Master of Real Estate and Infrastructure (MREI) is a graduate program that enables the learner to take courses in infrastructure and real estate. The student can get practical skills on real estate financing, development as well as the development of leadership in the industry. <a href="http://realestate.homula.com/resale-homes/">Toronto real estate </a>studies are therefore readily available for anyone wishing to join this lucrative industry.</p>\r\n', '<p>In the recent past, more universities across Canada have opened up their doors to students who wish to study all matters real estate.</p>\r\n', 6, 1, '2017-02-07 03:28:38', '2017-02-07 03:32:02'),
(75, 'MLS Listing Updates October 2016', 'mls-listing-updates-october-2016', '/uploads/articles_news/news-8.jpg', '', '<p>An MLS listing is real estate featured with a Multiple Listing Service (MLS). Anyone looking to find a real estate agent should always be sure the agent or firm is a member of the local listing service. Otherwise, the benefits of this alliance will not be realized for the seller or potential buyers of the property. The frequency of MLS listing updates depends upon the service in a particular area.</p>\r\n\r\n<h2>Benefits of an MLS Listing</h2>\r\n\r\n<p>The <a href="http://realestate.homula.com/">Toronto real estate </a>market is booming, making it potentially even more challenging for property owners to be found by the right buyers in a <a href="http://realestate.homula.com/realestate-search/">real estate search</a>. The following are more details regarding the benefits of an <a href="http://realestate.homula.com/history-mls-listings-toronto/">MLS listing</a>: &bull; MLSs create healthy competition. Small real estate brokers compete directly with the largest firms in an equal-opportunity environment. &bull; As long as buyers and sellers choose a real estate firm that has a membership in a MLS, they can have peace of mind in knowing their interests are not limited to a small pool of options. &bull; Sellers get the benefit of increased exposure of their property. Buyers get the benefit of working with one agent while having access to information about all MLS-listed properties. &bull; <a href="http://realestate.homula.com/agents">Real estate professionals</a> create, maintain, and pay for the private databases for MLSs. Access to the expanded range of listings shared by agents is a service that greatly benefits buyers and sellers, and it is often free of charge. &bull; All information in a MLS database is not accessible by the public. Neither the safety nor the privacy of sellers is compromised. For instance, information regarding the vacancy of a home for purposes of showing it is never advertised or made available to those who are conducting an MLS listing search. &bull; Sellers and buyers can readily and conveniently access information about available real estate listings on the website of their agent of choice.</p>\r\n\r\n<h2>How an MLS Listing Search Works</h2>\r\n\r\n<p>Real estate brokers know how to put an MLS to work for their clients, whether buyers or sellers. The following are some of the steps involved with making a MLS work: &bull; For sellers, the important thing is to ensure that the agent places their property on the market within the MLS, so that other brokers have access to the information. &bull; The real estate professional searches the database for property that fits the needs and price range of the client. &bull; Special attention is paid to new MLS listings, placed on the market recently. This is why property gets more attention when first listed. Agents will typically preview the property before showing it to clients because t<a href="http://realestate.homula.com/about-us/">hey want to be sure it&rsquo;s a good fit for buyers</a>. &bull; In short, a home or property is listed in the local MLS; brokers preview the home; and the property is advertised, which gives visibility for the benefit of homebuyers and their agents.</p>\r\n\r\n<h2>When are MLS Listings Updated?</h2>\r\n\r\n<p>The frequency in which new real estate listings and other changes are updated in a MLS is dependent upon the service and the area in particular. The following provides a glimpse of how often various MLSs update their listings: &bull; Larger MLSs update data almost instantly, and the updates are published to the Real Estate Transaction Standards (RETS) feed within a few minutes. &bull; With some MLSs, updates are only published on weekdays but not weekends. &bull; Many MLSs opt to update MLS listings a certain number of times per day, such as once hourly. &bull; Virtually every MLS updates at least once daily, with the exception of those that don&rsquo;t update on weekends.</p>\r\n', '<p>An MLS listing is real estate featured with a Multiple Listing Service (MLS). Anyone looking to find a real estate agent should always be sure the agent or firm is a member of the local listing service.</p>\r\n', 4, 1, '2017-02-07 03:33:58', '2017-02-07 03:33:58');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `alias` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `parent_id` int(10) NOT NULL,
  `published` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `alias`, `description`, `parent_id`, `published`) VALUES
(1, 'Help Centre', 'help-centre', '', 0, 1),
(2, 'News', 'news', '', 0, 1),
(3, 'Real Estate Important Questions', 'real-estate-important-questions', '', 1, 1),
(4, 'Mls Listing', 'mls-listing', '', 2, 1),
(5, 'Realestate Market', 'realestate-market', '', 2, 1),
(6, 'Toronto Realestate', 'toronto-realestate', '', 2, 1),
(7, 'Weekly-blog', 'weekly-blog', '', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `icon` varchar(500) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `link` varchar(500) NOT NULL,
  `target` varchar(50) NOT NULL,
  `published` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `alias`, `icon`, `parent_id`, `link`, `target`, `published`) VALUES
(1, 'HOME', 'home', '', 0, '', '_blank', 1),
(2, 'BUY', 'buy', '', 0, '', '', 1),
(3, 'SELL', 'sell', '', 0, '', '', 1),
(4, 'LEASE', 'lease', '', 0, '', '', 1),
(5, 'COMMERCIAL', 'commercial', '', 0, '', '', 1),
(6, 'PROFESSIONAL FINDER', 'professional-finder', '', 0, '', '', 1),
(7, 'MORTGAGE', 'mortgage', '', 0, '', '', 1),
(8, 'CALCULATORS', 'calculators', '', 0, '', '', 1),
(9, 'ADVICE', 'advice', '', 0, '', '', 1),
(10, 'ABOUT US', 'about-us', '', 0, '', '', 1),
(11, 'NEWS', 'news', '', 0, '', '', 1),
(12, 'RESALES HOME', 'resales-home', '/images/resales-home.png', 2, '', '', 1),
(13, 'NEW CONSTRUCTION HOME', 'new-construction-home', '/images/new-construction-home.png', 2, '', '', 1),
(14, 'NEW CONSTRUCTION CONDO', 'new-construction-condo', '/images/new-construction-condo.png', 2, '', '', 1),
(15, 'EXCLUSIVE HOMES', 'exclusive-homes', '/images/exclusive-home.png', 2, '', '', 1),
(16, 'OPEN HOUSE', 'open-house', '/images/open-house.png', 2, '', '', 1),
(17, 'COMING SOON', 'coming-soon', '/images/coming-soon.png', 2, '', '', 1),
(18, 'BUSINESS', 'business', '/images/business-homula.png', 2, '', '', 1),
(19, 'FREE HOME EVALUATION', 'free-home-evaluation', '/images/free-home-evluation-homula.png', 3, '', '', 1),
(20, 'FREE HOME REPORT', 'free-home-report', '/images/free-home-report-homula.png', 3, '', '', 1),
(21, 'FIND A REALTOR', 'find-a-realtor', '/images/find-retailer-copy.png', 3, '', '', 1),
(22, 'LIST MY HOUSE', 'list-my-house', '/images/list-my-home-homula.png', 3, '', '', 1),
(23, 'LEASE SEARCH', 'lease-search', '/images/search-copy.png', 4, '', '', 1),
(24, 'MAP SEARCH', 'map-search', '/images/search-copy.png', 4, '', '', 1),
(25, 'COMMERCIAL SEARCH', 'commercial-search', '/images/search-copy.png', 4, '', '', 1),
(26, 'BUSINESS', 'business', '/images/business-copy.png', 4, '', '', 1),
(27, 'UTILITY', 'utility', '/images/utility-copy.png', 4, '', '', 1),
(28, 'SEARCH', 'search', '/images/search-copy.png', 4, '', '', 1),
(29, 'SEARCH', 'search', '/images/search-2.png', 5, '', '', 1),
(30, 'ADVANCED SEARCH', 'advanced-search', '/images/ad-search2.png', 5, '', '', 1),
(31, 'LIST YOUR PROPERTY', 'list-your-property', '/images/home-listing2.png', 5, '', '', 1),
(32, 'FIND A COMMERCIAL REALTOR', 'find-a-commercial-realtor', '/images/find-retaile2.png', 5, '', '', 1),
(33, 'REAL ESTATE PROFESSIONAL', 'real-estate-professional', '/images/real-estate-professiona-homula.png', 6, '', '', 1),
(34, 'LEASING AGENT', 'leasing-agent', '/images/leasing-agent1-homula.png', 6, '', '', 1),
(35, 'MORTGAGE BROKER', 'mortgage-broker', '/images/Mortage-broker-copy.png', 6, '', '', 1),
(36, 'HOME INSPECTOR', 'home-inspector', '/images/homeinspector-homula.png', 6, '', '', 1),
(37, 'REAL ESTATE LAWYER', 'real-estate-lawyer', '/images/lawyer-homula.png', 6, '', '', 1),
(38, 'APPRAISER', 'appraiser', '/images/appraiser-homula.png', 6, '', '', 1),
(39, 'PROPERTY MANAGEMENT', 'property-management', '/images/property-management-homula.png', 6, '', '', 1),
(40, 'HOME STAGERS', 'home-stagers', '/images/home-stagers-homula.png', 6, '', '', 1),
(41, 'INSURANCE BROKERS', 'insurance-brokers', '/images/insurance-broker-homula.png', 6, '', '', 1),
(42, 'MOVING COMPANY', 'moving-company', '/images/moving-company-homula.png', 6, '', '', 1),
(43, 'GRAPHIC DESIGNER', 'graphic-designer', '/images/photographers-reps-homula.png', 6, '', '', 1),
(44, 'LAWYERS(FIRMS)', 'lawyers-firms', '/images/sign-supplir-copy.png', 6, '', '', 1),
(45, 'SIGN INSTALLERS', 'sign-installers', '/images/shape-homula.png', 6, '', '', 1),
(46, 'PRINTERS', 'printers', '/images/printer-homula.png', 6, '', '', 1),
(47, 'PHOTOGRAPHERS (PROPERTIES)', 'photographers-properties', '/images/photographer-homula.png', 6, '', '', 1),
(48, 'PHOTOGRAPHERS (REPS)', 'photographers-reps', '/images/photographers-reps-homula.png', 6, '', '', 1),
(49, 'MORTGAGE BROKER', 'mortgage-broker', '/images/Mortage-broker-copy.png', 7, '', '', 1),
(50, 'MORTGAGE INSURANCE CALCULATOR', 'mortgage-insurance-calculator', '/images/mortgage-insurance-calculator-copy.png', 7, '', '', 1),
(51, 'MORTGAGE RATGES', 'mortgage-ratges', '/images/mortage-rates-copy.png', 7, '', '', 1),
(52, 'NEW MORTGAGE CALCULATOR', 'new-mortgage-calculator', '/images/mortage-calculater-copy.png', 7, '', '', 1),
(53, 'MORTGAGE CALCULATOR', 'mortgage-calculator', '/images/mortage-calculater-copy.png', 8, '', '', 1),
(54, 'MORTGAGE INSURANCE CALCULATOR', 'mortgage-insurance-calculator', '/images/mortgage-insurance-calculator-copy.png', 8, '', '', 1),
(55, 'LAND TRANSFER TAX CALCULATOR', 'land-transfer-tax-calculator', '/images/land-transfer-tax-calculator-copy.png', 8, '', '', 1),
(56, 'ONTARIO MORTGAGE CALCULATOR', 'ontario-mortgage-calculator', '/images/land-transfer-tax-calculator-copy.png', 8, '', '', 1),
(57, 'FAQ', 'faq', '/images/faq-1.png', 9, '', '', 1),
(58, 'ASK A QUESTION', 'ask-a-question', '/images/Ask-a-question.png', 9, '', '', 1),
(59, 'HELP CENTRE', 'help-centre', '/images/help-center-copy.png', 9, '', '', 1),
(60, 'CONTACT US', 'contact-us', '/images/contact.png', 9, '', '', 1),
(61, 'REALESTATE MARKET', 'realestate-market', '/images/news1.png', 11, '/news/realestate-market', '', 1),
(62, 'WEEKLY BLOG', 'weekly-blog', '/images/news2.png', 11, '/news/weekly-blog', '', 1),
(63, 'TORONTO REALESTATE', 'toronto-realestate', '/images/toronto-realestate.png', 11, '/news/toronto-realestate', '', 1),
(64, 'MLS LISTING', 'mls-listing', '/images/news1.png', 11, '/news/mls-listing', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'create-post', 'Create Posts', 'create new blog posts', '2016-09-21 02:34:09', '2016-09-21 02:34:09'),
(2, 'edit-user', 'Edit Users', 'edit existing users', '2016-09-21 02:34:09', '2016-10-20 19:20:27'),
(3, 'read', 'Read', 'read', '2016-10-20 19:16:49', '2016-10-20 19:16:49');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'owner', 'Project Owner', 'User is the owner of a given project 1', '2016-09-21 02:34:09', '2016-10-20 19:31:29'),
(2, 'admin', 'User Administrator', 'User is allowed to manage and edit other users', '2016-09-21 02:34:09', '2016-09-21 02:34:09'),
(3, 'register', 'Register', 'Register', '2016-10-20 19:33:52', '2017-02-02 18:23:43');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(16, 1),
(16, 2),
(16, 3),
(18, 1),
(18, 2),
(18, 3),
(19, 1),
(20, 3),
(24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `image`, `phone_number`, `address`, `email`, `password`, `remember_token`, `city`, `province`, `postal`, `created_at`, `updated_at`) VALUES
(16, 'tester01', '', '', '', 'tester01@gmail.com', '$2y$10$5Ryr3t/cJrLAGwaAJYt0ye80ROdFmvZguD53yys3/OS/xEGBzIbta', '8FgjTgWVynCrfi8aQNOtsXk0JrO9MLifMowDUZOhjqDsmHfqw8YjfNYsBfhp', '', '', '', '2016-12-16 01:31:16', '2017-02-02 02:30:42'),
(18, 'admin', '/assets/images/profile_small.jpg', '', '', 'admin@gmail.com', '$2y$10$8LCnS/H7363VR3SBDssUoOEQZ80H5XzcBHiULsfYAijgmJLODx2fC', 'qjBRCf6yUf9ZCOYbBs84kn0wIuKYd9AtbFrWrCgcF8bqOTq8gCg9Q1GHql8X', '', '', '', '2016-12-20 00:09:30', '2017-02-07 23:52:31'),
(19, 'owner', '', '', '', 'owner@gmail.com', '$2y$10$aP1.tg.xO5FDKEbvEVurK.Bb328L2PcgEgkfxTWpnkyxD5ZeD44WC', 'S0ej8CrgqLhr0VH9qYRVq9pdyxtneDEigf6xlGKbQEqM3wvAg79mAekF3HWl', '', '', '', '2016-12-20 00:09:58', '2016-12-20 00:10:01'),
(20, 'register', '', '', '', 'register@gmail.com', '$2y$10$ndSNAqAy7hXzpaT3a9mX5.Wz5GmqjROtM5Gxd8F/UKkrcEUTfvHCe', '3hq8oPiAihYPcJroa7unAyZfdVOBjRjgcfuAeWHEzoF9FywgOHajsUTEcmrj', '', '', '', '2016-12-20 00:10:22', '2017-02-03 02:13:03'),
(24, 'toan', '/uploads/hot_properties/hot_properties_item_1.jpg', '0935', '265 le duan', 'toan123@gmail.com', '', NULL, 'hue', 'phat giao', '191779', '2017-02-03 02:51:13', '2017-02-06 01:07:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
