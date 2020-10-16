<html lang="en">
<head>
  <title>Validar formulari</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

<?php

  error_reporting(E_ALL);
  ini_set('display_errors', 1);

 // Amb include el codi del fitxer funcionsValidacio.php s'incrusta aquí!
  include 'funcionsValidacio.php';
  
  // Valors per defecte dels controls del formulari
  $nom="";
  $quantitat="";
  $password="";
  $descripcio="";
  $opcio1="";  
  $excursio="";
  $estudis=array("ESO");
  $inclou=array(1,2);
  
  $errors=array();
  
  if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
         
    // Caixa de text nom
    $nom = validarString('nom',$errors,25,true);          
    // Caixa de text quantitat
    $quantitat = validarInteger('quantitat',$errors,1,10,true);
    // Caixa password      
    $password = validarString('password',$errors,15,true);     
     // Caixa ocult
    $ocult = validarString('ocult',$errors,100,true);
    // Area de text      
    $descripcio = validarString('descripcio',$errors,50,false);        
    // Radio
    $opcions=array("cereals","iogurt","magdalena");
    $opcio1=validarOpcions('opcio1',$errors,$opcions,false);
    // checkbox
    $valors=array("ESO","BAT","CFGM");
    $estudis=validarOpcionsMultiples('estudis',$errors,$valors,false);
    // llista seleccio 1 element 
    $opcions=array("Mallorca","Girona","Sevilla");
    $excursio=validarOpcions('excursio',$errors,$opcions,true);      
    // llista seleccio multiple
    $opcions=array(1,2,3,4);
    $inclou=validarOpcionsMultiples('inclou',$errors,$opcions,true);
    
    if(count($errors)==0) { // Cap Error
         
        echo "TOT CORRECTE!!!!";
        echo '<table class="table">';
        echo '   <thead class="thead-dark">';
        echo '      <tr>';
        echo '           <th>Camp</th>';
        echo '          <th>Valor</th>';
        echo '     </tr>';
        echo '   </thead>';
        echo '   <tbody>';
            
        echo "<tr><td>Nom</td><td>".$nom."</td></tr>";
    echo "<tr><td>Quantitat</td><td>".$quantitat."</td></tr>";
        echo "<tr><td>Password</td><td>".$password."</td></tr>";
        echo "<tr><td>Descripcio</td><td>".$descripcio."</td></tr>";
        
    echo "<tr><td>Estudis</td><td>";       
        foreach($estudis as $element) {
               echo $element." ";
        }
        echo "</td></tr>";
        echo "<tr><td>Opcio1</td><td>".$opcio1."</td></tr>";
        echo "<tr><td>Inclou</td><td>"; 
         foreach($inclou as $element) {
                   echo $element." ";
        }
        echo "</td></tr>";
         
        exit;
     }
}
  
?>

<h2>Validació formulari</h2>
<p>Exemple de validació i recuperació de dades d'un formulari</p>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >

  <div class="form-group">
    <label>Nom: (cadena obligatòria entre 1 i 25 caràcters)</label>  
    <input type="text" name="nom" class="form-control" value="<?php echo $nom; ?>"> 
    <?php    mostraError('nom', $errors); ?>
    
  </div>
  
  <div class="form-group">
    <label>Quantitat: (Enter obligatori entre 1 i 10)</label>  
    <input type="text" name="quantitat" class="form-control" value="<?php echo $quantitat; ?>" >        
    <?php    mostraError('quantitat', $errors); ?>
  </div>
  
  <div class="form-group">
    <label>Password: (cadena obligatòria entre 1 i 15 caràcters</label>   
    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
   <?php    mostraError('password', $errors); ?>
  </div>
  
  <input type="hidden" name="ocult" value="amagat">
 
   <div class="form-group">
     <label>Descripció: (cadena de caràcters no obligatòria)</label>   
     <textarea name="descripcio" class="form-control" placeholder="aqui posa la descripcio"><?php echo $descripcio;?></textarea>  
   <?php    mostraError('descripcio', $errors); ?>
  </div>

  <div class="form-group">
      <label>Esmorzar: (Selecció única No obligatòria)</label>  
  
       <div class="form-check-inline"> 
       <label class="form-check-label">
         <input type="radio" name="opcio1" class="form-check-input" value="cereals" <?php if($opcio1=="cereals") echo "checked";   ?> > 
         Cereals
         </label>
      </div>
      
      <div class="form-check-inline">
      <label class="form-check-label">
        <input type="radio" name="opcio1" class="form-check-input" value="iogurt"   <?php if($opcio1=="iogurt") echo "checked";   ?>> 
        Iogurt
      </label>
      </div>
      
      <div class="form-check-inline">
      <label class="form-check-label">
        <input type="radio" name="opcio1"  class="form-check-input" value="magdalena"  <?php if($opcio1=="magdalena") echo "checked";   ?>> 
        Magdalena
      </label>      
      </div>  
       <?php    mostraError('opcio1', $errors); ?>
  </div>
  
 
  <div class="form-group">
      <label for="email">Estudis realitzats:(Selecció múltiple No obligatòria)</label>   
  
      <div class="form-check-inline">
      <label class="form-check-label">
          <input type="checkbox" name="estudis[]" value="ESO" <?php if(in_array("ESO",$estudis)) echo "checked";?>> ESO
      </label>
      </div>
      
      <div class="form-check-inline">
      <label class="form-check-label">
          <input type="checkbox" name="estudis[]" value="BAT" <?php if(in_array("BAT",$estudis)) echo "checked";?>> Batxillerat
      </label>
      </div>
      
      <div class="form-check-inline">
      <label class="form-check-label">
           <input type="checkbox" name="estudis[]" value="CFGM" <?php if(in_array("CFGM",$estudis)) echo "checked";?>> CFGM
      </label>
      </div>
 
     <?php    mostraError('estudis', $errors); ?>
 </div>

  <div class="form-group">
  <label for="sel1">Anar d'excursio a: (Selecció única obligatòria)</label>
  <select name="excursio" class="form-control" id="sel1">    
      <option value=""></option>
     <option <?php if($excursio=="Mallorca") echo "SELECTED";   ?>  >Mallorca</option>
     <option <?php if($excursio=="Girona") echo "SELECTED";   ?>>Girona</option>
     <option <?php if($excursio=="Sevilla") echo "SELECTED";   ?>>Sevilla</option>
  </select>
   <?php    mostraError('excursio', $errors); ?>
  </div>

  <div class="form-group">
  <label for="sel1">Incloure:</label>
  <select name="inclou[]" multiple class="form-control">
     <option value="1" <?php if(in_array("1",$inclou)) echo "selected";?>>Esmorzar</option>
     <option value="2" <?php if(in_array("2",$inclou)) echo "selected";?>>Dinar</option>
     <option value="3" <?php if(in_array("3",$inclou)) echo "selected";?>>Berenar</option>
     <option value="4" <?php if(in_array("4",$inclou)) echo "selected";?>>Sopar</option>
  </select>
   <?php    mostraError('inclou', $errors); ?>
  </div>
  
  <br><input type="submit"  class="btn btn-primary" value="enviar" name="boto">


</form>

</div>

</body>
</html>
