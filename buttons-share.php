<?php if(is_single()){  ?>
    <div id="buttons-share" class="buttons-share">
        <ul class="rrssb-buttons actrrss-buttons clearfix rrssb-separator">
            <li class="rrssb-facebook">
                <a class="popup" target="popup" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>','name','width=600,height=400')">
                    <span class="rrssb-icon">
                        <?php the_svg_icon('facebook');?>
                    </span>
                </a>
            </li>
            <li class="rrssb-twitter">
                <a target="popup" class="popup" onclick="window.open('http://twitter.com/home?status=<?php the_title();?>%20<?php the_permalink();?>%20via%20@talkandcode','name','width=600,height=400')">
                    <span class="rrssb-icon">
                        <?php the_svg_icon('twitter');?>
                    </span>
                </a>
            </li>
            <li class="rrssb-linkedin">
            	<a class="popup" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink();?>&amp;title=<?php the_title();?>&amp','name','width=600,height=400')">
                	<span class="rrssb-icon">
                    	<?php the_svg_icon('linkedin');?>
                    </span>
                </a>
            </li>
            <li class="rrssb-googleplus">
            	<a class="popup" onclick="window.open('https://plus.google.com/share?url=<?php the_title();?>%20<?php the_permalink();?>','name','width=600,height=400')">
                	<span class="rrssb-icon">
                    	<?php the_svg_icon('gplus')?>
                    </span>
                </a>
            </li>
            <li class="rrssb-meneame">
                <a target="_blank" href="https://www.meneame.net/submit.php?url=<?php the_permalink();?>">
                    <span class="rrssb-icon">
                        <?php the_svg_icon('meneame')?>
                    </span>
                </a>
            </li>
        </ul>
        <ul class="rrssb-buttons actrrss-buttons clearfix">
            <li class="rrssb-comments">
                <a href="<?php the_permalink();?>#comments-<?php the_ID(); ?>">
                    <span class="rrssb-icon">
                        <?php the_svg_icon('comment');?>
                    </span>
                </a>
            </li>
            <li class="rrssb-email">
                <a target="popup" onclick="window.open('mailto:?subject=Mira%20este%20art%C3%ADculo&amp;body=Creo%20que%20esto%20puede%20interesarte:%20<?php the_permalink();?>','name','width=600,height=400')">
                    <span class="rrssb-icon">
                        <?php the_svg_icon('email');?>
                    </span>
                </a>
            </li>
            <li class="rrssb-pdf">
                <a target="popup" onclick="window.print()">
                    <span class="rrssb-icon">
                        <?php the_svg_icon('pdf');?>
                    </span>
                </a>
            </li>
            <li class="rrssb-whatsapp">
                <a href="whatsapp://send?text=Mira%20este%20art%C3%ADculo:%20<?php the_permalink();?>" data-text="Mira%20este%20art%C3%ADculo:%20<?php the_permalink();?>" data-href="">
                    <span class="rrssb-icon">
                        <?php the_svg_icon('whatsapp')?>
                    </span>
                </a>
            </li>
        </ul>
    </div>

<?php } ?>