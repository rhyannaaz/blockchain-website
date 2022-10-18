<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="description" content="Enhancements" />
	<meta name="keywords"    content="enhancements, blockchain, explanation, html, css" />
	<meta name="author"      content="Rhyanna Arisya" />
	<title>Enhancements | Blockchain</title>
	<link href="images/blockchain.png" rel="icon" type="image/gif" sizes="16x16" />
	<link href="styles/style.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" /> 
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />
</head>
<body>
	<header class="menu">
        <h1><a href="index.html" class="index" title="Blockchain"><img src="images/blockchain.png" id="blockchainlogo" alt="blockchain logo"> BLOCKCHAIN</a></h1>
    </header>

    <nav class="topright">
        <a href="index.html" id="home">HOME</a> 
        <a href="topic.html" id="topic">TOPIC</a> 
        <a href="quiz.html" id="quiz">QUIZ</a>
    </nav>

    <section>
    	<h2>1. The use of png icon in the tab of the website</h2>
    	<p>The use of rel="icon" imports an icon to represent the html document. This feature caters more towards users, allowing them to familiarize themselves with the png icon in the tab to the website so they could identify or navigate to the website especially when users have multiple tabs on their browser. This is located in the &lt;head&gt; of a html.<br>Codes needed:<br><a href="index.html">&lt;link href="images/blockchain.png" rel="icon" type="image/gif" sizes="16x16"&gt;</a></p>
    </section>

    <section>
    	<h2>2. Main navigation menu</h2>
    	<p>This is to ensure that user is able to navigate to other pages. With the navigation menu being in every page, users could navigate easily and efficiently within the website without the need to go back to the homepage to access another page. Once user clicks one of the pages, the font becomes bold indicating that they are in the named page. This is located in the &lt;body&gt; of a html.<br>Codes needed:<br><a href="index.html">&lt;nav class="topright"&gt;<br>
    	&lt;a href="index.html" id="home"&gt;&lt;strong&gt;HOME&lt;/strong&gt;&lt;/a&gt; <br>
        &lt;a href="topic.html" id="topic"&gt;TOPIC&lt;/a&gt;<br>
        &lt;a href="quiz.html" id="quiz"&gt;QUIZ&lt;/a&gt;<br>
        &lt;/nav&gt;</a></p>
    </section>

    <section>
    	<h2>3. Linking font families into html</h2>
    	<p>The use of different font families allows the customization of the webpage to look neat and clean. Ensuring that the font family chosen is simple and practical, the website would be easy on the eyes. This is located in the &lt;head&gt; of a html.<br>Codes needed:<br><a href="topic.html">&lt;link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet"&gt;<br>&lt;link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"&gt;</a></p>
    </section>

    <section>
    	<h2>4. Side navigation menu</h2>
    	<p>This is to navigate through the page easier without having trouble of searching a particular section of the page by continously scrolling back and forth or having to identify where it is manually. This is located in the &lt;body&gt; of a html.<br>Codes needed:<br><a href="topic.html">&lt;nav class="sidenav"&gt;<br>
        &lt;a href="#basics"&gt;BLOCKCHAIN BASICS&lt;/a&gt;<br>
        &lt;a href="#history"&gt;BLOCKCHAIN HISTORYv/a&gt;<br>
        &lt;a href="#growth"&gt;BLOCKCHAIN GROWTH&lt;/a&gt;<br>
        &lt;a href="#future"&gt;FUTURE OF BLOCKCHAIN&lt;/a&gt;<br>
        &lt;a href="#relatedtech"&gt;RELATED TECHNOLOGIES&lt;/a&gt;<br>
        &lt;/nav&gt;</a></p>
    </section>

    <section>
    	<h2>5. CSS text underline hover effect</h2>
    	<p>This is to indicate that the text is clickable and navigates user to another page. This draws user's attention of an interactive website that is easy to use. Once user hovers on the text, the underline effect would take place starting from the center of the text until both ends of the text. This is implemented for the email hyperlink in the footer and the main navigation menu.<br>Codes needed:<br>
        <a href="topic.html#email">.email {<br>
        font-size: 14px;<br>
        font-family: 'Montserrat', sans-serif;<br>
        font-weight: 600;<br>
        text-decoration: none;<br>
        display: inline-block;<br>
        position: relative;<br>
        }<br>
        <br>
        .email:after {<br>
	    content: '';<br>
	    position: absolute;<br>
	    left: 0;<br>
	    display: inline-block;<br>
        height: 1em;<br>
        width: 100%;<br>
        border-bottom: 1px solid;<br>
        margin-top: 5px;<br>
        opacity: 0;<br>
	    transition: opacity 0.35s, transform 0.35s;<br>
	    transform: scale(0,1);<br>
        }<br>
        <br>
        .email:hover:after {<br>
    	opacity: 1;<br>
    	transform: scale(1);<br>
    	transform: scale(1);<br>
        }</a></p>
    </section>

    <footer>
        <a href="mailto:J21034577@student.newinti.edu.my" id="email" class="email" title="Drop me an email!">Rhyanna Arisya</a>
    </footer>
</body>
</html>