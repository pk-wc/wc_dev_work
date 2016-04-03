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
getPageTitle("Privacy");
loadCSSFiles();
loadJSFiles();
echo ' 
<style>
	   #privacy OL { counter-reset: item;list-style:none;
    padding-left:0;  }
	   #privacy li { font-size: 20px;font-weight:bold }
	   #privacy li li { font-size: 18px;font-weight:normal }
	   #privacy li li li { font-size: 16px;font-weight:normal }
	   #privacy LI { display: block }
	   #privacy LI:before { content: counters(item, ".") ". "; counter-increment: item }
	</style>
';
echo '  </head>';
echo '  <body>';

showHeader("privacy");
loadLoginModal();
echo ' <div id="content">';
echo '	<div class="container">';
checkPageMessages();
echo '  </div>';

echo ' <div class="container">';

echo '  <div id="privacy"><h1 style="text-align:center">PRIVACY AND DATA PROTECTION POLICY</h1>
	<ol>
		<li>General
			<ol>
				<li class="text-justify"><a href="wecarriers.com">WEcarriers.com</a> (“we” or “us”) take the privacy of your information very seriously. Our Privacy Policy is designed to tell you about our practices regarding the collection, use and disclosure of information that you may provide via the <a href="wecarriers.com">WEcarriers.com</a> website and other associated partner sites, microsites and sub-sites (the “Site”).</li>
				<li class="text-justify">By using this Site or any services we offer, you are consenting to the collection, use, and disclosure of that information about you in accordance with, and are agreeing to be bound by, this Privacy Policy.</li>
			</ol>
		</li>
			<li>Ways that we collect information
				<ol>
					<li class="text-justify">We may collect and process the following information or data (including personal information and information that can be uniquely identified with you) about you:
						<ol>
							<li class="text-justify">Passport, PAN card, AADHAR card, Voter Id card and such other documents and information that may be required from time to time including your name, different addresses (including postcodes) to register with the Site or to access other services provided by us;</li>
							<li class="text-justify">Your e-mail address and a password;</li>
							<li class="text-justify">Mobile phone numbers provided by you on site;</li>
							<li class="text-justify">A record of any correspondence between you and us;</li>
							<li class="text-justify">A record of any bookings you have made or advertisements you have placed with or through the Site;</li>
							<li class="text-justify">Your replies to any surveys or questionnaires that we may use for research purposes;</li>
							<li class="text-justify">Details of accounting or financial transactions including transactions carried out through the Site or otherwise. This may include information such as your credit card, debit card or bank account details, details of Journeys (as described in our Conditions) you have offered through the Site;</li>
							<li class="text-justify">Details of your visits to the Site and the resources that you access;</li>
							<li class="text-justify">Information we may require from you when you report a problem with the Site.</li>
							<li class="text-justify">Information about you which we may receive from other sources.</li>
							<li class="text-justify">Details of parcels (as described in our Conditions), information about receiver.</li>
							
						</ol>
					</li>
					<li class="text-justify">We only collect such information when you choose to supply it to us. You do not have to supply any personal information to us but you may not be able to take advantage of all the services we offer without doing so.</li>
					<li class="text-justify">Information is also gathered without you actively providing it, through the use of various technologies and methods such as Internet Protocol (IP) addresses and cookies. These methods do not collect or store personal information.</li>
					<li class="text-justify">An IP address is a number assigned to your computer by your Internet Service Provider (ISP), so you can access the Internet. It is generally considered to be non-personally identifiable information, because in most cases an IP address can only be traced back to your ISP or the large company or organisation that provides your internet access (such as your employer if you are at work).</li>
					<li class="text-justify">We use your IP address to diagnose problems with our server, report aggregate information, and determine the fastest route for your computer to use in connecting to our site, and to administer and improve the site.</li>
				</ol>
			<li class="text-justify">Use
				<ol>
					<li>We may use this information to:
						<ol>
							<li class="text-justify">ensure that the content of the Site is presented in the most effective manner for you and for your computer and customise the Site to your preferences;</li>
							<li class="text-justify">assist in making general improvements to the Site;</li>
							<li class="text-justify">carry out and administer any obligations arising from any agreements entered into between you and us;</li>
							<li class="text-justify">allow you to participate in features of the Site and other services;</li>
							<li class="text-justify">contact you and notify you about changes to the Site or the services we offer (except where you have asked us not to do this);</li>
							<li class="text-justify">collect payments from you;</li>
							<li class="text-justify">analyse how users are making use of the Site and for internal marketing and research purposes.</li>
						</ol>
					</li>
					<li>We will not resell your information to any third party nor use it for any third party marketing.</li>
				</ol>
			</li>
			<li>Sharing your information
				<ol>
					<li class="text-justify">If we charge you any fees or collect any money from you in relation to any services on the Site, including any sponsorship money, credit or debit card payments will be collected by our payment processor.</li>
					<li class="text-justify">In order for payments to be processed you may need to provide some necessary details to our payment processor. We will tell you about this at the point we collect that information.</li>
					<li class="text-justify">
						<ol>
							<li class="text-justify">As part of our booking process and in order to provide our services information may be passed to a WEsender (if you are a WEcarrier) or to a WEcarrier (if you are a WEsender).</li>
							<li class="text-justify">If we are under a duty to disclose or share your personal data in order to comply with any legal obligation (for example, if required to do so by a court order or for the purposes of prevention of fraud or other crime or upon requisition made by government agencies);</li>
							<li class="text-justify">in order to enforce any terms of use that apply to any of the Site, or to enforce any other terms and conditions or agreements for our Services that may apply;</li>
							<li class="text-justify">we may transfer your personal information to a third party as part of a sale of some or all of our business and assets to any third party or as part of any business restructuring or reorganisation, but we will take steps with the aim of ensuring that your privacy rights continue to be protected;</li>
							<li class="text-justify">to protect the rights, property, or safety, the Site’s users, or any other third parties. This includes exchanging information with other companies and organisations for the purposes of fraud protection and credit risk reduction.</li>
							<li class="text-justify">for the purpose of verification by third party service providers of the information contained in the IDs and other documents that may be collected from the Members at the time of registration or at any other time during their use of the Site as may be required. Third party service providers will process data under WEcarriers’ control and will be bound by the same degree of security and care as WEcarriers’ under this Privacy and Data Protection Policy.</li>
							<li class="text-justify">Notwithstanding anything contained herein or the terms & conditions, WEcarriers hereby disclaims any liability arising from the verification of the IDs and other documents by third party service providers including but not limited to its accuracy, reliability, and originality;</li>
							<li class="text-justify">for the purpose of maintaining internal quality, training and updating the customers about the Services of WEcarriers.</li>
						</ol>
					</li>
					<li class="text-justify">Other than as set out above, we shall not disclose any of your personal information unless you give us permission to do so.</li>
				</ol>
			</li>
			<li>Cookies
				<ol>
					<li class="text-justify">A cookie is a piece of data stored locally on your computer and contains information about your activities on the Internet. The information in a cookie does not contain any personally identifiable information you submit to our site.</li>
					<li class="text-justify">On the Site, we use cookies to track users\' progress through the Site, allowing us to make improvements based on usage data. We also use cookies if you log in to one of our online services to enable you to remain logged in to that service. A cookie helps you get the best out of the Site and helps us to provide you with a more customised service.</li>
					<li class="text-justify">Once you close your browser, our access to the cookie terminates. You have the ability to accept or decline cookies. Most web browsers automatically accept cookies, but you can usually modify your browser setting to decline cookies if you prefer. To change your browser settings you should go to your advanced preferences.</li>
					<li class="text-justify">We have a clear cookies notice on the home page of the website. If you continue to use the Site having seen the notice then we assume you are happy for us to use the cookies described above.</li>
					<li class="text-justify">If you choose not to accept the cookies, this will not affect your access to the majority of information available on the Site. However, you will not be able to make full use of our online services.</li>
				</ol>
			</li>
			<li>Access to and correction of personal information
				<ol>
					<li class="text-justify">We will take all reasonable steps in accordance with our legal obligations to update or correct personally identifiable information in our possession that you submit via this Site.</li>
					<li class="text-justify">The Act gives you the right to access information held about you. Your right of access can be exercised in accordance with the Act. Any access request may be subject to a suitable and reasonable fee to meet our costs in providing you with details of the information we hold about you. If you wish to see details of any personal information that we hold about you please contact us by way of our contact page.</li>
					<li class="text-justify">We take all appropriate steps to protect your personally identifiable information as you transmit your information from your computer/Mobile to our Site and to protect such information for loss, misuse, and unauthorised access, disclosure, alteration, or destruction. We use leading technologies and encryption software to safeguard your data, and operate strict security standards to prevent any unauthorised access to it.</li>
					<li class="text-justify">Where you use passwords, usernames, or other special access features on this site, you also have a responsibility to take reasonable steps to safeguard them.</li>
				</ol>
			</li>
			<li>Other websites
				<ol>
					<li class="text-justify">This Site may contain links and references to other websites. Please be aware that this Privacy Policy does not apply to those websites.</li>
					<li class="text-justify">We cannot be responsible for the privacy policies and practices of sites that are not operated by us, even if you access them via the Site. We recommend that you check the policy of each site you visit and contact its owner or operator if you have any concerns or questions.</li>
					<li class="text-justify">In addition, if you came to this Site via a third party site, we cannot be responsible for the privacy policies and practices of the owners or operators of that third party site and recommend that you check the policy of that third party site and contact its owner or operator if you have any concerns or questions.</li>
				</ol>
			</li>
			<li>Transferring your information outside of India
				<ol>
					<li class="text-justify">As part of the services offered to you through the Site, the information you provide to us may be transferred to, and stored at, countries outside of India. By way of example, this may happen if any of our servers are from time to time located in a country outside of India or one of our service providers is located in a country outside of India. We may also share information with other equivalent national bodies, which may be located in countries worldwide. The information provided by you may be transferred to a third party if it is necessary for the performance of any contract between us and the said third party or upon receipt of your consent to data transfer. If we transfer your information outside of India in this way, we will take steps with the aim of ensuring that your privacy rights continue to be protected as outlined in this privacy policy and in accordance with applicable laws including but not limited to Information Technology Act, 2000 and the rules framed thereunder.</li>
					<li class="text-justify">If you use the Site while you are outside India, your information may be transferred outside India in order to provide you with those services.</li>
					<li class="text-justify">By submitting your personal information to us you agree to the transfer, storing or processing of your information outside India in the manner described above.</li>
				</ol>
			</li>
			<li>Notification of changes to our Privacy Policy
			<ul class="text-justify" style="font-size: 18px;font-weight:normal">We will post details of any changes to our Privacy Policy on the Site to help ensure you are always aware of the information we collect, how we use it, and in what circumstances, if any, we share it with other parties.</ul>
			</li>
			<li>Contact us
			<ul class="text-justify" style="font-size: 18px;font-weight:normal">If at any time you would like to contact us with your views about our privacy practices, or with any enquiry relating to your personal information, you can do so by way of our “contact us” page.</ul>
			</li>
			
	</ol>	
	</div>
	
	
     ';
	
echo '  </div>';
echo ' </div>';
showFooter();
loadLaterJSFiles();

echo '  </body>';
echo '</html>';

?>


