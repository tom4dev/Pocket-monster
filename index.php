<!--
Index
Thomas BRODUSCH
Test Stagiaire - SOIXANTECIRCUITS
Mars 2013
-->
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>PocketMonster: SoixanteCircuit challenge</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PocketMonster">
    <meta name="author" content="Thomas Brodusch">

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link href="css/bootstrap.min.css" rel="stylesheet">
    

  </head>

  <body class="preview" id="top" data-spy="scroll" data-target=".subnav" data-offset="80">
    


<?php include('include/menu.php'); ?>

   <div class="container">
	<header class="jumbotron subhead" id="overview">
	<br/><br/><hr />
  	<div class="row">
    		<p>Git repo (master) by <a href="https://github.com/soixantecircuits/Pocket-monster">igab</a></p>

		<p>
		<h4>#Description</h4>

This little php application allow you to create :<br/>
	- a monster,<br/>
	- a family,<br/>
	- a world<br/><br/>

A monster has :<br/>
	- a name,<br/>
	- a family which depends on the family named before,<br/>
	- a photo (that the user can upload via a form),<br/>
	- a default photo if the user does not upload a photo,<br/>
	- some settings of your choice (hair colors, skin type, blood type, teeth, etc...)<br/><br/>
	
A family has :<br/>
	- a name,<br/>
	- they belong to a word,<br/>
	- they have a photo that we can add (same as for monsters)<br/>
	- they have a maximum number<br/><br/>

A world has :<br/>
	- a name,<br/>
	- multiple family,<br/>
	- an image that you will show to the user as a background<br/><br/>
	

In the admin panel, I or any user should be able to :<br/>

	- add a monster, give him a name, a family, a photo, and some settings of your choice (think it as checkbox ?)<br/>
	- add a family with the description I've made before. This family should be present in the family choice for the monster<br/>
	- add a world where we can put families, a name for this world and an image has background<br/><br/>
	
In the front (what the user see) you should have :<br/>
	- a page to select a world<br/>
	- a world page that fetch all the families and thus the monsters and bring them to the user grouped by families.<br/>
	- clicking on a monster allow the user to see detailed information about his family, his world, and his settings.<br/><br/>
	
	
This could seems complicated but most of the work should have already be seen in classroom. For photo upload you can look and search about file upload, on "le site du zero" or on github.
Idea is not to make the whole app but to go as far as possible with each of the module you deliver, and should be complet.

	</p>
<p>
<h4>#Workflow</h4>

You will use git as version control.

You should first FORK (see the fork button on this webpage : https://github.com/gabrielstuff/Pocket-monster)

This means you will follow this step to get the repository.
http://help.github.com/win-set-up-git/ (available also for Mac, and Linux)

And you should :
git add -A
git commit -am "i just create a class"
git push

Once you finished you have to make a pull request in order for me to get your code.

Actually all of this step ar fairly explain in the github website and you should be able to understand them.

Thank you
</p>	





	</div>
	<hr />
</div>

<br><br><br><br>

     <!-- Footer
      ================================================== -->
      <hr>

      <footer id="footer">
        <p class="pull-right"><a href="#top">Back to top</a></p>
        <div class="links">
          
        </div>
        Made by <a href="http://www.twitter.com/thomasbrd">Thomas Brodusch</a>. <br/>
        Code licensed under the <a href="http://www.apache.org/licenses/LICENSE-2.0">Apache License v2.0</a>.<br/>
        Based on <a href="http://twitter.github.com/bootstrap/">Bootstrap</a>. Hosted on <a href="http://tom4dev.github.com/">GitHub</a>. Icons from <a href="http://fortawesome.github.com/Font-Awesome/">Font Awesome</a>. Web fonts from <a href="http://www.google.com/webfonts">Google</a>. </p>
      </footer>

  



    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 

  </body>
</html>
