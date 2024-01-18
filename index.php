<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['username'])){
   $username = $_SESSION['username'];
}else{
   $username = '';
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/load.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>


<?php          
            $select_form = $conn->prepare("SELECT * FROM `form` WHERE username = ?");
            $select_form->execute([$username]);
            if($select_form->rowCount() > 0){
            $fetch_form = $select_form->fetch(PDO::FETCH_ASSOC);
         ?>

<!-- <?= $fetch_form["branch"]; ?> -->
<div class="contain">
    <?php if ($fetch_profile['status'] == "") : ?>
        
        Hello











    <?php elseif ($fetch_profile['status'] == "pending" ) : ?>
        <svg class="bike" viewBox="0 0 48 30" width="48px" height="30px">
        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1">
		<g transform="translate(9.5,19)">
			<circle class="bike__tire" r="9" stroke-dasharray="56.549 56.549" />
			<g class="bike__spokes-spin" stroke-dasharray="31.416 31.416" stroke-dashoffset="-23.562">
				<circle class="bike__spokes" r="5" />
				<circle class="bike__spokes" r="5" transform="rotate(180,0,0)" />
			</g>
		</g>
		<g transform="translate(24,19)">
			<g class="bike__pedals-spin" stroke-dasharray="25.133 25.133" stroke-dashoffset="-21.991" transform="rotate(67.5,0,0)">
				<circle class="bike__pedals" r="4" />
				<circle class="bike__pedals" r="4" transform="rotate(180,0,0)" />
			</g>
		</g>
		<g transform="translate(38.5,19)">
			<circle class="bike__tire" r="9" stroke-dasharray="56.549 56.549" />
			<g class="bike__spokes-spin" stroke-dasharray="31.416 31.416" stroke-dashoffset="-23.562">
				<circle class="bike__spokes" r="5" />
				<circle class="bike__spokes" r="5" transform="rotate(180,0,0)" />
			</g>
		</g>
		<polyline class="bike__seat" points="14 3,18 3" stroke-dasharray="5 5" />
		<polyline class="bike__body" points="16 3,24 19,9.5 19,18 8,34 7,24 19" stroke-dasharray="79 79" />
		<path class="bike__handlebars" d="m30,2h6s1,0,1,1-1,1-1,1" stroke-dasharray="10 10" />
		<polyline class="bike__front" points="32.5 2,38.5 19" stroke-dasharray="19 19" />
	</g>
        </svg>
        <h1 style="text-align: center;font-size: 40px;">กำลังทำการตรวจสอบ</h1>
        <br>


        <?php elseif ($fetch_profile['status'] == "repair" ) : ?>

        <svg class="bike" viewBox="0 0 48 30" width="48px" height="30px">
        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1">
		<g transform="translate(9.5,19)">
			<circle class="bike__tire" r="9" stroke-dasharray="56.549 56.549" />
			<g class="bike__spokes-spin" stroke-dasharray="31.416 31.416" stroke-dashoffset="-23.562">
				<circle class="bike__spokes" r="5" />
				<circle class="bike__spokes" r="5" transform="rotate(180,0,0)" />
			</g>
		</g>
		<g transform="translate(24,19)">
			<g class="bike__pedals-spin" stroke-dasharray="25.133 25.133" stroke-dashoffset="-21.991" transform="rotate(67.5,0,0)">
				<circle class="bike__pedals" r="4" />
				<circle class="bike__pedals" r="4" transform="rotate(180,0,0)" />
			</g>
		</g>
		<g transform="translate(38.5,19)">
			<circle class="bike__tire" r="9" stroke-dasharray="56.549 56.549" />
			<g class="bike__spokes-spin" stroke-dasharray="31.416 31.416" stroke-dashoffset="-23.562">
				<circle class="bike__spokes" r="5" />
				<circle class="bike__spokes" r="5" transform="rotate(180,0,0)" />
			</g>
		</g>
		<polyline class="bike__seat" points="14 3,18 3" stroke-dasharray="5 5" />
		<polyline class="bike__body" points="16 3,24 19,9.5 19,18 8,34 7,24 19" stroke-dasharray="79 79" />
		<path class="bike__handlebars" d="m30,2h6s1,0,1,1-1,1-1,1" stroke-dasharray="10 10" />
		<polyline class="bike__front" points="32.5 2,38.5 19" stroke-dasharray="19 19" />
	</g>
        </svg>


        <div class="btn">
            <a href="<?php if ($fetch_profile['status'] == 'repair') { echo 'updateForm.php'; } ?>" <?php if ($fetch_profile['status'] == 'pending') { echo ' style="display: none;"'; } ?>>
            <h1 style="text-align: center;font-size: 30px;">กลับมาแก้ไข</h1>
               <p>หมายเหตุ : <?= $fetch_form["note"]; ?></p>
                <button>แก้ไขข้อมูล</button>
            </a>
        </div>
    <?php endif; ?>

    <?php if ($fetch_profile['status'] == "success") : ?>

        success

        <?php endif; ?>
</div>

</div>

<?php
            }else
         ?>
    
</body>
</html>