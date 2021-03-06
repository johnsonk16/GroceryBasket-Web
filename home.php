<?php
	error_reporting(0);
	session_start();
  require_once('config.php');

	$conn = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);

	if(!$conn){
   	die('could not connect' . mysqli_error());
  } 
	 // echo 'CONNECTED TO DB';

 ?>	


<html lang="en" class="no-js">
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/home.css"> 
<link rel="stylesheet" href="css/demo.css"> 
<link rel="stylesheet" href="css/add-meal.css"> <!-- Add meal modal style -->

<!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous"> -->

<?php  	 
if(isset($_SESSION["login"]) && $_SESSION["login"] == true) {
		include 'header-logged-in.php';
	} else {
		include 'header.php';
	}
?>	

<br>
<div id="main">
	<form class="center" id="form" action="search.php" method="post">
		<h1>Find Recipes</h1>
		<br>
		<input type="text" id="textBar" placeholder="enter keywords (optional)" name="term" autofocus>
		<tr>
			<td colspan="2" style="text-align:center;">
			<input type="submit" class="formButton" value="Search Recipes"/>
			<!-- <button class="formButton" type="button" onclick="location.reload()" >Reset Fields</button> -->
			</td>
		</tr>
	</form>
</div>

	<!-- <div class="cd-nugget-info">
			<a href="explore.php">Explore</a>
	</div> -->
	<div class="cd-intro">
		<div class="cd-nugget-info">
			<a id="add-meal-btn" onclick="addmeal()">Add Your Own Recipe</a>
		</div> <!-- cd-nugget-info -->

	</div>

	<div id="add_meal_modal" class="modal">
		<div class="modal-content">
			<div class="modal-header">
      			<span class="close">&times;</span>
      			<h2>Add Recipe</h2>
    		</div>

    		<div class="modal-body">
    			<form id="add-meal-form" name="add-meal-form" action="uploadRecipe.php" method="post">
    			<!-- <div class="modal-body"> -->
    				<div class="row">
    					<div class="col-25">
    						<label for="recipe-name">Recipe Name: </label>
      					</div>
     			 		<div class="col-75">
        					<input type="text" id="RecipeName" name="RecipeName" placeholder="Your recipe name..">
        					<span class="error"><p id="name_error"></p></span>
      					</div>
    				</div>

    				<div class="row">
      					<div class="col-25">
        					<label for="ingredients">Ingredients: </label>
      					</div>
      					<div class="col-75">
      						<table id="ingredients"> 
                    			<tr id="ingredientRow">
                        		<td class="Quantity"><input id = "quantity" name="quantity[]" placeholder="(ex. 2)"></td>
                            <td><select class="measurement" id="measurement" name="measurement[]" data-placeholder="Select measurement..." required="">
                              <option value="">Select Measurement...</option>
                            <option value='1'>Pinch</option><option value='2'>Teaspoon</option><option value='3'>Tablespoon</option><option value='4'>Cup</option><option value='5'>Ounce</option><option value='6'>Pound</option><option value='7'>Gallon</option><option value='8'> </option><option value='9'>Pint</option><option value='10'>Quart</option><option value='11'>Clove</option> <option value = '12'>Can</option><option value = '13'>Slice</option></select>

                        		<span class="error"><p id="ingredients_error"></p></span>

                             <td><select class="ingredient" id="ingredients" name="ingredients[]" data-placeholder="Select ingredient..." required="">
                              <option value="">Select ingredient...</option>
                           <optgroup label='Fruit'><option value='21'>Apple</option><option value='30'>Avocado</option><option value='23'>Banana</option><option value='29'>Blackberry</option><option value='27'>Blueberry</option><option value='24'>Grape</option><option value='121'>Lime</option><option value='122'>Lemon</option><option value='31'>Mango</option><option value='22'>Orange</option><option value='28'>Peach</option><option value='25'>Pineapple</option><option value='32'>Plum</option><option value='26'>Strawberry</option></optgroup><optgroup label='Vegetables'><option value='36'>Arugula</option><option value='43'>Broccoli<option value='98'>Black Bean</option>Broccoli</option><option value='44'>Brussels Sprouts</option><option value='39'>Cabbage</option><option value='33'>Carrot</option><option value='128'>Cauliflower</option><option value='37'>Celery</option><option value='34'>Corn</option><option value='42'>Green Bean</option><option value ='97'>Green Pepper</option><<option value='123'>Jalapeno</option>option value='38'>Kale</option><option value='146'>Lettuce</option><option value = '151'>Mushroom</option><option value='147'>Onion</option><option value='41'>Peas</option><option value ='96'>Red Pepper</option><option value='124'>Shallots</option><option value='35'>Spinach</option><option value='40'>Tomato</option><option value='120'>Zucchini</option></optgroup><optgroup label='Meat'><option value ='149'>Bacon</option><option value='51'>Chicken Breast</option><option value='52'>Chicken Wings</option><option value='45'>Ground Beef</option><option value='46'>Ground Turkey</option><option value='49'>Ham</option><option value='50'>Pork Chop</option><option value='54'>Pork Loin</option><option value='143'>Sausage</option><option value='47'>Steak</option><option value='53'>Steak Tips</option><option value='48'>Turkey</option></optgroup><optgroup label='Seafood'><option value='61'>Catfish</option><option value='59'>Clam</option><option value='60'>Cod</option><option value='58'>Crab</option><option value='62'>Lobster</option><option value='63'>Mussels</option><option value='56'>Salmon</option><option value='55'>Shrimp</option><option value='64'>Swordfish</option><option value='57'>Tuna</option></optgroup><optgroup label='Spices'><option value='12'>Basil</option><option value='141'>Bay Leaves</option><option value ="18">Cayenne Powder</option><option value='15'>Chili Powder</option><option value='14'>Cilantro</option><option value='144'>Cinnamon</option><option value='9'>Garlic</option><option value='10'>Garlic Powder</option><option value='16'>Ginger</option><option value='140'>Italian Seasoning</option><option value='150'>Mustard Seed</option><option value='131'>Nutmeg</option><option value='20'>Onion Powder</option><option value='13'>Oregano</option><option value='11'>Paprika</option><option value='19'>Parsley</option><option value='125'>Red Pepper Flakes</option><option value='17'>Thyme</option></optgroup><optgroup label='Grains'><option value='68'>Barley</option><option value='66'>Buckwheat</option><option value='69'>Oat</option><option value='65'>Quinoa</option><option value='67'>Rice</option><option value='70'>Rye</option></optgroup><optgroup label='Dairy'><option value='73'>1% Milk</option><option value='72'>2% Milk</option><option value='104'>American Cheese</option><option value='102'>Blue Cheese</option><option value='74'>Butter(Salted)</option><option value='75'>Butter(Unsalted)</option><option value='103'>Cheddar Cheese</option><option value='130'>Clarified Butter</option><option value='129'>Heavy Whipping Cream</option><option value='100'>Mozzarella Cheese</option><option value='99'>Parmesan Cheese</option><option value='101'>Ricotta Cheese</option><option value='148'>Sour Cream</option><option value='71'>Whole Milk</option></optgroup><optgroup label='Oil'><option value='78'>Canola Oil</option><option value='77'>Coconut Oil</option><option value='76'>Olive Oil</option><option value='79'>Peanut Oil</option><option value='81'>Peanut Oil</option><option value='80'>Sesame Oil</option></optgroup><optgroup label='Dry Goods'><option value='116'>Almond Flour</option><option value='6'>Baking Powder</option><option value='5'>Baking Soda</option><option value='137'>Bread Crumbs</option><option value='4'>Brown Sugar</option><option value='135'>Chocolate Chip</option><option value='85'>Cornstarch</option><option value='2'>Flour</option><option value='152'>Graham Crackers</option><option value='114'>Ground Cornmeal</option><option value='153'>Marshmallow</option><option value='84'>Pasta</option><option value='8'>Pepper</option><option value='108'>Potato Starch</option><option value='82'>Powdered Sugar</option><option value='110'>Rice Flour</option><option value='113'>Rye Bread</option><option value='7'>Salt</option><option value='109'>Soy Flour</option><option value='111'>White Bread</option><option value='112'>Wheat Bread</option><option value='95'>Wheat Flour</option><option value='3'>White Sugar</option><option value='107'>Xanthan Gum</option><option value='86'>Yeast</option></optgroup><optgroup label='Wet Goods'><option value='136'>Almond Extract</option><option value='88'>Apple Cider Vinegar</option><option value='119'>Beef Stock</option><option value='106'>Buttermilk</option><option value='118'>Chicken Broth</option><option value='92'>Corn Syrup</option><option value='90'>Honey</option><option value='138'>Hot Sauce</option><option value='133'>Ketchup</option><option value='145'>Lemon Juice</option><option value='93'>Maple Syrup</option><option value='94'>Molasses</option><option value='132'>Mustard</option><option value = '152'>Mushroom Soup<option value='127'>Red Wine</option><option value='105'>Soy Sauce</option><option value='83'>Tomato Paste</option><option value='142'>Tomato Sauce</option><option value='134'>Unsweetened Cocoa Powder</option><option value='91'>Vanilla</option><option value='117'>Water</option><option value='126'>White Wine</option><option value='87'>White Vinegar</option><option value='89'>Wine Vinegar</option><option value='139'>Worcestershire Sauce</option></optgroup><optgroup label='Other'><option value='1'>Egg</option><option value='115'>Shortening</option></optgroup></select></td>

                     		</table>
                     		<button type="button" onclick=addIngredient() id="addStepBtn" >Add Ingredient...</button>
      					</div>
    				</div>

    				<div class="row">
      					<div class="col-25">
        					<label for="tags">Tags: </label>
      					</div>
      					<div class="col-75">
        					<select class="chosen-select" id="tags" name="tags" multiple data-placeholder="Select tag(s)..." required="">

                     		<?php
                        		$sql = "SELECT * FROM Tag ORDER BY Tag_Type";
                        		$result = mysqli_query($conn, $sql);
                        		if($result->num_rows>0){
                          			while($row = $result->fetch_assoc()){
                            			echo "<option value='".$row["Tag_ID"]."'>".$row["Tag_Type"]."</option>";
                          			}
                        		}
                        	?>

        					</select>
      					</div>
    				</div>

    				<div class="row">
      					<div class="col-25">
       						<label for="time">Total Time: </label>
      					</div>
     					<div class="col-75">
        					<select id="time" name="totaltime" required="">
          					<?php
                     			$sql = "SELECT * FROM Time ORDER BY Time_ID";
                        		$result = mysqli_query($conn, $sql);
                        		if($result->num_rows>0){
                          			while($row = $result->fetch_assoc()){
                            			echo "<option value='".$row["Time_ID"]."'>".$row["Amount"]."</option>";
                          			}
                        		}
                      		?>

        					</select>
      					</div>
    				</div>

    				<div class="row">
      					<div class="col-25">
        					<label for="servings">Servings: </label>
      					</div>
      					<div class="col-75">
        					<input id="servings" type="number" class="number" name="servings" placeholder="0">
        					<span class="error"><p id="servings_error"></p></span>
      					</div>
    				</div>
    			
    				<div class="row">
      					<div class="col-25">
        					<label for="instructions">Instructions: </label>
      					</div>
      					<div class="col-75">
      						<table id="steps">
              					<tr>
                					<td id="step" name="step" class="step">Step 1:</td>
                					<td><textarea id="instruction" type="text" name="steps[]" placeholder="Enter step..." style="height:50px; width: 300px; max-width: 300px;"></textarea></td>
                          <span class="error"><p id="instructions_error"></p></span>
              					</tr>
            				</table>
							<td><button type="button" onclick= addStep() id="addStepBtn" >Add Step...</button></td>
      					</div>
    				</div>

    				<div class="row">
      					<div class="col-25">
        					<label for="photoUpload">Upload Photo: </label>
      					</div>
      					<div class="col-75">
        					<input id="photoUpload" type="file" name="photoUpload">
      					</div>
    				</div>
    
    				<div class="row">
      					<input class="submit_btn" type="submit" value="Submit" onclick="validateForm()">
    				</div>

    				<div class="row">
    					<p class="add-meal-modal__reset-fields" onclick="location.reload()"><a>Reset Fields</a></p>
    				</div>
    			</form>
    		</div>	
  		</div>
    </div>
  </td>

	<style>
