-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2016 at 08:55 AM
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
(1, 'What is Title Insurance and what does it cover?', 'What-is-Title-Insurance-and-what-does-it cover', '', '', '<p>Title insurance is now widely accepted by mortgage lenders including the major banks, trust companies, credit unions and private lenders.</p>\r\n', '<p>Title insurance is now widely accepted by mortgage lenders including the major banks, trust companies, credit unions and private lenders</p>\r\n', 3, 1, '2016-11-30 17:00:00', '2016-12-26 01:53:08'),
(2, '\r\nWhat if You Find a Realtor in Toronto and They’re Terrible?', '\r\nWhat-if-You-Find-a-Realtor-in-Toronto-and-They’re-Terrible?', '', '', 'Everyone has advice when you’re trying to <a href="http://realestate.homula.com/find-a-realtor/" target="_blank">find a Realtor in Toronto</a>. Everyone says, “You have to work with my Realtor. They’re the best.” But they can’t all be the best... Can they?\n\nNot only can a bad realtor cost you thousands of dollars, they can also cost you your dream home by mucking up the offer, or some other part of the process. Here are a few reasons why it’s dangerous to work with the wrong Realtor.\n\n<img class="alignnone size-full wp-image-12067" src="http://realestate.homula.com/wp-content/uploads/2016/11/real-estate-gg.jpg" alt="Find A Realtor Toronto" width="600" height="500" />\n<h2>Because it’s Actually TOO Easy to Find a Realtor in Toronto</h2>\nIt is so easy to open Google, click a few ads and think you’ve found a world-class Realtor. The problem is that a Realtor can easily look the part, without delivering the goods.\n\nIt’s never been cheaper or easier for anyone to get a professional and amazing looking website, or great looking postcards. But great marketing from a Realtor does not necessarily equal great service. They may have more style than substance.\n<h2>Because They Need to Close the Deal. Nothing Else Matters</h2>\nFinding houses for you is only part of the job. Your Realtor could do the <a href="http://realestate.homula.com/realestate-search/">best real estate search in Canada</a>, but it doesn’t help you unless they can actually close these homes for you.\n\nOf course, it takes skill to be able to showcase a home professionally and get the buyer excited about the property. But in the hyper-competitive Toronto real estate market, there is almost always going to be a bidding war. The price you see in the MLS listing is only the start.\n\nYour Realtor needs to put together a simple and compelling offer, with the price and conditions that your buyer will want. The offer and the process are where a truly great real estate agent will shine.\nBecause There’s So Much at Stake in the Toronto Real Estate Market\nOverpaying for a home in most markets may mean you paid a few extra thousand dollars. But in Toronto, that number can easily swell into the tens of thousands of dollars in a hurry. You’ve scanned <a href="http://realestate.homula.com/history-mls-listings-toronto/">MLS listings</a>, you can see what’s at stake.\n\nYou need to ensure your Realtor is dialed into the <a href="http://realestate.homula.com/toronto-real-estate-market-booms-despite-warnings/">Toronto market</a>. That means they’re not just aware of the current trends, they can predict where the market is heading.\n<h2>Because You May Not Know They Were Bad Until Years Later</h2>\nHere’s a nightmare scenario that’s a little too real for most buyers.\n\nYou find a real estate agent. They suggest you skip the home inspection because the seller has other aggressive offers on the table. This could bring your offer to the top. They said they’ve inspected the house themselves and it looks amazing. Fast forward a few years. You learn that the house actually has massive structural issues, and you’re now on the hook for them financially.\n\nIt happens all the time. The Realtor doesn’t have your best interest in mind. They simply wanted to close the deal to make the commission and move on. Meanwhile, you thought they were hustling so you didn’t lose out on your dream home.\n\nSo when you’re trying to <a href="http://realestate.homula.com/find-best-realtor-toronto-2016/">find a Realtor in Toronto</a>, make sure you do your homework. Look beyond their website or postcard and ask for references. Be sure to ask the references about the entire process they went through, especially the offer and the close!', 'Everyone says, “You have to work with my Realtor. They’re the best.” But they can’t all be the best... Can they?', 7, 1, '2016-11-30 17:00:00', '2016-12-01 17:00:00'),
(3, 'Latest trends sweeping the real estate market in Toronto', 'Latest-trends-sweeping-the-real-estate market-in-Toronto', '', '', 'https://youtu.be/h0-1jgPmB_0\r\n\r\nRecently, the Toronto Real Estate has witnessed some very disturbing drifts in terms of price fluctuations. The pricing trends in the housing market have constantly been on a rise with no end in sight of these prices falling in the near future. This Toronto Real Estate price trend is quite perturbing as it could be the target for taxing foreign investors.\r\n<h2>Statistics</h2>\r\nThe statistics which prove that there are ample causes of worry with regards to the Toronto real estate market are:\r\n• There were more than 10,000 homes, <a href="http://realestate.homula.com/ontario-real-estate-search/">which were resold in the Greater Toronto Area in July 2016</a>.\r\n• The number of homes that changed hands in July 2016 was higher than any recorded number for July in any of the previous years. The sales in October 2016 were 11.5% higher than those of October 2015.\r\n• The resale price average of homes increased by 16.6%.\r\n• The price of detached homes increased by 21%. In fact, there has been a constant sales increase by 10% year on year for these detached home sales.\r\n• The Home Price Index MLS Composite Benchmark increased by 19.7% year on year.\r\n• There were new listings in October 2016 which showed a marginal increase over the previous year’s October, however, this was not enough to balance the sales growth and the seller''s market prevailed.\r\n• The semi-detached, as well as townhouses, also saw annualized price gains which were in double digit numbers.\r\n• The price of Condos increased greater than 9% as compared to the previous year during the same month.\r\n• The new listings decreased by 7% in the last month.\r\n• Implications of the increase in prices of Houses for sale Toronto\r\n\r\n<img class="alignnone size-full wp-image-11870" src="http://realestate.homula.com/wp-content/uploads/2016/11/Graph2-2.jpg" alt="Toronto Real Estate" width="600" height="300" />\r\n\r\nThere are various implications with regards the increase in prices of resale homes.\r\n• The first is that the Ontario government has imposed a 15% tax on residential properties which are purchased in the Vancouver area by the nonpermanent residents. This could affect the Toronto housing demands & foreign buyers will choose to rather invest in the Greater Toronto Area instead of choosing the Vancouver area.\r\n• <a href="http://realestate.homula.com/lawyers-firms/">According to Ontario government and legislations</a>, in order to decrease foreign speculation, a tax was implemented and this increased the prices of real- estate by 30% in the metro area of GTA.\r\n• Due to the tax imposed, fierce bidding wars and increased price gains, there is more trouble on the horizon. The trend makes it hard for those who want to <a href="http://realestate.homula.com/realestate-agent/">Find a real estate agent Toronto</a>  in order to purchase their homes. The reason is due to the decreasing supply of homes which are on the resale market.\r\n• There is also a lot of unease when people are conducting a <a href="http://realestate.homula.com/ontario-real-estate-search">Real estate search</a>.  In fact, even the Bank of Canada has warned that the growth is unsustainable. Housing policy is being looked at in different levels of the government. The Federal government too has started a working group in order to come up with the various recommendations in order to ensure that the housing in Toronto & Vancouver is more affordable.\r\n• Another reason why there is unease is that the sellers who are going to sell to those who are overseas or going to sell to investors have more angst as they are not sure if there will be a tax imposed on foreign buyers or on buyers who are not permanent residents of the area.\r\n• In fact, there is a lot of uncertainty as the Mayor John Tory, as well as the Finance Minister, wants to see how the tax imposed Ontario,Toronto, GTA area has an effect.\r\n• It is believed however that this trend is set to slow down in the near future and in fact, during the second half of the year it will cool down considerably due to the general belief that the rates of the mortgage will remain low as a result of the Brexit.\r\n• The advice which perhaps is the most pertinent in the given circumstances with regard to the <a href="http://realestate.homula.com/ontario-real-estate-search/">MIS listing search</a>,  is in case there is no pressing need to buy real estate, you should not do so and rather prefer to sit tight and not move, as there is a holding pattern which is currently found among homeowners. This advice is especially pertinent as there are policy makers at different levels who are brainstorming on different solutions as regard the lacking of low rise inventory which is all over the Greater Toronto Area.\r\n\r\n<img class="alignnone size-full wp-image-11871" src="http://realestate.homula.com/wp-content/uploads/2016/11/graph-2.jpg" alt="mls listings toronto" width="600" height="300" />\r\n\r\n• Reasons for the high Toronto’s Real estate market\r\nThe reasons why Toronto’s real estate market is so high are:\r\n• The foreign and domestic investors are pushing up the local prices. In fact, in the Toronto area, the domestic investors contribute to 25% & foreign investors contribute between 5% to 10% of the total home purchases.\r\n• There are extra buyers in the market who are competing due to the amount of data which is available to them to help them in understanding the market. Due to the interest in investors, there are several people who are entering the buyers market\r\n• There are people who even are ordinary homeowners who are buying houses just so as to capitalize on the market as they see the prices are increasing by 10%-20%\r\n• The investor in the Toronto Real Estate market does not need to make a conditional offer on selling the home and normally bypasses inspections as he or she is only doing it for the sake of the profit.\r\n• The investor’s mortgage interest payments & the renovation costs are tax deductible. These are deducted from the income they earn when they rent the house and therefore, they are more interested in to find a real estate agent Toronto, to help them in purchasing houses, especially with the price increase which they are seeing which give them a good return on their investments.\r\n• Investors in the <a href="http://realestate.homula.com/">Toronto Real Estate</a> can bid higher than those who are purchasing the house to live in. The reason is that the buyers who want to live in the home usually do not go very high as they have to set aside money for the renovations.', 'Recently, the Toronto Real Estate has witnessed some very disturbing drifts in terms of price fluctuations.', 5, 1, '2016-11-30 17:00:00', '2016-12-21 20:21:18'),
(4, 'TORONTO REAL ESTATE UTILITIES', 'TORONTO-REAL-ESTATE-UTILITIES', '', '', '<a href="http://realestate.homula.com/utility-companies/">Utilities</a> are services provided by the public that is paid for in form of a utility bill that is mailed to the owner or tenant. Utilities include water, electricity, sewerage and phone utilities. Some of these are taken care of by the authorities like the municipal councils. The bill for utilities is billed according to the usage of the amenities.\r\n\r\nWhen a tenant moves in to a residential property, an agreement is drawn and signed between the landlord and tenant to agree on who gets the utility bill for the utilities. This agreement is crucial so that there is no blame and lack of provision for these very important utilities.\r\n\r\nEach utility carries its charge, and no utility is charged like another since they are all different things. Depending on how much utility is used, billings are issued every month or in some cases, they are issued three times a year.\r\n\r\nThere are many payment options that can be used to settle a utility bill in Toronto including the pre-authorized utility bill payment program. Other payment options include:\r\n<ul>\r\n 	<li>Internet banking</li>\r\n 	<li>Mobile payments</li>\r\n 	<li>Mail</li>\r\n 	<li>Drop boxes for payments</li>\r\n</ul>\r\n<h1>1.   The pre authorized utility bill payment program</h1>\r\nThis program applies to residents of Toronto who must first enroll to the city of Toronto’s pre-authorized utility payment program that allows financial institutions that the owner has provided in PUP to withdraw utility payments every payment date. After the withdrawal and settlement of the utility bill, an electronic receipt is sent to the owner as proof of payment and the amount paid for what bill.\r\n\r\nThis program cannot be transferred or used for another property beside the one it is registered for. This means that when a tenant moves out of t a house, the utilities are gone, and they need to cancel their pre-authorized utility bill payment program. The earlier signed agreement between the landlord and that tenant ceases to be binding until another tenant moves in and another agreement is signed.\r\n\r\nWhen one purchases a new property in Toronto after selling the previous property, the utility payments do not transfer to the new home, every property gets its own utility bills and utilities. The only requirement is that you ensure to change.\r\n<h1>2.   Types of utility bills in Toronto</h1>\r\n<h2>     i.         Electricity or hydro bill</h2>\r\nEven when electric appliances are switched off, they still consume power which accounts for the total electricity power and is featured in the bill. Most electric bills range between $ 30 and $ 50 per month.\r\n\r\nThere are ways that one can reduce this charge by cutting down on their power usage when they do not need it and using more energy efficient bulbs in houses.\r\n<h2>   ii.         Water bill</h2>\r\nWater is essential for survival and is therefore very important. Paying the water utility bill ensures that water supply is not cut off or reduced. A water meter is mostly installed to take water usage readings and calculate the expected bill. The average payment per month for water is $80.\r\n<h2>iii.         Waste and sewerage bill</h2>\r\nThe removal and disposal of dirt from residential areas and into the appropriate dumping sites is a utility that attracts a monthly charge of up to $322.\r\n<h2>  iv.         Phone utility bill</h2>\r\nSince the digital era has erupted, phone bills are not as popular as cell phones that are much more preferred for their portability, advancement, and ease of use. However, all homes with a home phone have to pay a monthly phone utility bill.\r\n\r\nWhen a payment is late, a fine is applied to the late fees and may also be accompanied by a discontinuation of the pre-authorized utility bill payment program. When a utility is discontinued for lack of pay, after completing the payment, an extra fee is charged for the reconnection of <a href="http://realestate.homula.com/utility-companies/">the utility</a>.\r\n\r\n&nbsp;', 'When a tenant moves in to a residential property, an agreement is drawn and signed between the landlord and tenant', 6, 1, '2016-11-30 17:00:00', '2016-12-01 17:00:00'),
(5, 'MLS LISTINGS TRADEMARK', 'MLS-LISTINGS-TRADEMARK', '', '', '<div class="agent-row-content">\r\n\r\nA trademark is the identifying factor of any single thing, the industry of franchise. The MLS listing trademark is a very important part of the system that ensures the exclusivity of the system and the rights that the MLS system holds on their name, services and building blocks. A trademark will identify the system and ensure that no other company can come up with the same name and exact services. This helps protect the system.\r\n\r\nThe trademark is not just used as anyone pleases. Whether by members or non-members, the MLS trademark is to be respect and used in adherence to all the requirements that are stated for the use of this service and the trademark. The MLS trademark should be used as an adjective and not a noun as it is used to describe the standard of MLS services, not the listing system.\r\nThe MLS trademark can be used in marketing merchandise like t-shirts and caps that are aimed at popularizing or spreading a particular message on behalf of the <a href="http://realestate.homula.com/mls-listing/">MLS listing</a> service. These are most popular in MLS listing events and any rallies held by or on behalf of the MLS. Registration of trademarks is not compulsory but is important in protecting ownership of the business. The kind of symbol that is used on a trademark has a different use. The MLS® system means that the trademark has been successfully registered.\r\n<h2>Requirements for the use of the MLS trademark</h2>\r\n<h2>Must be permitted to use the MLS trademark</h2>\r\nThis is covered under license and agreement which is an elaborate term of the MLS that states, only associations of realtors are freely allowed the use of the MLS trademark. Only with special permission that is written and signed can a non-member use the trademark. Members of associations of realtors are allowed use under the guidance of their respective association that ensures they uphold the requirements and rules attached to the use of the MLS trademark.\r\n<h2>Must always be used in capital letters</h2>\r\nThe MLS trademark is in capital letters and must always be used in capital letters so that it is used correctly. If the trademark is used in small letters or one of the letters is in small letters, then that is not the MLS trademark and represents something entirely different. Anyone found in violation risks being stripped off their use of the trademark privileges.\r\n<h2>Must always have the trademark sign</h2>\r\nThe trademark sign may not ring as important to most people but without this sign, it is not clear that it is a trademark or just and abbreviation of the multiple listings service. The MLS® is important to denote the standard of the service. The symbol is the most important part in identifying a trademark from any other denotations.\r\n<h2>The trademark should not be combined with anything else</h2>\r\nIt is required that no other words or symbols are combined with the trademark as it makes the trademark less commanding. This makes the standard that the trademark represents less effective and respectable. A trademark is sufficiently capable of representing itself and does not need to be introduced or overly decorated to be noticeable.\r\n<h2>Do not use the trademark in domain names</h2>\r\nThe realtor associations and the Canadian Real Estate Association (CREA) that is responsible for managing the MLS trademark strictly prohibits all members or anyone using the trademark from using it in their domain names.\r\n<h2>The MLS trademark should not be used in meta tags</h2>\r\nPeople will want to associated and identified with the MLS and end up using the MLS trademark in their page descriptions or titles. This is not allowed as only the MLS service has rights to the trademark and no individual or entity should try to identify themselves with the MLS listing system.\r\n<h2>Benefits of a trademark</h2>\r\n<h2>Defines a business</h2>\r\nThe trademark is what defines a business and its products. The trademark is used on all products and service documentations to explicitly show that source and the business responsible for the products.\r\n<h2>Exclusive ownership rights</h2>\r\nThe trademark symbol may seem insignificant but it is a very powerful tool that gives exclusive ownership rights to the individual or entity that filed for the trademark. Once the trademark has been approved, there is no other person that can claim ownership. There is a system that is used to check for availability of the trademark selected. Once it is confirmed that no other companies have registered under that trademark it is issued. A trademark is unique to every business and no two companies can share a similar trademark even if in different parts of the world as this could cause confusion.\r\n<h2>Protects the owner and the business</h2>\r\nCompetitors cannot use a similar mark as a trademark to try and dupe their way into stealing clients from the original holder of the trademark. If the holder of a trademark suspects this is the case that a competitor is using their trademark, they have the right to take legal action against the competitor where they will both be required to provide documents proving their ownership of the trademark.\r\n\r\nThe trademark helps a business be able to sue for damages depending on the situation or on what the damage to the business name or trademark is. The protection that the business and the owner is given by registering a trademark is usually forever because trademarks have no expiration dates on them.\r\n\r\n</div>', 'A trademark is the identifying factor of any single thing, the industry of franchise.', 4, 1, '2016-11-30 17:00:00', '2016-12-01 17:00:00'),
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
(71, 'What if You Find a Realtor in Toronto and They’re Terrible?', '', '/uploads/real_estate_new/new-7.jpg', 'http://realestate.homula.com/find-realtor-toronto-theyre-terrible/', '', '', 0, 1, '2016-12-29 21:27:00', '2016-12-29 21:27:03');

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
(12, 'RESALES HOME', 'resales-home', '<img src="http://homula-laravel.local/images/resales-home.png" alt="">', 2, '', '', 1),
(13, 'NEW CONSTRUCTION HOME', 'new-construction-home', '<img src="http://homula-laravel.local/images/new-construction-home.png" alt="">', 2, '', '', 1),
(14, 'NEW CONSTRUCTION CONDO', 'new-construction-condo', '<img src="http://homula-laravel.local/images/new-construction-condo.png" alt="">', 2, '', '', 1),
(15, 'EXCLUSIVE HOMES', 'exclusive-homes', '<img src="http://homula-laravel.local/images/exclusive-home.png" alt="">', 2, '', '', 1),
(16, 'OPEN HOUSE', 'open-house', '<img src="http://homula-laravel.local/images/open-house.png" alt="">', 2, '', '', 1),
(17, 'COMING SOON', 'coming-soon', '<img src="http://homula-laravel.local/images/coming-soon.png" alt="">', 2, '', '', 1),
(18, 'BUSINESS', 'business', '<img src="http://homula-laravel.local/images/business-homula.png" alt="">', 2, '', '', 1),
(19, 'FREE HOME EVALUATION', 'free-home-evaluation', '<img src="http://homula-laravel.local/images/free-home-evluation-homula.png" alt="">', 3, '', '', 1),
(20, 'FREE HOME REPORT', 'free-home-report', '<img src="http://homula-laravel.local/images/free-home-report-homula.png" alt="">', 3, '', '', 1),
(21, 'FIND A REALTOR', 'find-a-realtor', '<img src="http://homula-laravel.local/images/find-retailer-copy.png" alt="">', 3, '', '', 1),
(22, 'LIST MY HOUSE', 'list-my-house', '<img src="http://homula-laravel.local/images/list-my-home-homula.png" alt="">', 3, '', '', 1),
(23, 'LEASE SEARCH', 'lease-search', '<img src="http://homula-laravel.local/images/search-copy.png" alt="">', 4, '', '', 1),
(24, 'MAP SEARCH', 'map-search', '<img src="http://homula-laravel.local/images/search-copy.png" alt="">', 4, '', '', 1),
(25, 'COMMERCIAL SEARCH', 'commercial-search', '<img src="http://homula-laravel.local/images/search-copy.png" alt="">', 4, '', '', 1),
(26, 'BUSINESS', 'business', '<img src="http://homula-laravel.local/images/business-copy.png" alt="">', 4, '', '', 1),
(27, 'UTILITY', 'utility', '<img src="http://homula-laravel.local/images/utility-copy.png" alt="">', 4, '', '', 1),
(28, 'SEARCH', 'search', '<img src="http://homula-laravel.local/images/search-copy.png" alt="">', 4, '', '', 1),
(29, 'SEARCH', 'search', '<img src="http://homula-laravel.local/images/search-2.png" alt="">', 5, '', '', 1),
(30, 'ADVANCED SEARCH', 'advanced-search', '<img src="http://homula-laravel.local/images/ad-search2.png" alt="">', 5, '', '', 1),
(31, 'LIST YOUR PROPERTY', 'list-your-property', '<img src="http://homula-laravel.local/images/home-listing2.png" alt="">', 5, '', '', 1),
(32, 'FIND A COMMERCIAL REALTOR', 'find-a-commercial-realtor', '<img src="http://homula-laravel.local/images/find-retaile2.png" alt="">', 5, '', '', 1),
(33, 'REAL ESTATE PROFESSIONAL', 'real-estate-professional', '<img src="http://homula-laravel.local/images/real-estate-professiona-homula.png" alt="">', 6, '', '', 1),
(34, 'LEASING AGENT', 'leasing-agent', '<img src="http://homula-laravel.local/images/leasing-agent1-homula.png" alt="">', 6, '', '', 1),
(35, 'MORTGAGE BROKER', 'mortgage-broker', '<img src="http://homula-laravel.local/images/Mortage-broker-copy.png" alt="">', 6, '', '', 1),
(36, 'HOME INSPECTOR', 'home-inspector', '<img src="http://homula-laravel.local/images/homeinspector-homula.png" alt="">', 6, '', '', 1),
(37, 'REAL ESTATE LAWYER', 'real-estate-lawyer', '<img src="http://homula-laravel.local/images/lawyer-homula.png" alt="">', 6, '', '', 1),
(38, 'APPRAISER', 'appraiser', '<img src="http://homula-laravel.local/images/appraiser-homula.png" alt="">', 6, '', '', 1),
(39, 'PROPERTY MANAGEMENT', 'property-management', '<img src="http://homula-laravel.local/images/property-management-homula.png" alt="">', 6, '', '', 1),
(40, 'HOME STAGERS', 'home-stagers', '<img src="http://homula-laravel.local/images/home-stagers-homula.png" alt="">', 6, '', '', 1),
(41, 'INSURANCE BROKERS', 'insurance-brokers', '<img src="http://homula-laravel.local/images/insurance-broker-homula.png" alt="">', 6, '', '', 1),
(42, 'MOVING COMPANY', 'moving-company', '<img src="http://homula-laravel.local/images/moving-company-homula.png" alt="">', 6, '', '', 1),
(43, 'GRAPHIC DESIGNER', 'graphic-designer', '<img src="http://homula-laravel.local/images/photographers-reps-homula.png" alt="">', 6, '', '', 1),
(44, 'LAWYERS(FIRMS)', 'lawyers-firms', '<img src="http://homula-laravel.local/images/sign-supplir-copy.png" alt="">', 6, '', '', 1),
(45, 'SIGN INSTALLERS', 'sign-installers', '<img src="http://homula-laravel.local/images/shape-homula.png" alt="">', 6, '', '', 1),
(46, 'PRINTERS', 'printers', '<img src="http://homula-laravel.local/images/printer-homula.png" alt="">', 6, '', '', 1),
(47, 'PHOTOGRAPHERS (PROPERTIES)', 'photographers-properties', '<img src="http://homula-laravel.local/images/photographer-homula.png" alt="">', 6, '', '', 1),
(48, 'PHOTOGRAPHERS (REPS)', 'photographers-reps', '<img src="http://homula-laravel.local/images/photographers-reps-homula.png" alt="">', 6, '', '', 1),
(49, 'MORTGAGE BROKER', 'mortgage-broker', '<img src="http://homula-laravel.local/images/Mortage-broker-copy.png" alt="">', 7, '', '', 1),
(50, 'MORTGAGE INSURANCE CALCULATOR', 'mortgage-insurance-calculator', '<img src="http://homula-laravel.local/images/mortgage-insurance-calculator-copy.png" alt="">', 7, '', '', 1),
(51, 'MORTGAGE RATGES', 'mortgage-ratges', '<img src="http://homula-laravel.local/images/mortage-rates-copy.png" alt="">', 7, '', '', 1),
(52, 'NEW MORTGAGE CALCULATOR', 'new-mortgage-calculator', '<img src="http://homula-laravel.local/images/mortage-calculater-copy.png" alt="">', 7, '', '', 1),
(53, 'MORTGAGE CALCULATOR', 'mortgage-calculator', '<img src="http://homula-laravel.local/images/mortage-calculater-copy.png" alt="">', 8, '', '', 1),
(54, 'MORTGAGE INSURANCE CALCULATOR', 'mortgage-insurance-calculator', '<img src="http://homula-laravel.local/images/mortgage-insurance-calculator-copy.png" alt="">', 8, '', '', 1),
(55, 'LAND TRANSFER TAX CALCULATOR', 'land-transfer-tax-calculator', '<img src="http://homula-laravel.local/images/land-transfer-tax-calculator-copy.png" alt="">', 8, '', '', 1),
(56, 'ONTARIO MORTGAGE CALCULATOR', 'ontario-mortgage-calculator', '<img src="http://homula-laravel.local/images/land-transfer-tax-calculator-copy.png" alt="">', 8, '', '', 1),
(57, 'FAQ', 'faq', '<img src="http://homula-laravel.local/images/faq-1.png" alt="">', 9, '', '', 1),
(58, 'ASK A QUESTION', 'ask-a-question', '<img src="http://homula-laravel.local/images/Ask-a-question.png" alt="">', 9, '', '', 1),
(59, 'HELP CENTRE', 'help-centre', '<img src="http://homula-laravel.local/images/help-center-copy.png" alt="">', 9, '', '', 1),
(60, 'CONTACT US', 'contact-us', '<img src="http://homula-laravel.local/images/contact.png" alt="">', 9, '', '', 1),
(61, 'REALESTATE MARKET', 'realestate-market', '<img src="http://homula-laravel.local/images/news1.png" alt="">', 11, '', '', 1),
(62, 'WEEKLY BLOG', 'weekly-blog', '<img src="http://homula-laravel.local/images/news2.png" alt="">', 11, '', '', 1),
(63, 'TORONTO REALESTATE', 'toronto-realestate', '<img src="http://homula-laravel.local/images/toronto-realestate.png" alt="">', 11, '', '', 1),
(64, 'MLS LISTING', 'mls-listing', '<img src="http://homula-laravel.local/images/news1.png" alt="">', 11, '', '', 1);

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
(3, 'register', 'Register', 'Register', '2016-10-20 19:33:52', '2016-10-20 19:33:52');

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
(20, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `middle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first`, `middle`, `last`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(16, 'tester01', NULL, NULL, NULL, 'tester01@gmail.com', '$2y$10$5Ryr3t/cJrLAGwaAJYt0ye80ROdFmvZguD53yys3/OS/xEGBzIbta', '8FgjTgWVynCrfi8aQNOtsXk0JrO9MLifMowDUZOhjqDsmHfqw8YjfNYsBfhp', '2016-12-16 01:31:16', '2016-12-26 21:20:07'),
(18, 'admin', NULL, NULL, NULL, 'admin@gmail.com', '$2y$10$8LCnS/H7363VR3SBDssUoOEQZ80H5XzcBHiULsfYAijgmJLODx2fC', 'pqQhmg2TAi9CV9yVYlfUfaRK5A87yegtJRCgKcLY0xARcP4zPk09MZQy90Qc', '2016-12-20 00:09:30', '2016-12-30 00:32:55'),
(19, 'owner', NULL, NULL, NULL, 'owner@gmail.com', '$2y$10$aP1.tg.xO5FDKEbvEVurK.Bb328L2PcgEgkfxTWpnkyxD5ZeD44WC', 'S0ej8CrgqLhr0VH9qYRVq9pdyxtneDEigf6xlGKbQEqM3wvAg79mAekF3HWl', '2016-12-20 00:09:58', '2016-12-20 00:10:01'),
(20, 'register', NULL, NULL, NULL, 'register@gmail.com', '$2y$10$ndSNAqAy7hXzpaT3a9mX5.Wz5GmqjROtM5Gxd8F/UKkrcEUTfvHCe', 'E8BPI6y559PxXEzNq5fch0LNUEL4RdyAZT8QJchiNwSMtIVmdnzxr0iRGjrv', '2016-12-20 00:10:22', '2016-12-21 00:18:52');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
