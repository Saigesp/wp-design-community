<table>
<?php
    if(is_array($users)){

    }elseif(is_object($users)){
        foreach($users->results as $user){
            loopuserlist($user->ID);
        }
    }
?>
</table>