.column2 { 
  float: left; 
  width: 30%;
	margin: 25px;	
}

/* Clear floats after image containers */
.row::after {
  content: "";
  clear: both;
	display: table;
}

.container {
  position: relative; 
  max-width: 800px; /* Maximum width */
  margin: 0 auto; /* Center it */
}

</style>
<div class="responsive">
	<div class="row">
  <div class="column2">
	  <a href="viewRecipe.php?Recipe_ID=1">
    <img src="img/bacon.jpg" alt="Bacon" class="resize" ><h1>Spiced Candied Bacon</h1>
  </div>
  <div class="column2">
		<a href="viewRecipe.php?Recipe_ID=2">
    <img src="img/bananabread.jpg" alt="BananaBread" class="resize"><h1>Banana Bread</h1>
  </div>
  <div class="column2">
		<a href="viewRecipe.php?Recipe_ID=3">
    <img src="img/southern-oven-fried-chicken-3058647-5_preview-5b0ec6ecba61770036491ed7.jpeg" alt="Fried Chicken" class="resize"><h1>Fried Chicken</h1>
  </div>	
</div>


<br>
<br>

<div class="row">
  <div class="column2">
	  <a href="viewRecipe.php?Recipe_ID=4">
    <img src="img/beefstrog.jpg" alt="Beef Stroganoff" class="resize" ><h1>Beef Stroganoff</h1>
  </div>
  <div class="column2">
		<a href="viewRecipe.php?Recipe_ID=13">
    <img src="img/caulimaccheese.jpg" alt="Cauliflower Mac and Cheese" class="resize"><h1>Cauliflower Mac and Cheese</h1>
  </div>
  <div class="column2">
		<a href="viewRecipe.php?Recipe_ID=21">
    <img src="img/cauliricebeef.jpg" alt="Cauliflower Rice Beef Bowl" class="resize"><h1>Cauliflower Rice Beef Bowl</h1>
  </div>	
