<?php
$EM_Event = em_get_event($post->ID, 'post_id');
$EM_Tickets = $EM_Event->get_tickets();
$event_start_date = new DateTime($EM_Event->event_start_date.' '.$EM_Event->event_start_time);
?>

<section id="article-<?php the_ID(); ?>" class="wrap wrap--frame wrap--article
  <?php if($article_count == 0 && $pagec == 1) echo ' wrap--article__full wrap--article__special';?>
  <?php if($article_count%8 >= 0 && $article_count%8 < 2) echo ' wrap--article__medium';?>
  <?php if(round(rand(0,7)) >= 6) echo ' wrap--article__special';?>
  ">
  <?php if(has_post_thumbnail()){?>
    <figure class="thumb thumb--archive js-imagefill">
      <a href="<?php the_permalink() ?>">
        <div class="overflow overflow--black"></div>
        <?php the_post_thumbnail('full');?>
      </a>
    </figure>
  <?php } ?>
  <div class="wrap wrap--content content content--archive">
    <h2 class="title title--archive" ><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
    <div class="dates dates--archive">
      <span class="js-date"><?php echo $event_start_date->format('Y-m-d H:i:s');?></span>
      <div class="status">
        <?php
        if($EM_Event->event_rsvp == 1){ //Reservas habilitadas
          if(date(strtotime('now')) < strtotime($EM_Event->event_rsvp_date.' '.$EM_Event->event_rsvp_time)){ // Reservas habilitadas ahora mismo
            if($EM_Event->event_rsvp_spaces == 1){ // Quedan espacios
              foreach ($EM_Tickets->tickets as $EM_Ticket){
                if(date(strtotime('now')) > strtotime($EM_Ticket->ticket_start) && date(strtotime('now')) < strtotime($EM_Ticket->ticket_end)){
                  echo $EM_Ticket->ticket_name.' disponible hasta <span class="js-date">'.$EM_Ticket->ticket_end.'</span>';
                }
              }
            }else{
              echo 'Espacios agotados';
            }
          }
        }
        ?>
      </div>

    </div>
    <div class="description description--archive">
      <?php the_excerpt(); ?>
    </div>
  </div>
</section>
<?php 
//if($article_count == 0 && $pagec == 1) var_dump($EM_Tickets);
$article_count++;
?>

