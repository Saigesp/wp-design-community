<table>
<?php
    if(is_array($users)){
        foreach($users as $user_id){
            loopuserlist($user_id);
        }
    }elseif(is_object($users)){
        foreach($users->results as $user){
            loopuserlist($user->ID);
        }
    }
?>
</table>