</div>
</div>
<br>
<br>



                    <!-- Show recipe name and image on home page -->
<?php
// as of 7/16, displays name and image in a list. Recipe name links to recipe. Fracnesca fixed the add recipe button -kristin

// $result = mysqli_query($conn,"SELECT * FROM Recipes"); 
// calculates the number of recipes in DB
// $num_rows = mysqli_num_rows($result);

// for($i=1; $i<=$num_rows;$i++){
 
  // $sql = "SELECT * FROM Recipes WHERE Recipe_ID = '" .mysqli_real_escape_string($conn,$i) . "'";
  // $result = mysqli_query($conn, $sql);
  // $data = mysqli_fetch_assoc($result);
  // $recipeID= $data['Recipe_ID'];
  // $recipeName = $data['Recipe_Name'];
  // $recipeIMG= $data['Recipe_Img'];
 
	// $image_count = $num_rows;
	// $count_each_column = ceil($image_count/4);

	// echo '<div style="width:100%; max-width:950px; margin:0 auto;">';
	// $count = 0;
	// if (is_array($recipeIMG) || is_object($recipeIMG))
	// {
		// foreach($recipeIMG as $image) 
		// {
			// $count+=1;
			// if($count==1)
			// {
					// echo '<div class="box boxgallery">';
			// }
					// echo '<img src="img/'.$recipeIMG.'" />';

			// if($count>=$count_each_column)
			// {
					// $count=0;
					// echo '</div>';
			// }
		// }
	// }

	// if($count>0)
	// {
			// echo '</div>';
	// }
	// echo '</div>';
 ?>
     <!-- <table class="center" align="center" cellpadding="2" cellspacing="5" border="0">  -->

        <!-- <col width = 30%> -->
        <!-- <col witdh =70%> -->


   
        <!-- Recipe Image -->
        <!-- <tr> -->
          <!-- <td colspan="2" id="imageCell"> -->
   
      <?php

							//  if($recipeIMG!="NULL")
                //  echo "<img src='img/".$recipeIMG."' class='resize'>";
      
              //  else
              //  echo "<img src='img/yummyFood.jpg' class='resize'>";
            ?>

          <!-- </td> -->
        <!-- </tr> -->

        <!-- Recipe Name -->
        <!-- <tr> -->

          <!-- <td colspan="2"><h1> -->
            <?php 
              // echo "<a href='viewRecipe.php?Recipe_ID=".$recipeID." '>".$recipeName
              // ;
      
          //  } ?>
      
          <!-- </h1> -->
        <!-- </td> -->
      <!-- </tr> -->
    <!-- </table> -->
    <script type="text/javascript" src="js/add-meal.js"></script>

		<style>	
		.btn {
			background-color: #da5067;
  		border-radius: 50em;
  		color: white;
			padding: 2em;
			position: relative;
			margin: 125px 325px;
  		text-align: center;
  		font-size: 20px;
			width:60%;
			text-align:center;
  		opacity: 1;
			transition: all 0.3s;
			display:inline-block;
		}

		.btn:hover {opacity: 0.6}

	
	
		</style>
				<a href="explore.php">
				<button class="btn" button onclick="myFunction()" id="myBtn">View more</button>
		<script>
		
		function myFunction() {
  		var dots = document.getElementById("dots");
  		var moreText = document.getElementById("more");
  		var btnText = document.getElementById("myBtn");
			
			if (dots.style.display === "none") {
				dots.style.display = "inline";
    		btnText.innerHTML = "Read more"; 
    		moreText.style.display = "none";
				} else {
					dots.style.display = "none";
    			btnText.innerHTML = "Read less"; 
    			moreText.style.display = "inline";
  				}
		}
</script>

</html>