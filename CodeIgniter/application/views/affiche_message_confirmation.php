<div class="row">
    <div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        <div class="alert alert-success">
        <h1>
            <?php
                if (isset($message_validation) && !empty($message_validation)){
                    echo $message_validation;
                }
                else{
                    echo "<p class ='text-center'>Pas de messages pour le moment, revenez plus tard, merci :)</p>";
                }
            ?>
        </h1>
        </div>
    </div>
</div>
