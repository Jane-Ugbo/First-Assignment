<?php 
require 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>My First ToDo List</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="main-section">
	<div class="flex items-center justify-center font-black m-3 mb-12">
            <h1 class="tracking-wide text-3xl font-bold text-white dark:text-white">My ToDo List</h1>
            </div>
		<div class="add-section">
			<form action="work/add.php" method="post" autocomplete="off">
				<?php //if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
					<input type="text"
						name="title"
						placeholder="Add Todo..." />
						<button type="submit">Add &nbsp;</button>
					
					<?php //} ?>
																								
			
			</form>
		</div>
		<?php
			$todo = $connect->query("SELECT * FROM todo ORDER BY id DESC");
		?>
			<div class="show-todo-section">
				<?php while($todos = $todo->fetch(PDO::FETCH_ASSOC)) { ?>
				<div class="todo-item">
				<span id="<?php echo $todos['id']; ?>"
					class="remove-to-do">x</span>
					<?php if($todos['checked']){ ?>
						<input type="checkbox"
						class="check-box"
						data-todo-id ="<?php echo $todos['id']; ?>" 
						checked />
						<h2 class="checked"><?php echo $todos['title'] ?></h2>
					<?php }else { ?>
						<input type="checkbox"
						data-todo-id ="<?php echo $todos['id']; ?>" 
						class="check-box" />
						<h2><?php echo $todos['title'] ?></h2>
					<?php } ?>
					<br>
					<small>created: <?php echo $todos['date_time'] ?></small>
				</div>
				<?php } ?>
			</div>
	</div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			$('.remove-to-do').click(function(){
				const id = $(this).attr('id');

				$.post("work/remove.php",
				{
					id: id
				},
				(data) => {
					if(data){
						$(this).parent().hide(600);
					}
				}
				);
			});
			$(".check-box").click(function(e){
				const id = $(this).attr('data-todo-id');
				$.post('work/check.php',
				{
					id: id
				},
				(data) => {
					if(data != 'error'){
						const h2 = $(this).next();
						if(data === '1'){
							h2.removeClass('checked');
						}else {
							h2.addClass('checked');
						}
					}
				}
				);
			});
		});
	</script>
</body>
</html>