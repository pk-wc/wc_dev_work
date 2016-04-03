<?php

session_start();
require_once("custom/funcs/functions.php");

$wc_uid = getSessionUID();

echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '  <head>';
echo '    <meta charset="utf-8">';
echo '    <meta http-equiv="X-UA-Compatible" content="IE=edge">';
echo '    <meta name="viewport" content="width=device-width, initial-scale=1">';
echo '    <meta name="description" content="">';
echo '    <meta name="author" content="">';
echo '    <link rel="icon" href="../../favicon.ico">';
getPageTitle("Terms & Conditions");
loadCSSFiles();
loadJSFiles();
echo '  </head>';
echo '  <body>';

showHeader("terms");
loadLoginModal();

if($wc_uid){
	echo '<div class="container" style="margin-top: 50px;">';
}else{
	echo '<div class="container" style="margin-top: 50px;">';
}
checkPageMessages();
echo '    </div>';

if($wc_uid){
        echo '  <div class="container">';/*ravi*/
        echo '  <div class="row">';/*ravi*/
	echo '<div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 main" style="padding:10px">';/*ravi*/
	
	
}else{
	echo ' <div class="container">';
}

echo '  <h1 style="text-align:center">Terms & Conditions</h1>
	<h2 style="margin-bottom: 10px;">OVERVIEW</h2>
	<p>Throughout the site and Application, the terms “we”, “us” and “our” refer to WeCarriers</p>
	<h2 style="margin-bottom: 10px;">SCOPE AND DEFINITIONS</h2>
	<p>These general conditions of Use apply to all services provided by WeCarriers (defined herein below). </p>
	<h2 style="margin-bottom: 10px;">DEFINED TERMS</h2>
	<p>“Site” means WeCarriers.com.</p>
	<p>“WeCarriers.com”, a service/product of One20 solutions Ltd..</p>
	<p>“Member” means a registered user or company on the Site.</p>
	<p>“WeCarrier” means the Member who carries the Parcel with him/her.</p>
	<p>“WeSender” means the member who sends the Parcels.</p>
	<p>“Receiver” means the person/company whom parcel needs to be delivered</p>
	<p>“Service” refers to any service provided by WeCarriers.com to any Member.</p> 
	<p>“Travel Information” means the sharing of Personal Travelling Information by member/user for carrying the Parcel for that travel in exchange for Cost Contribution.</p>
	<p>“Conditions” means these General Conditions of Use, including the Good interaction, respect and Privacy Policy of WeCarriers as notified on the site.</p>
	<p>“Cost Contribution” means the amount agreed between the WeCarrier and the WeSender in relation to the carrying the Parcel which is payable by the WeSender as their contribution towards the costs of the Parcel etc.</p>
	<p>“Parcel” means parcels, documents and any other shipments which need to be sent with WeCarriers by WeSenders.</p>
	<p>“User Account” means an account with the Site opened by a Member and used in order to access the Service provided by WeCarriers.com through the Site.</p>
	
	
	<h2 style="margin-bottom: 10px;">ACCEPTANCE OF CONDITIONS</h2>
	<p>The Conditions apply to any and all use of the Site by a Member. By using the Site, the Members signify their acceptance to these Conditions in full and agree to be bound by them.</p>
	<p>No access to the Services will be permitted unless the Conditions are accepted in full. No Member is entitled to accept part only of the Conditions. If a Member does not agree to the Conditions, such Member may not use the Services.</p>
	<p>All Members agree to comply with the Conditions and accept that their personal data may be processed in accordance with the Privacy Policy.</p>
	<p>In the event that any Member fails to comply with any of the Conditions, WeCarriers.com reserves the right, but not the obligation at its own discretion, to withdraw the User Account in question and suspend or withdraw all Services to that Member without notice.</p>
	<h4 style="margin-bottom: 10px;">Variation of the Conditions, Site and Service</h4>
	<p>WeCarriers.com reserves the right to modify the Conditions at any time. In addition, WeCarriers.com may vary or amend the Services provided through the Site, the Site functionality and/ or the “look and feel” of the Site at any time without notice and without liability to Members.</p>
	<p>Any modification to the Site, Services or Conditions will take effect as soon as such changes are published on the Site, subject to communication of any material change to the Conditions to the Members in an e-mail.</p>
	<p>Members will be deemed to have accepted any varied Conditions in the event that they use any Services offered through the Site following publication of the varied Conditions. Changes will not apply to any bookings which have been made prior to publication of the varied Conditions.</p>
	
	<h2 style="margin-bottom: 10px;">USE OF THE SERVICE</h2>
	<h4 style="margin-bottom: 10px;">User Account and Accuracy of Information</h4>
	<p>In order to use the Services each Member must create a User Account and agrees to provide any personal information requested by WeCarriers.com. In particular, Members will be required to provide their first name, last name, age, title, valid telephone number and email address. Use of the Site is limited to those over the age of 18 years at the time of registration.</p>
	<p>Members agree and accept that all of the information they provide to WeCarriers.com when setting up their User Account and at any other time shall be true, correct, complete and accurate in all respects. Members also agree that any information supplied to WeCarriers.com or posted on the Site in connection with any Travel will be true, accurate and complete.</p>
	<p>Members agree and understand that WeCarriers.com does not undertake any verification to confirm the accuracy of any information provided by the Members on the Site or to a WeCarriers or WeSenders, as the case maybe. WeCarriers.com will not be liable to any Member in the event that any information provided by another Member is false, incomplete, inaccurate, misleading or fraudulent. WeCarriers.com can verify members anytime and by any means and if any kind of discrepancy is found against members then it will be liable to take legal action against them.</p>
	<p>Unless expressly agreed by WeCarriers.com, Members are limited to one User Account per Member. No User Account may be created on behalf of or in order to impersonate another person.</p>
	<h4 style="margin-bottom: 10px;">No Commercial Activity and Status of WeCarriers.com</h4>
	<p>The Site and the Services are strictly limited to providing a Service for WeCarriers to provide their Travel Information to be agreed to carry Parcel and WeSenders to provide their Parcel details, in a private capacity. The Services may not be used to offer or accept Travel sharing for hire or reward or for profit or in any commercial or professional context. The Services may be used only to offer or accept Parcel acceptance, sharing and sending in exchange for the cost which is mutually decided by WeCarriers and the WeSender.</p>
	<p>WeCarriers agree not to obtain any hire or reward in any form, from any Travel. The Service and the Cost Contribution may only be used to discharge the WeCarrier’s costs and may not be used to generate any hiring charges or reward or profit in any form for the WeCarriers. The Parcel must be delivered to WeCarrier by WeSender and Receiver by WeCarrier must be within pre-mentioned time and also if it is getting delayed then it should be properly communicated. This applies to all activities, arrangements and Services booked using the Site and any additional services or activities which may be agreed between WeCarriers and WeSender through the Site.</p>
	<p>The WeCarriers must not provide any additional services to the WeSender in exchange for hiring charges or any reward or for profit or otherwise (and the WeSender may not accept or ask for any such services) including (without limitation) waiting time, additional drop offs and pick-ups and collecting additional passengers (other than the Parcel).</p>
	<p>All Travels, collection points and destinations must be pre-agreed through the Site between the WeCarriers and WeSender. WeCarriers may not collect any Parcel from any location which has not been pre-agreed with the WeSender through the Site.</p>
	<p>WeCarriers.com shall not be in for any loss or damage incurred by a Member as a result of any or breach by a Member of these Conditions including where any WeCarrier (in breach of these terms) offers Services through the Site in a professional or commercial capacity (thereby potentially invalidating their insurance) and breach of any agreement between the WeCarrier and the WeSender. Any offering of Travels in violation of the Conditions shall be at the sole risk such Member and WeCarriers.com shall have no liability towards Members for such violations.</p>
	<h4 style="margin-bottom: 10px;">Status of WeCarriers.com</h4>
	<p>Neither WeCarriers.com nor the Site provides any transport services. The Site is a communications platform for Members to transact with one another. WeCarriers.com does not interfere with Travels, destinations or timings. The agreement for Parcel pickups and delivery, charges for Parcel, timings is between the WeCarrier and the WeSender. WeCarriers.com is not a party to any agreement or transaction between Members, nor is WeCarriers.com liable in respect of any matter arising which relates to a booking between Members. WeCarriers.com is not and will not act as an agent for any Member.</p>
	<p>Any breach of these Conditions will give rise to immediate suspension of such Member’s User Account and they may be restricted from accessing any further Services.</p>
	<h4 style="margin-bottom:10px;">Types of Booking and Payment</h4>
	<p>WeCarriers.com offers a free service which allows Members to contact each other to arrange a Parcel pickup and delivery.</p>
	<p>WeCarriers.com’s Service is free of charge. The WeSender will contact the WeCarrier directly to arrange a parcel pickup and delivery to receiver and any conditions related to Parcels (including size of Parcel, Urgency of Parcel, various options related to handing over the Parcel to WeCarriers and Receiver, Cost etc). Members accept that given the nature of the service and the fact that it is free of charge WeCarriers and WeSenders will have no recourse to WeCarriers.com for any aspect of the transaction including in relation to cancellation, last minute changes, failure by the WeCarrier or the WeSender to turn up or non-payment of the Cost Contribution. In particular it is the WeCarrier’s responsibility to collect payment from the WeSender before the time of the Travel.</p>
	<p>WeCarriers.com will not contact either party and will take no steps whatsoever to manage the booking. The operation of the Travel is solely managed by the respective WeCarrier and WeSender(s).</p>
	<p>Please note that WeCarriers.com reserves the right to change any aspect of the Site or the Service which may include adding new services (which may require payment) or withdrawing any existing Services. WeCarriers.com does not guarantee that the Site will be functional at all times and Services may be suspended during such period when the Site is not in operation. WeCarriers.com will not be liable to any of the Members in case where the Site is non-operational.</p>
	<h4 style="margin-bottom:10px;">WeCarrier and WeSender Obligations</h4>
	<h5>WeCarrier\'s obligations</h5>
	<p>The Travel shall not be for any fraudulent, unlawful or criminal activity.</p>
	<p>They will take care and insure for the Parcel just like their other stuff.</p>
	<p>They will present themselves on time and at the place agreed.</p>
	<p>They will immediately inform WeSender(s) of any change whatsoever to the Travel. If one or more WeSenders have made a booking and the WeCarrier decides to change any aspect of the Travel, the WeCarrier undertakes to contact all WeSenders who have made a booking in relation to that Travel and to obtain the agreement of all WeSenders to the change. If a WeSender refuses the change, they are entitled to a full refund and without any compensation being paid to the WeCarrier.</p>
	<p>The WeCarrier must comply with the Good Conduct Charter at all times.</p>
	<p>The WeCarrier must wait for the WeSender at the pickup point for at least 30 minutes after the agreed time (however, the WeSender is expected to be punctual).</p>
	<h5>WeSender’s obligations</h5>
	<p>The Parcel shall not be for any fraudulent, unlawful or criminal activity. </p>
	<p>The Parcel should not contain which is illegal to ship.</p>
	<p>They will present themselves on time and at the place agreed with the WeCarrier.</p>
	<p>They will immediately inform the WeCarrier or WeCarriers.com if they are required to cancel a Travel.</p>
	<p>They will comply with the Good Conduct Charter at all times.</p>
	<p>The WeSender agrees to wait at the pickup point for at least 30 minutes after the agreed time for the WeCarriers to arrive (however, the WeCarrier is expected to be punctual).</p>
	<p>They will pay the Cost Contribution to the WeCarrier.</p>
	<p>If the WeSender or WeCarrier fail to comply with any of these terms or any other Conditions WeCarriers.com reserves the right to keep information relating to the breach, to publish or disclose this information on the Member’s online profile and to suspend or withdraw the Member’s access to the Site.</p>
	<h4 style="margin-bottom:10px;">Insurance</h4>
	<p>WeCarriers.com gives no warranty or assurance in safety of Parcel and it is the WeCarrier’s responsibility that they safely deliver the Parcel to the Receiver at the pre-decided time and place.</p>
	<h4 style="margin-bottom:10px;">Management of Disputes between Members</h4>
	<p>WeCarriers.com may at its sole discretion provide its Members with an online service for resolving disputes. This service is non-binding. WeCarriers.com is under no obligation to seek to resolve disputes and this service is offered at WeCarriers.com’s sole discretion and may be withdrawn at any time.</p>
	<h4 style="margin-bottom:10px;">International Travels and International Bookings</h4>
	<p>Bookings may be made through the Site for international Travels. An International Travel means any Travel which includes any travel outside of India. If a booking is made for an International Travel WeCarriers must ensure that their insurance covers travel outside of India. The WeCarrier must also ensure that all their belongings along with the Parcel compliant with all relevant rules and restrictions applicable in any overseas country.</p>
	<h4 style="margin-bottom:10px;">Verification of Phone Number</h4>
	<p>In order to increase trustworthiness, prevent typos and wrong numbers, every Member has to verify their mobile number. The Member need to do this by providing WeCarriers.com with their mobile phone number, after which the Member will receive a SMS with a 4-digit code which can be validated on the Site.</p>
	<p>This service is free of charge, except for the possible cost levied by a Member’s mobile phone operator for receiving the SMS.</p>
	
	<h2 style="margin-bottom: 10px;">DISCLAIMER OF LIABILITY</h2>
	<p>Members may access the Services on the Site at their own risk and using their best and prudent judgment before entering into any arrangements with other Members through the Site. WeCarriers.com will neither be liable nor responsible for any actions or inactions of Members nor any breach of conditions, representations or warranties by the Members. WeCarriers.com hereby expressly disclaims and any and all responsibility and liability in arising out of the use of the Site.</p>
	<p>WeCarriers.com expressly disclaims any warranties or representations (express or implied) in respect of Travels, accuracy, reliability and completeness of information provided by Members, or the content (including details of the Travel and Cost Contribution) on the Site. While WeCarriers.com will take precautions to avoid inaccuracies in content of the Site, all content and information, are provided on an as is where is basis, without warranty of any kind. WeCarriers.com does not implicitly or explicitly support or endorse any of the Members availing Services from the Site.</p>
	<p>WeCarriers.com is not a party to any agreement between a WeCarrier and WeSender and will not be liable to either the WeCarrier or the WeSender unless the loss or damage incurred arises due to WeCarriers.com’s negligence.</p>
	<h4 style="margin-bottom:10px;">WeCarriers.com shall not be liable for any loss or damage arising as a result of:</h4>
	<p>A false, misleading, inaccurate or incomplete information being provided by a Member.</p>
	<p>The cancellation of a Travel by a WeCarrier or WeSender.</p>
	<p>Any failure to make payment of a Cost Contribution (for the free service without booking).</p>
	<p>Any fraud, fraudulent misrepresentation or breach of duty or breach of any of these Conditions by a WeCarrier or WeSender before, during or after a Travel.</p>
	<p>WeCarriers.com will not be liable to any Member for any business, financial or economic loss or for any consequential or indirect loss such as lost reputation, lost bargain, lost profit, lost of anticipated savings or lost opportunity arising as a result of the services provided by WeCarriers.com (whether suffered or incurred as a result of the WeCarriers.com’s negligence or otherwise) except in the case of fraud, wilful concealment or theft.</p>
	<p>WeCarriers.com’s liability to any Member for all losses in respect of any Travel is capped at the sum of INR 500/- (Indian Rupees Five Hundred only).</p>
	<p>WeCarriers.com will not be liable to any Member in relation to any Travel unless WeCarriers.com is notified of a claim relating to that Travel within 3 Days of completion of the Delivery to the Receiver or completion of scheduled Delivery time.</p>
	<p>WeCarriers.com’s service is limited to putting WeCarriers and WeSenders in touch with each other and cannot oversee any Travel, Members accept that the limitations on the WeCarriers.com’s liability set out above are reasonable.</p>
	
	<h2 style="margin-bottom: 10px;">INDEMNITY AND RELEASE</h2>
	<p>Members will indemnify and hold harmless WeCarriers.com, its subsidiaries, affiliates and their respective officers, directors, agents and employees, from any claim or demand, or actions including reasonable attorney\'s fees, made by any third party or penalty imposed due to or arising out of your breach of these Conditions or any document incorporated by reference, or your violation of any law, rules, regulations or the rights of a third party.</p>
	<p>Members release WeCarriers.com and/or its affiliates and/or any of its officers and representatives from any cost, damage, liability or other consequence of any of the actions/inactions of the Members and specifically waiver any claims or demands that they may have in this behalf under any statute, contract or otherwise.</p>
	
	
	<h2 style="margin-bottom: 10px;">GENERAL TERMS</h2>
	<h4 style="margin-bottom:10px;">Relationship</h4>
	<p>No arrangement between the Members and WeCarriers.com shall constitute or be deemed to constitute an agency, partnership, joint venture or the like between the Members and WeCarriers.com.</p>
	<h4 style="margin-bottom:10px;">Suspension or Withdrawal of Site Access</h4>
	<p>In the event of non-compliance on your part with all or some of the Conditions, you acknowledge and accept that WeCarriers.com can at any time, without prior notification, interrupt or suspend, temporarily or permanently, all or part of the service or your access to the Site (including in particular your User Account).</p>
	<h4 style="margin-bottom:10px;">Content of the Site Provided by the Members</h4>
	<p>By displaying content on this Site, Members expressly grant a license to WeCarriers.com to display the content and to use it for any of our other business purposes.</p>
        <p>Members of this Site are expressly asked not to publish any defamatory, misleading or offensive content or any content which infringes any other persons intellectual property rights (e.g. copyright). Any such content which is contrary to WeCarriers.com’s policy and WeCarriers.com does not accept liability in respect of such content, and the Member responsible will be personally liable for any damages or other liability arising and agrees to indemnify WeCarriers.com in relation to any liability it may suffer as a result of any such content. However as soon as WeCarriers.com becomes aware of infringing content, WeCarriers.com shall do everything it can to remove such content from the Site as soon as possible.</p>
	<h4 style="margin-bottom:10px;">Partner Sites</h4>
	<p>WeCarriers.com reserves the right to reproduce any information that appears on the Site or on the partner sites.</p>
	<p>In particular, ads published on one of the sites maintained or co-maintained by WeCarriers.com may be reproduced on other sites maintained or co-maintained by WeCarriers.com or third parties.</p>

	<h2 style="margin-bottom: 10px;">LAW AND JURISDICTION</h2>
	<p>These terms shall be governed by the law of India and any disputes arising in relation to these terms shall be subject to the jurisdiction of the Courts of Mumbai/Pune.</p>
	
	<h2 style="margin-bottom: 10px;">BY USING THE APPLICATION OR THE SERVICE, YOU FURTHER AGREE THAT:</h2>
	<p>You will comply with all applicable law from your home nation, the country, state and/or city in which you are present while using the Application or Service.</p>
	<p>You will not authorize others to use your account.</p>
	<p>You will not assign or otherwise transfer your account to any other person or legal entity.</p>
	<p>You will not use an account that is subject to any rights of a person other than you without appropriate authorization.</p>
	<p>You will not use the Service or Application for unlawful purposes, including but not limited to sending or storing any unlawful material or for fraudulent purposes.</p>
	<p>You will not use the Service or Application to cause nuisance, annoyance or inconvenience.</p>
	<p>You will not impair the proper operation of the network.</p>
	<p>You will not try to harm the Service or Application in any way whatsoever.</p>
	<p>You will not copy, or distribute the Application or other WeCarriers.com Content without written permission from WeCarriers.com.</p>
	<p>You will keep secure and confidential your account password or any identification we provide you which allows access to the Service and the Application.</p>
	<p>You will provide us with whatever proof of identity we may reasonably request.</p>
	<p>You will only use an access point or 2G, 3G, 4G data account (AP) which you are authorized to use.</p>
	<p>You will not use the Service or Application with an incompatible or unauthorized device.</p>
	<p>You will only use the Service or download the Application for your sole, personal use and will not resell it to a third party.</p>
	
	<h2 style="margin-bottom: 10px;">ONLINE STORE TERMS</h2>
	<p>By agreeing to these Terms of Service, you represent that you are at least the age of majority in your state or province of residence, or that you are the age of majority in your state or province of residence and you have given us your consent to allow any of your minor dependents to use this site</p>
	<p>You may not use our products for any illegal or unauthorized purpose nor may you, in the use of the Service, violate any laws in your jurisdiction (including but not limited to copyright laws).</p>
	<p>You must not transmit any worms or viruses or any code of a destructive nature.</p>
	<p>A breach or violation of any of the Terms will result in an immediate termination of your Services and legal actions against you.</p>
	
	<h2 style="margin-bottom: 10px;">CONTACT INFORMATION</h2>
	<p>Questions about the Terms of Service should be sent to us at <a>support@wecarriers.com</a></p>
	';
	

if($wc_uid){
	showSidebarBottom();
	
	echo '</div>';
	echo '</div>';
}
	
if(!$wc_uid){
	showFooter();
}

echo '</div>';
loadLaterJSFiles();

echo '  </body>';
echo '</html>';

?>
