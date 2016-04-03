<?php get_header();

if(get_user_meta($current_user->ID, 'asociation_responsability', true) == 'rp_concursos' || is_user_role('administrator')) {

  $args = array (
    'order' => 'DESC',
    'posts_per_page' => -1,
    'post_type' => 'concursos',
    //'orderby' => 'meta_value',
    //'meta_key'  => '_start_ts',
  );
  $wp_query = new wp_query( $args );


  if(is_user_role('administrator') || is_user_role('editor')) { 
    include(locate_template('functions-validation.php'));
  }

  ?>

  <!-- flexboxer -->
  <form method="POST" action="">
  <div class="flexboxer flexboxer--event">

        <?php include(locate_template('templates/harry/harry.php')); ?>

      <!-- admin options -->
        <section class="wrap wrap--content wrap--content__toframe wrap--flex wrap--transparent wrap--menu">
            <div class="wrap wrap--frame wrap--frame__middle">
                <p></p>
            </div>
            <div class="wrap wrap--frame wrap--frame__middle">
              <p class="right"><a onclick="ToggleSection(this)" class="js-section-launch" data-section="newconcurso" class="">Crear concurso</a></p>
              <p class="right"><a onclick="ToggleSection(this)" class="js-section-launch" data-section="setconcursosoptions">Configurar concursos</a></p>
            </div>
        </section><!-- end of admin options -->

        <section id="newconcurso" class="wrap wrap--content wrap--form wrap--hidden js-section">
          <h3>Crea concurso</h3>
          <div class="wrap wrap--flex">
            <div class="wrap wrap--frame__middle">
              <label for="concurso_name">Nombre del concurso</label>
            </div>
            <div class="wrap wrap--frame__middle">
              <input id="concurso_name" type="text" name="concurso_name" required value=""/>
            </div>
          </div>
          <div class="wrap wrap--flex">
            <div class="wrap wrap--frame__middle">
              <label for="concurso_org">Organismo convocante</label>
            </div>
            <div class="wrap wrap--frame__middle">
              <input id="concurso_org" type="text" name="concurso_org" required value=""/>
            </div>
          </div>
          <div class="wrap wrap--flex">
            <div class="wrap wrap--frame__middle">
              <label for="concurso_bases">Más información</label>
            </div>
            <div class="wrap wrap--frame__middle">
              <input id="concurso_bases" type="text" name="concurso_bases" required value="" placeholder="http://"/>
            </div>
          </div>
          <div class="wrap wrap--flex">
            <div class="wrap wrap--frame__middle">
              <label for="concurso_quantity">Máximo premio</label>
            </div>
            <div class="wrap wrap--frame__middle">
              <input id="concurso_quantity" type="text" name="concurso_quantity" value=""/>
            </div>
          </div>
          <div class="wrap wrap--flex">
            <div class="wrap wrap--frame__middle wrap--flex">
              <label for="datepicker">Cierre de convocatoria</label>
            </div>
            <div class="wrap wrap--frame__middle">
              <input id="datepicker" type="text" name="fee_date" value="" required />
            </div>
          </div>
          <div class="wrap wrap--flex">
            <textarea name="description" class="description js-medium-editor tolisten"><?php echo $user->description;?></textarea>
          </div>
          <div class="wrap wrap--flex wrap--submit">
            <div class="wrap wrap--frame__middle wrap--flex">
            </div>
            <div class="wrap wrap--frame__middle wrap--flex">
              <p class="submit">
                <input name="updatefee" type="submit" id="submit-all" class="button button-primary" value="Crear concurso">
                <input name="action" type="hidden" id="action" value="new-concurso" />
              </p>
            </div>
          </div>
          <div class="wrap wrap--icon wrap--icon__close js-section-launch" onclick="ToggleSection(this)" data-section="close">
              <?php the_svg_icon('close', 'icon--corner js-close-alert'); ?>
          </div>
        </section>

        <section id="setconcursosoptions" class="wrap wrap--content wrap--form wrap--hidden js-section">
          <h3>Configurar concursos</h3>
          <div class="wrap wrap--flex">
            <div class="wrap wrap--frame__middle">
              <label for="">Lorem ipsum</label>
            </div>
            <div class="wrap wrap--frame__middle">
              <input type="text" name="" value=""/>
            </div>
          </div>
          <div class="wrap wrap--icon wrap--icon__close js-section-launch" onclick="ToggleSection(this)" data-section="close">
              <?php the_svg_icon('close', 'icon--corner js-close-alert'); ?>
          </div>
        </section>

  <?php if (have_posts()) : ?>
      <section class="wrap wrap--content">
        <h2>Concursos</h2>
        <h4>Concursos</h4>
        <?php while (have_posts()) : the_post(); 
          //$postmeta = get_post_meta($post->ID);
          //var_dump($EM_Event);
          ?>

          <!-- content -->
            <div class="wrap wrap--frame wrap--flex">
              <div class="wrap wrap--frame__middle wrap--flex">
                <div class="wrap wrap--frame__middle">
                  <a href="<?php the_permalink();?>"><?php the_title();?></a>
                </div>
                <div class="wrap wrap--frame__middle">
                  <span class="js-date">
                  <?php ?>
                  </span>
                  <span class="js-date-fromnow help-info"></span>
                </div>
              </div>
              <div class="wrap wrap--frame__middle wrap--flex">
                <div class="wrap wrap--frame__middle">
                  
                </div>
                <div class="wrap wrap--frame__middle">
                  
                </div>
              </div>
            </div>
        <?php endwhile; ?>
      </section><!-- end of content -->
      <?php else : ?>

        <!-- noinfo -->
        <section class="wrap wrap--content">
          <h2>No hay concursos creadas</h2>
        </section><!-- end of noinfo -->

      <?php endif; ?>

    
  </div><!-- end of flexboxer -->
  </form>

<?php } else header('Location: '.site_url().'?action=nopermission' ); ?>

<?php get_footer(); ?>