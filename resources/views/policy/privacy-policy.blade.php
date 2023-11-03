<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} | {{ __('Privacy Policy') }}</title>
</head>
<body>
    
</body>
</html>

<h1>Privacy Policy for {{config('policy-information.company-name')}}</h1>

<p>At Frozen Aircond, accessible from {{ env("APP_URL") }}, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by Frozen Aircond and how we use it.</p>

<p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</p>

<p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in Frozen Aircond. This policy is not applicable to any information collected offline or via channels other than this website.</p>

<h2>Consent</h2>

<p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>

<h2>Information we collect</h2>

<p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</p>
<p>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</p>
<p>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.</p>

<h2>How we use your information</h2>

<p>We use the information we collect in various ways, including to:</p>

<ul>
    <li>Provide, operate, and maintain our website</li>
    <li>Improve, personalize, and expand our website</li>
    <li>Understand and analyze how you use our website</li>
    <li>Develop new products, services, features, and functionality</li>
    <li>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes</li>
    <li>Send you emails</li>
    <li>Find and prevent fraud</li>
</ul>

<h2>Log Files</h2>

<p>Frozen Aircond follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users' movement on the website, and gathering demographic information.</p>

<h2>Cookies and Web Beacons</h2>

<p>Like any other website, Frozen Aircond uses "cookies". These cookies are used to store information including visitors' preferences, and the pages on the website that the visitor accessed or visited. The information is used to optimize the users' experience by customizing our web page content based on visitors' browser type and/or other information.</p>



<h2>Advertising Partners Privacy Policies</h2>

<P>You may consult this list to find the Privacy Policy for each of the advertising partners of Frozen Aircond.</p>

<p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on Frozen Aircond, which are sent directly to users' browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.</p>

<p>Note that Frozen Aircond has no access to or control over these cookies that are used by third-party advertisers.</p>

<h2>Third Party Privacy Policies</h2>

<p>Frozen Aircond's Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options. </p>

<p>You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers' respective websites.</p>

<h2>Changes to This Privacy Policy</h2>

<p>We may update our Privacy Policy from time to time. Thus, we advise you to review this page periodically for any changes. We will notify you of any changes by posting the new Privacy Policy on this page. These changes are effective immediately, after they are posted on this page.</p>

<h2>Contact Us</h2>

<p>If you have any questions or suggestions about our Privacy Policy, do not hesitate to contact us.</p>

<div class="statement">
    <p><b>Create At:</b> {{config('policy-information.policy-crete')}}</p>
    <p><b>Update At:</b> {{config('policy-information.policy-update')}}</p>
    <p><b>Current Version:</b> {{config('policy-information.policy-version')}}</p>
</div>

<style>
    body{
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 3rem 4rem
    }

    h2 ~ p{
        padding: 0 2rem;
    }

    ul{
        padding: 0 3.2rem;
        display: flex;
        flex-direction: column;
        row-gap: .4rem;
    }

    div.statement{
        display: flex;
        justify-content: space-between;
        background-color: rgb(213, 213, 213);
        border-radius: 6px;
        margin-top: 3rem;
        padding: .2rem 2rem;
    }

    /* h1{
        margin: 0
    }

    h4{
        text-decoration: underline;
    }

    h5.latest-update-date{
        color: #555;
        margin: 0;
    }

    ul{
        display: flex;
        flex-direction: column;
        row-gap: .4rem;
        list-style: none;
    }

    a{
        color: blue;
        text-decoration: none;
    }

    a:hover{
        color: rgb(0, 0, 91);
    }

    h3.section-title{
        font-weight: bold;
    }

    div.section-body{
        padding: 0 3rem .4rem;
    } */
</style>
