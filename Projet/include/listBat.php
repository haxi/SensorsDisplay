<?php
	include "bdd.php";
	$resultats=$connection->query("	SELECT idBatiment, batiment.nom, adresse, cp, ville, count(idPiece) as nbPiece
														FROM batiment, piece 
														WHERE Batiment_idBatiment = idBatiment
															UNION
														SELECT idBatiment, batiment.nom, adresse, cp, ville, 0 FROM batiment
														WHERE idBatiment NOT IN (	SELECT DISTINCT Batiment_idBatiment 
																					FROM piece
																				);
														");
	$resultats->setFetchMode(PDO::FETCH_OBJ);
	while( $resultat = $resultats->fetch() )
	{
			echo	'<tr>
						<td>'.$resultat->nom.'</td>
						<td>'.$resultat->adresse.'</td>
						<td>'.$resultat->cp.'</td>
						<td>'.$resultat->ville.'</td>
						<td>'.$resultat->nbPiece.'</td>
						<td><a href="#"><span class="glyphicon glyphicon-remove" style="margin-right:15px;" onClick="removeBat('.$resultat->idBatiment.')"></a><a href="#"></span><span class="glyphicon glyphicon-wrench"></span></a></td>
					</tr>';
	}
	$resultats->closeCursor(); 
?>