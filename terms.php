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
echo ' 
<style>
	   #terms OL { counter-reset: item;list-style:none;
    padding-left:0;  }
	   #terms li { font-size: 20px;font-weight:bold }
	   #terms li li { font-size: 18px;font-weight:normal }
	   #terms li li li { font-size: 16px;font-weight:normal }
	   #terms LI { display: block }
	   #terms LI:before { content: counters(item, ".") ". "; counter-increment: item }
	</style>
';
echo '  </head>';
echo '  <body>';

showHeader("terms");
loadLoginModal();
echo '<div id="content">';
echo ' <div class="container" style="margin-top: 50px;">';
checkPageMessages();
echo ' </div>';

echo ' <div class="container">';

echo '  <div id="terms"><h1 style="text-align:center">Terms & Conditions</h1>
        <ol>
		<li>OVERVIEW
			<ul class="text-justify" style="font-size: 18px;font-weight:normal">Throughout the site and Application, the terms “we”, “us” and “our” refer to <a href="wecarriers.com">WEcarriers.com</a></ul>
                </li>
		<li>SCOPE AND DEFINITIONS
			<ul class="text-justify" style="font-size: 18px;font-weight:normal">These general conditions of Use apply to all services provided by WEcarriers (defined herein below).</ul>
                </li>
		<li>DEFINED TERMS
                        <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px"><strong>“Site”</strong> means <a href="wecarriers.com">WEcarriers.com</a>.</ul>
                        <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px"><strong>“<a href="wecarriers.com">WEcarriers.com</a>”</strong>, a service/product of One20 solutions Ltd.</ul>
                        <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px"><strong>“Member”</strong> means a registered user or company on the Site.</ul>
                        <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px"><strong>“WEcarrier”</strong> means the Member who carries the Parcel with him/her.</ul>
                        <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px"><strong>“WEsender”</strong> means the member who sends the Parcels.</ul>
                        <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px"><strong>“Receiver”</strong> means the person/company to whom parcel needs to be delivered.</ul>
                        <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px"><strong>“Service”</strong> refers to any service provided by <a href="wecarriers.com">WEcarriers.com</a> to any Member.</ul>
                        <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px"><strong>“WEpoints”</strong> refers to points earned by a user by joining the site and also on joining of their referrals.</ul>
                        <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px"><strong>“Travel Information”</strong> means the sharing of Personal Travelling Information by member/user for carrying the Parcel for that travel in exchange for Cost Contribution.</ul>
                        <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px"><strong>“Conditions”</strong> means the General Conditions of Use, including the Good interaction, respect and Privacy Policy of WEcarriers as notified on the site.</ul>
                        <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px"><strong>“Cost Contribution”</strong> means the amount agreed between the WEcarrier and the WEsender in relation to carrying the Parcel which is payable by the WEsender as their contribution towards the cost of the Parcel etc.</ul>
                        <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px"><strong>“Parcel”</strong> means parcels, documents and any other shipments which need to be sent with WEcarriers by WEsenders.</ul>
                        <ul class="text-justify" style="font-size: 18px;font-weight:normal"><strong>“User Account”</strong> means an account with the Site opened by a Member and used in order to access the Service provided by <a href="wecarriers.com">WEcarriers.com</a> through the Site.</ul>
                </li>
                <li>ACCEPTANCE OF CONDITIONS
                        <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px">The Conditions apply to any and all use of the Site by a Member. By using the Site, the Members signify their acceptance to these Conditions in full and agree to be bound by them.</ul>
                        <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px">No access to the Services will be permitted unless the Conditions are accepted in full. No Member is entitled to accept only a part/parts of the Conditions. If a Member does not agree to the Conditions, such Member may not use the Services.</ul>
                        <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px">All Members agree to comply with the Conditions and accept that their personal data may be processed in accordance with the Privacy Policy.</ul>
                        <ul class="text-justify" style="font-size: 18px;font-weight:normal">In the event that any Member fails to comply with any of the Conditions, <a href="wecarriers.com">WEcarriers.com</a> reserves the right, but not the obligation at its own discretion, to withdraw the User Account in question and suspend or withdraw all Services to that Member without notice.</ul>
                        <ol><li style="font-weight:bold">Variation of the Conditions, Site and Service
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal;padding-bottom:5px"><a href="wecarriers.com">WEcarriers.com</a> reserves the right to modify the Conditions at any time. In addition, <a href="wecarriers.com">WEcarriers.com</a> may vary or amend the Services provided through the Site, the Site functionality, and/or the “look and feel” of the Site at any time without notice and without liability to Members.</ul>
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal;padding-bottom:5px">Any modification to the Site, Services, or Conditions will take effect as soon as such changes are published on the Site, subject to communication of any material change to the Conditions to the Members in an e-mail.</ul>
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal">Members will be deemed to have accepted any varied Conditions in the event that they use any Services offered through the Site following publication of the varied Conditions. Changes will not apply to any bookings which have been made prior to publication of the varied Conditions.</ul>
                            </li>
                        </ol>
                </li>
                <li>USE OF THE SERVICE
                    <ol>
                         <li style="font-weight:bold">User Account and Accuracy of Information
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal;padding-bottom:5px">In order to use the Services each Member must create a User Account and agree to provide any personal information requested by <a href="wecarriers.com">WEcarriers.com</a>. In particular, Members will be required to provide their first name, last name, age, title, valid telephone number, and email address. Use of the Site is limited to those over the age of 18 years at the time of registration.</ul>
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal;padding-bottom:5px">Members agree and accept that all of the information they provide to <a href="wecarriers.com">WEcarriers.com</a> when setting up their User Account and at any other time shall be true, correct, complete and accurate in all respects. Members also agree that any information supplied to <a href="wecarriers.com">WEcarriers.com</a> or posted on the Site in connection with any Travel will be true, accurate and complete.</ul>
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal;padding-bottom:5px">Members agree and understand that <a href="wecarriers.com">WEcarriers.com</a> does not undertake any verification to confirm the accuracy of any information provided by the Members on the Site or to  WEcarriers or WEsenders, as the case maybe. <a href="wecarriers.com">WEcarriers.com</a> will not be liable to any Member in the event that any information provided by another Member is false, incomplete, inaccurate, misleading or fraudulent. <a href="wecarriers.com">WEcarriers.com</a> can verify members anytime and by any means and if any kind of discrepancy is found against members then it will be liable to take legal action against them.</ul>
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal">Unless expressly agreed by <a href="wecarriers.com">WEcarriers.com</a>, Members are limited to one User Account per Member. No User Account may be created on behalf of or in order to impersonate another person.</ul>
                         </li>
                         <li style="font-weight:bold">No Commercial Activity and Status of <a href="wecarriers.com">WEcarriers.com</a>
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal;padding-bottom:5px">The Site and the Services are strictly limited to providing a Service for WEcarriers to provide their Travel Information to carry the Parcel and WEsenders to provide their Parcel details, in a private capacity. The Services may not be used to offer or accept Travel sharing for hire or reward or for profit or in any commercial or professional context. The Services may be used only to offer or accept Parcel acceptance, sharing and sending in exchange for the cost which is mutually decided by WEcarriers and the WEsender.</ul>
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal;padding-bottom:5px">WEcarriers agree not to obtain any hire or reward in any form, from any Travel. The Service and the Cost Contribution may only be used to discharge the WEcarrier’s costs and may not be used to generate any hiring charges or reward or profit in any form for the WEcarriers. The Parcel must be delivered to WEcarrier by WEsender and Receiver by the WEcarrier, and must be within pre-mentioned time and also if it is getting delayed then it should be properly communicated. This applies to all activities, arrangements and Services booked using the Site and any additional services or activities which may be agreed between WEcarriers and WEsender through the Site.</ul>
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal;padding-bottom:5px">The WEcarriers must not provide any additional services to the WEsender in exchange for hiring charges or any reward or for profit or otherwise (and the WEsender may not accept or ask for any such services) including (without limitation) waiting time, additional drop offs and pick-ups and collecting additional passengers (other than the Parcel).</ul>
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal;padding-bottom:5px">All Travels, collection points and destinations must be pre-agreed through the Site between the WEcarriers and WeEsender. WEcarriers may not collect any Parcel from any location which has not been pre-agreed with the WEsender through the Site.</ul>
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal"><a href="wecarriers.com">WEcarriers.com</a> shall not be in for any loss or damage incurred by a Member as a result of any or breach by a Member of these Conditions including where any WEcarrier (in breach of these terms) offers Services through the Site in a professional or commercial capacity (thereby potentially invalidating their insurance) and breach of any agreement between the WEcarrier and the WEsender. Any offering of Travels in violation of the Conditions shall be at the sole risk of such Member and <a href="wecarriers.com">WEcarriers.com</a> shall have no liability towards Members for such violations.</ul>
                               <ol><li style="font-weight:bold">Status of <a href="wecarriers.com">WEcarriers.com</a>
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal;padding-bottom:5px">Neither <a href="wecarriers.com">WEcarriers.com</a> nor the Site provides any transport services. The Site is a communications platform for Members to transact with one another. <a href="wecarriers.com">WEcarriers.com</a> does not interfere with Travels, destinations or timings. The agreement for Parcel pickups and delivery, charges for Parcel, timings is between the WEcarrier and the WEsender.</ul>
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal;padding-bottom:5px"><a href="wecarriers.com">WEcarriers.com</a> is not a party to any agreement or transaction between Members, nor is <a href="wecarriers.com">WEcarriers.com</a> liable in respect of any matter arising which relates to a booking between Members. <a href="wecarriers.com">WEcarriers.com</a> is not and will not act as an agent for any Member.</ul>
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal">Any breach of these Conditions will give rise to immediate suspension of such Member’s User Account and they may be restricted from accessing any further Services.</ul>
                                   </li>
                               </ol>
                         </li>
                         <li style="font-weight:bold">WEpoints and redemptation policy of WEpoints
                               <ol><li style="font-weight:bold">How and how many points are awarded
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal;padding-bottom:5px">On joining the <a href="wecarriers.com">WEcarriers.com</a>, every user will be given 30 WEpoints.</ul>
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal;padding-bottom:5px">If someone joins by entering your referral code then he/she will be awarded with 60 points as mentioned above and you will be given 30 WEpoints that will be reflected in your account.</ul>
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal">30 WEpoints will be awarded if you successfully complete the review (reviews are done only if you have carried and successfully delivered the parcel as WEcarrier or you have sent any parcel as WEsender) of fellow WEcarrier (if you are WEsender) or WEsender (if you are WEcarrier).</ul>

                                   </li>
                                   <li style="font-weight:bold">Conversion of “WEpoints into Money” policy
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal;padding-bottom:5px">Every 120 WEpoints are equivalent to <i class="fa fa-fw fa-inr"></i>50 .</ul>
                                   </li>
                                   <li style="font-weight:bold">How to redeem the WEpoints
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal;padding-bottom:5px">Once you have at least 120 (One20) WEpoints in your account then only you can redeem those WEpoints.</ul>
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal;padding-bottom:5px">WEpoints will be redeemed only in multiple of 120 WEpoints, like if you have
                                       <ul style="font-size: 14px;font-weight:normal;padding-bottom:5px">< 120 (less than 120) WEpoints can’t be redeemed.</ul>
                                       <ul style="font-size: 14px;font-weight:normal;padding-bottom:5px">120 WEpoints then Max. <i class="fa fa-fw fa-inr"></i>50 will be transferred.</ul>
                                       <ul style="font-size: 14px;font-weight:normal;">150 WEpoints then also <i class="fa fa-fw fa-inr"></i>50 will be transferred and remaining 30 WEpoints will remain in WEpoints.</ul>
                                     </ul>
                                   </li>
                                   <li style="font-weight:bold">Option for Redeeming the WEpoints
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal;padding-bottom:5px">User can choose to have various options for redeeming the WEpoints like,
<ul style="font-size: 14px;font-weight:normal;padding-bottom:5px">Direct transfer to your bank account (for that you have to provide your account details where you want to transfer).</ul>
               <ul style="font-size: 14px;font-weight:normal;padding-bottom:5px">Transfer to your PayTM wallet if you have PayTM wallet activated on your registered mobile number.</ul>
               <ul style="font-size: 14px;font-weight:normal;padding-bottom:5px">Transfer to PayUMoney wallet (you need to provide necessary information for transferring to respective PayUMoney account).</ul>
               <ul style="font-size: 14px;font-weight:normal">Any other options updated time to time.</ul>

                                     </ul>
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal;padding-bottom:5px"><a href="wecarriers.com">WEcarriers.com</a> have rights to change the points and redeem policy time to time whose information will be shared on the site. Any of the above options can be changed or updated any time.</ul>
                                   </li>
                               </ol>
                         </li>
                         <li style="font-weight:bold">Types of Booking and Payment
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal;padding-bottom:5px"><a href="wecarriers.com">WEcarriers.com</a> offers a free service which allows Members to contact each other to arrange a Parcel pickup and delivery.</ul>
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal;padding-bottom:5px"><a href="wecarriers.com">WEcarriers.com</a>’s Service is free of charge. The WEsender will contact the WEcarrier directly to arrange a parcel pickup and delivery to receiver and any conditions related to Parcels (including size of Parcel, Urgency of Parcel, various options related to handing over the Parcel to WEcarriers and Receiver, Cost etc). Members accept that given the nature of the service and the fact that it is free of charge WEcarriers and WEsenders will have no recourse to <a href="wecarriers.com">WEcarriers.com</a> for any aspect of the transaction including in relation to cancellation, last minute changes, failure by the WEcarrier or the WEsender to turn up or non-payment of the Cost Contribution. In particular it is the WEcarrier’s responsibility to collect payment from the WEsender before the time of the Travel.</ul>
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal;padding-bottom:5px"><a href="wecarriers.com">WEcarriers.com</a> will not contact either party and will take no steps whatsoever to manage the booking. The operation of the Travel is solely managed by the respective WEcarrier and WEsender(s).</ul>
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal">Please note that <a href="wecarriers.com">WEcarriers.com</a> reserves the right to change any aspect of the Site or the Service which may include adding new services (which may require payment) or withdrawing any existing Services. <a href="wecarriers.com">WEcarriers.com</a> does not guarantee that the Site will be functional at all times and Services may be suspended during such period when the Site is not in operation. <a href="wecarriers.com">WEcarriers.com</a> will not be liable to any of the Members in case where the Site is non-operational.</ul>
                         </li>
                         <li style="font-weight:bold">WEcarrier and WEsender Obligations
                               <ol><li style="font-weight:bold">WEcarrier\'s obligations
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal;padding-bottom:5px">The Travel shall not be for any fraudulent, unlawful or criminal activity.</ul>
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal;padding-bottom:5px">They will take care and insure for the Parcel just like their other stuff.</ul>
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal;padding-bottom:5px">They will present themselves on time and at the place agreed.</ul>
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal;padding-bottom:5px">They will immediately inform WEsender(s) of any change whatsoever to the Travel. If one or more WEsenders have made a booking and the WEcarrier decides to change any aspect of the Travel, the WEcarrier undertakes to contact all WEsenders who have made a booking in relation to that Travel and to obtain the agreement of all WEsenders to the change. If a WEsender refuses the change, they are entitled to a full refund and without any compensation being paid to the WEcarrier.</ul>
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal;padding-bottom:5px">The WEcarrier must comply with the Good Conduct Charter at all times.</ul>
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal">The WEcarrier must wait for the WEsender at the pickup point for at least 30 minutes after the agreed time (however, the WEsender is expected to be punctual).</ul>
                                   </li>
                                   <li style="font-weight:bold">WEsender\'s obligations
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal;padding-bottom:5px">The Parcel shall not be for any fraudulent, unlawful or criminal activity.</ul>
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal;padding-bottom:5px">The Parcel should not contain which is illegal to ship.</ul>
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal;padding-bottom:5px">They will present themselves on time and at the place agreed with the WEcarrier.</ul>
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal;padding-bottom:5px">They will immediately inform the WEcarrier or <a href="wecarriers.com">WEcarriers.com</a> if they are required to cancel a Travel.</ul>
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal;padding-bottom:5px">They will comply with the Good Conduct Charter at all times.</ul>
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal;padding-bottom:5px">The WEsender agrees to wait at the pickup point for at least 30 minutes after the agreed time for the WEcarriers to arrive (however, the WEcarrier is expected to be punctual).</ul>
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal;padding-bottom:5px">They will pay the Cost Contribution to the WEcarrier.</ul>
                                     <ul class="text-justify" style="font-size: 14px;font-weight:normal">If the WEsender or WEcarrier fail to comply with any of these terms or any other Conditions <a href="wecarriers.com">WEcarriers.com</a> reserves the right to keep information relating to the breach, to publish or disclose this information on the Member’s online profile and to suspend or withdraw the Member’s access to the Site.</ul>

                                   </li>
                               </ol>
                         </li>
                         <li style="font-weight:bold">Insurance
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal"><a href="wecarriers.com">WEcarriers.com</a> gives no warranty or assurance in safety of Parcel and it is the WEcarrier’s responsibility that they safely deliver the Parcel to the Receiver at the pre-decided time and place.</ul>
                         </li>
                         <li style="font-weight:bold">Management of Disputes between Members
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal"><a href="wecarriers.com">WEcarriers.com</a> may at its sole discretion provide its Members with an online service for resolving disputes. This service is non-binding. <a href="wecarriers.com">WEcarriers.com</a> is under no obligation to seek to resolve disputes and this service is offered at <a href="wecarriers.com">WEcarriers.com</a>’s sole discretion and may be withdrawn at any time.</ul>
                         </li>
                         <li style="font-weight:bold">International Travels and International Bookings
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal">Bookings may be made through the Site for international Travels. An International Travel means any Travel which includes any travel outside of India. If a booking is made for an International Travel WEcarriers must ensure that their insurance covers travel outside of India. The WEcarrier must also ensure that all their belongings along with the Parcel compliant with all relevant rules and restrictions applicable in any overseas country.</ul>
                         </li>
                         <li style="font-weight:bold">Verification of Phone Number
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal;padding-bottom:5px">In order to increase trustworthiness, prevent typos and wrong numbers, every Member has to verify their mobile number. The Member needs to do this by providing <a href="wecarriers.com">WEcarriers.com</a> with their mobile phone number, after which the Member will receive an SMS with a verification code which can be validated on the Site.</ul>
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal">This service is free of charge, except for the possible cost levied by a Member’s mobile phone operator for receiving the SMS.</ul>
                         </li>
                    </ol>
                </li>
                <li>DISCLAIMER OF LIABILITY
                        <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px">Members may access the Services on the Site at their own risk and using their best and prudent judgment before entering into any arrangements with other Members through the Site. <a href="wecarriers.com">WEcarriers.com</a> will neither be liable nor responsible for any actions or inactions of Members nor any breach of conditions, representations or warranties by the Members. <a href="wecarriers.com">WEcarriers.com</a> hereby expressly disclaims and any and all responsibility and liability in arising out of the use of the Site.</ul>
                        <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px"><a href="wecarriers.com">WEcarriers.com</a> expressly disclaims any warranties or representations (express or implied) in respect of Travels, accuracy, reliability and completeness of information provided by Members, or the content (including details of the Travel and Cost Contribution) on the Site. While <a href="wecarriers.com">WEcarriers.com</a> will take precautions to avoid inaccuracies in content of the Site, all content and information, are provided on an as is where is basis, without warranty of any kind. <a href="wecarriers.com">WEcarriers.com</a> does not implicitly or explicitly support or endorse any of the Members availing Services from the Site.</ul>
                        <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px"><a href="wecarriers.com">WEcarriers.com</a> is not a party to any agreement between a WEcarrier and WEsender and will not be liable to either the WEcarrier or the WEsender unless the loss or damage incurred arises due to <a href="wecarriers.com">WEcarriers.com</a>’s negligence.</ul>
                        <ol><li style="font-weight:bold"><a href="wecarriers.com">WEcarriers.com</a> shall not be liable for any loss or damage arising as a result of:
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal;padding-bottom:5px">A false, misleading, inaccurate or incomplete information being provided by a Member;</ul>
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal;padding-bottom:5px">The cancellation of a Travel by a WEcarrier or WEsender;</ul>
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal;padding-bottom:5px">Any failure to make payment of a Cost Contribution (for the free service without booking);</ul>
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal;padding-bottom:5px">Any fraud, fraudulent misrepresentation or breach of duty or breach of any of these Conditions by a WEcarrier or WEsender before, during or after a Travel.</ul>
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal;padding-bottom:5px"><a href="wecarriers.com">WEcarriers.com</a> will not be liable to any Member for any business, financial or economic loss or for any consequential or indirect loss such as lost reputation, lost bargain, lost profit, lost of anticipated savings or lost opportunity arising as a result of the services provided by <a href="wecarriers.com">WEcarriers.com</a> (whether suffered or incurred as a result of the <a href="wecarriers.com">WEcarriers.com</a>’s negligence or otherwise) except in the case of fraud, wilful concealment or theft.</ul>
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal;padding-bottom:5px"><a href="wecarriers.com">WEcarriers.com</a>’s liability to any WEsender for all losses in respect of any Travel is capped at the sum of INR 500/- (Indian Rupees Five Hundred only) or cost of the parcel, whichever is lesser. If WEcarrier is found guilty by <a href="wecarriers.com">WEcarriers.com</a>’s investigating team for those losses then WEcarrier has to face financial penalty or discontinuation from the <a href="wecarriers.com">WEcarriers.com</a> or both.</ul>
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal;padding-bottom:5px"><a href="wecarriers.com">WEcarriers.com</a> will not be liable to any Member in relation to any Travel unless <a href="wecarriers.com">WEcarriers.com</a> is notified of a claim relating to that Travel within 3 Days of completion of the Delivery to the Receiver or completion of scheduled Delivery time.</ul>
                               <ul class="text-justify" style="font-size: 16px;font-weight:normal;padding-bottom:5px"><a href="wecarriers.com">WEcarriers.com</a>’s service is limited to putting WEcarriers and WEsenders in touch with each other and cannot oversee any Travel, Members accept that the limitations on the <a href="wecarriers.com">WEcarriers.com</a>’s liability set out above are reasonable.</ul>
                            </li>
                        </ol>
                </li>
                <li>INDEMNITY AND RELEASE
                            <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px">Members will indemnify and hold harmless <a href="wecarriers.com">WEcarriers.com</a>, its subsidiaries, affiliates and their respective officers, directors, agents and employees, from any claim or demand, or actions including reasonable attorney\'s fees, made by any third party or penalty imposed due to or arising out of your breach of these Conditions or any document incorporated by reference, or your violation of any law, rules, regulations or the rights of a third party.</ul>
                            <ul class="text-justify" style="font-size: 18px;font-weight:normal">Members release <a href="wecarriers.com">WEcarriers.com</a> and/or its affiliates and/or any of its officers and representatives from any cost, damage, liability or other consequence of any of the actions/inactions of the Members and specifically waiver any claims or demands that they may have in this behalf under any statute, contract or otherwise.</ul> 
                </li>
                <li>GENERAL TERMS
                    <ol><li style="font-weight:bold">Relationship
                            <ul class="text-justify" style="font-size: 16px;font-weight:normal">No arrangement between the Members and <a href="wecarriers.com">WEcarriers.com</a> shall constitute or be deemed to constitute an agency, partnership, joint venture or the like between the Members and <a href="wecarriers.com">WEcarriers.com</a>.</ul>
                        </li>
                        <li style="font-weight:bold">Suspension or Withdrawal of Site Access
                            <ul class="text-justify" style="font-size: 16px;font-weight:normal">In the event of non-compliance on your part with all or some of the Conditions, you acknowledge and accept that <a href="wecarriers.com">WEcarriers.com</a> can at any time, without prior notification, interrupt or suspend, temporarily or permanently, all or part of the service or your access to the Site (including in particular your User Account).</ul>
                        </li>
                        <li style="font-weight:bold">Content of the Site Provided by the Members
                            <ul class="text-justify" style="font-size: 16px;font-weight:normal">Members of this Site are expressly asked not to publish any defamatory, misleading or offensive content or any content which infringes any other persons intellectual property rights (e.g. copyright). Any such content which is contrary to <a href="wecarriers.com">WEcarriers.com</a>’s policy and <a href="wecarriers.com">WEcarriers.com</a> does not accept liability in respect of such content, and the Member responsible will be personally liable for any damage or other liability arising and agrees to indemnify <a href="wecarriers.com">WEcarriers.com</a> in relation to any liability it may suffer as a result of any such content. However as soon as <a href="wecarriers.com">WEcarriers.com</a> becomes aware of infringing content, <a href="wecarriers.com">WEcarriers.com</a> shall do everything it can to remove such content from the Site as soon as possible.</ul>
                        </li>
                        <li style="font-weight:bold">Partner Sites
                            <ul class="text-justify" style="font-size: 16px;font-weight:normal;padding-bottom:5px"><a href="wecarriers.com">WEcarriers.com</a> reserves the right to reproduce any information that appears on the Site or on the partner sites.</ul>
                            <ul class="text-justify" style="font-size: 16px;font-weight:normal">In particular, ads published on one of the sites maintained or co-maintained by <a href="wecarriers.com">WEcarriers.com</a> may be reproduced on other sites maintained or co-maintained by <a href="wecarriers.com">WEcarriers.com</a> or third parties.</ul>
                        </li>
                    </ol>
                </li>
                <li>LAW AND JURISDICTION
                            <ul class="text-justify" style="font-size: 18px;font-weight:normal">These terms shall be governed by the law of India and any disputes arising in relation to these terms shall be subject to the jurisdiction of the Courts of Mumbai/Pune.</ul>
                </li>
                <li>BY USING THE APPLICATION OR THE SERVICE, YOU FURTHER AGREE THAT:
                            <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px">You will comply with all applicable law from your home nation, the country, state and/or city in which you are present while using the Application or Service.</ul>
                            <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px">You will not authorize others to use your account;</ul>
                            <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px">You will not assign or otherwise transfer your account to any other person or legal entity;</ul>
                            <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px">You will not use an account that is subject to any rights of a person other than you without appropriate authorization;</ul>
                            <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px">You will not use the Service or Application for unlawful purposes, including but not limited to sending or storing any unlawful material or for fraudulent purposes;</ul>
                            <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px">You will not use the Service or Application to cause nuisance, annoyance or inconvenience;</ul>
                            <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px">You will not impair the proper operation of the network;</ul>
                            <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px">You will not try to harm the Service or Application in any way whatsoever;</ul>
                            <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px">You will not copy, or distribute the Application or other <a href="wecarriers.com">WEcarriers.com</a> Content without written permission from <a href="wecarriers.com">WEcarriers.com</a>;</ul>
                            <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px">You will keep secure and confidential your account password or any identification we provide you which allows access to the Service and the Application;</ul>
                            <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px">You will provide us with whatever proof of identity we may reasonably request;</ul>
                            <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px">You will only use an access point or 2G, 3G, 4G data account (AP) which you are authorized to use;</ul>
                            <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px">You will not use the Service or Application with an incompatible or unauthorized device;</ul>
                            <ul class="text-justify" style="font-size: 18px;font-weight:normal">You will only use the Service or download the Application for your sole, personal use and will not resell it to a third party;</ul>
                </li>
                <li>ONLINE STORE TERMS
                            <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px">By agreeing to these Terms of Service, you represent that you are at least the age of majority in your state or province of residence, or that you are the age of majority in your state or province of residence and you have given us your consent to allow any of your minor dependents to use this site</ul>
                            <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px">You may not use our products for any illegal or unauthorized purpose nor may you, in the use of the Service, violate any laws in your jurisdiction (including but not limited to copyright laws).</ul>
                            <ul class="text-justify" style="font-size: 18px;font-weight:normal;padding-bottom:5px">You must not transmit any worms or viruses or any code of a destructive nature.</ul>
                            <ul class="text-justify" style="font-size: 18px;font-weight:normal">A breach or violation of any of the Terms will result in an immediate termination of your Services and legal actions against you.</ul>                 
                </li>
                <li>CONTACT INFORMATION
                            <ul class="text-justify" style="font-size: 18px;font-weight:normal">Questions about the Terms of Service should be sent to us at <a>support@wecarriers.com</a></ul>
                </li>
        </ol>
	</div>';

echo ' </div>';
echo '</div>';
showFooter();
loadLaterJSFiles();

echo '  </body>';
echo '</html>';

?>
