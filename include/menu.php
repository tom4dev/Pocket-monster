<?php

/*
Menu Navbar.
Thomas BRODUSCH
Test Stagiaire - SOIXANTECIRCUITS
Mars 2013
*/

echo'
<!-- Navbar 
================================================== -->
 <div class="navbar navbar-fixed-top">
   <div class="navbar-inner">
     <div class="container">
       <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </a>
       <a class="brand" href="index.php">PocketMonster</a>
       <div class="nav-collapse collapse" id="main-menu">
        <ul class="nav" id="main-menu-left">
          <li><a href="addMonster.php">Ajouter Monstre</a></li>
          <li><a id="swatch-link" href="addFamily.php">Ajouter famille</a></li>
	<li><a id="swatch-link" href="addWorld.php">Ajouter Monde</a></li>
          
            </ul>
          </li>
        </ul>
       
       </div>
     </div>
   </div>
 </div>

';
?>
