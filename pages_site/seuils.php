<!doctype html>
<html lang="fr">
	<head>
	
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">>

	</head>
	
	<body>
	
	<!-- Liste déroulante choix de la race-->
			<div class="container">	
		<div class="row">
			<div id="block1" class="col-md-3 offset-md-4" align='center' >
				<FORM action="type_utilisateur.php" method="POST" name="form">
					<div class="form-group">
					<label for="id_utilisateur_selection">Choisissez la race</label>
						<select class="form-control" name="id_utilisateur_selection" id="id_utilisateur_selection">
							</select>
					</div>
					
	<!-- Saisie de texte seuil max-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="textinput">Seuil maximal</label> 
		  <label class="col-md-4 control-label" for="textinput">Seuil minimal</label> 
		  <div class="col-md-4">
			<input id="textinput" name="textinput" type="text" placeholder="" class="form-control input-md">
			<input id="textinput" name="textinput" type="text" placeholder="" class="form-control input-md">
			<span class="help-block"></span>  
		  </div>
		</div>
		
		<!-- Saisie de texte seuil min-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="textinput">Seuil minimal</label> 
		  <div class="col-md-4">
			<input id="textinput" name="textinput" type="text" placeholder="" class="form-control input-md">
			<span class="help-block"></span>  
		  </div>
		</div>


zizi



	</body>
	
	
</html>