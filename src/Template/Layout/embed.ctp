<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
         <title><?php echo SITE_TITLE." | ".SITE_TITLE2;?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />

         <link rel="icon" href="<?php echo HTTP_ROOT; ?>img/uploads/favicon.jpg" sizes="32x32" />
    </head>
    <body>
        <?php echo $this->fetch('content');?>
    </body>

</html>