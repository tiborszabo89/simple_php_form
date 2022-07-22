    <div class="wine-form">
        <div class="container">  
            <div class="col-md-6 col-12">
            <?php
                require_once('form.php'); 
                echo $form->fastform($data,TRUE);             
            ?>
            </div>      
        </div>
    </div>
    
