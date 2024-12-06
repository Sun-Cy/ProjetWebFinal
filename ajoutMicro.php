<?php
include_once("inc/header.php"); 
    $mm = new MicroManager($bdd);

if(isset($_REQUEST['marque'])){ 
    if(isset($_REQUEST['rgb'])){$_REQUEST['rgb'] = true;}else{$_REQUEST['rgb'] = false;}
    
    $mm->insertMicro($_REQUEST['marque'],
    $_REQUEST['modele'],
    $_REQUEST['garantie'],
    $_REQUEST['interface'],
    $_REQUEST['img'],
    $_REQUEST['prix'],
    $_REQUEST['lien'],
    $_REQUEST['cartouche'],
    $_REQUEST['frequenceMin'],
    $_REQUEST['frequenceMax'],
    $_REQUEST['maxSPL'],
    $_REQUEST['ratedImpedance'],
    $_REQUEST['rgb']);
    ?>
    <h2 class="center">Voici les infos du micro que vous avez ajouter :</h2>
    <br>
    <div class="center">
    <p>Marque : <?= $_REQUEST['marque'] ?></p>
    <p>Modèle : <?= $_REQUEST['modele'] ?></p>
    <p>Garantie : <?= $_REQUEST['garantie'] ?></p>
    <p>Interface : <?= $_REQUEST['interface'] ?></p>
    <p>Image : <?= $_REQUEST['img'] ?></p>
    <p>Prix : <?= $_REQUEST['prix'] ?></p>
    <p>Lien : <?= $_REQUEST['lien'] ?></p>
    <p>Cartouche : <?= $_REQUEST['cartouche'] ?></p>
    <p>Fréquence Minimum (en dB) : <?= $_REQUEST['frequenceMin'] ?></p>
    <p>Fréquence Maximum (en dB)  : <?= $_REQUEST['frequenceMax'] ?></p>
    <p>MaxSPL (Sound Pressure Level en dB) : <?= $_REQUEST['maxSPL'] ?></p>
    <p>Rated Impedance : <?= $_REQUEST['ratedImpedance'] ?></p>
    <p>RGB : <?php if(isset($_REQUEST['rgb'])){echo "Oui";} else{echo "Non";} ?></p>
    </div>



<?php } 
else { ?>

<form action="ajoutMicro.php" id="ajoutMicro" class="frm-carrière">
    <div class="fieldSets">
<fieldset>
<div class="row">
<i class="fa fa-chevron-circle-right fa-5" aria-hidden="true"></i>
            <label for="">Marque: </label>
            <input type="text" name="marque" required>
            <br>
            <label for="">Modèle: </label>
            <input type="text" name="modele" required>
            <br>
    
            <label for="">Garantie: </label>
            <select name="garantie" id="garanties">
            <?php
            $garanties = $mm->get_garantie();

            for ($i = 0; $i < sizeof($garanties); $i++){
            echo '<option value="' . $garanties[$i]['garantie'] . '">' . $garanties[$i]['garantie'] . '</option>';
            }
            ?>
            </select>
            <br>
            <label for="">Interface: </label>
            <select name="interface" id="interfaces" required>
            <?php
            $interfaces = $mm->get_interface();

            for ($i = 0; $i < sizeof($interfaces); $i++){
            echo '<option value="' . $interfaces[$i]['interface'] . '">' . $interfaces[$i]['interface'] . '</option>';
            }
            ?>
            </select>
        
        
   
  </div>
</fieldset>


<fieldset class="hide">
<div class="row">
    <div>
<i class="fa fa-chevron-circle-left fa-5" aria-hidden="true"></i>
<i class="fa fa-chevron-circle-right fa-5" aria-hidden="true"></i>
</div>
    <br>
    <label for="">Image: </label>
    <input type="text" name="img" required>
    <br>
    <label for="">Prix: </label>
    <input type="number" name="prix" required>
    <br>
    <label for="">Lien: </label>
    <input type="link" name="lien" required>
    <br>
    <label for="">Cartouche: </label>
    <select name="cartouche" id="cartouches" required>
    <?php
        $cartouches = $mm->get_cartouche();

        for ($i = 0; $i < sizeof($cartouches); $i++){
            echo '<option value="' . $cartouches[$i]['cartouche'] . '">' . $cartouches[$i]['cartouche'] . '</option>';
        }
        ?>
    </select>
   
  </div>
    </fieldset>
  
    <fieldset class="hide">
        <div class="row">
    <i class="fa fa-chevron-circle-left fa-5" aria-hidden="true"></i>
 
    <br>
    <label for="">Fréquence Minimum: </label>
    <input type="number" name="frequenceMin">
    <br>
    <label for="">Fréquence Maximum: </label>
    <input type="number" name="frequenceMax">
    <br>
    <label for="">Max SPL (Sound Pressure Level en dB): </label>
    <input type="number" name="maxSPL">
    <br>
    <label for="">Rated Impedance: </label>
    <input type="number" name="ratedImpedance">
    <br>
    <label for="">RGB: </label>
    <input type="checkbox" name="rgb">
    <br>
    <button type="submit">Ajouter le micro</button>
    </div>
    </fieldset>
    </div>
</form>
<?php } ?>