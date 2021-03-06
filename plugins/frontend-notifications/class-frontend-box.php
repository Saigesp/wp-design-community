<?php
/**
 * Frontend_box class will help you to create bootstrap style alert boxes on your theme
 * @author Damian Logghe <info@timersys.com>
 * @license   GPL-2.0+
 * @link      http://wp.timersys.com/how-to-create-bootstraps-style-alert-boxes-in-your-theme/
 * @version 1.0
 */
class Frontend_box {

	/**
	 * Arguments of the alert
	 * @var Array
	 */
	private $args;

	/**
	 * Message to show
	 * @var string
	 */
	private $msg;

	/**
	 * Construct function that set message and default args
	 * @param string $msg  
	 * @param array $args 
	 */
	public function __construct(  $msg, $args = '' ) {

		$defaults 		= array(
			'type'			=> 'error', //success, info, warning
			'where'			=> 'header', // define your own locations
			'auto_close'	=> true, // disable auto hide
			'delay'			=> '5', // seconds to auto close
		);

		$this->args 	= wp_parse_args( $args, $defaults );

		$this->msg 		= $msg;

		$this->run();
	}

	/**
	 * Function that hooks our alert box into the proper location
	 * @return void
	 */
	public function run(){
	
		add_action( 'front_end_box/' . $this->args['where'], array( $this, 'print_box' ) );
	
	}

	/**
	 * Prints the alert box
	 * @return void
	 */
	public function print_box(){
		?>
		<section class="wrap wrap--content wrap--shadow wrap--alert wrap--alert__<?php echo $this->args['type'];?>" data-delay="<?php echo $this->args['delay'];?>" data-auto-close="<?php echo $this->args['auto_close'] ? 'true':'';?>">
			<div class="wrap wrap--icon wrap--icon__close js-section-launch">
			      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/close.svg" alt="Close" class="icon icon--close icon--corner">
			 </div>
			<?php echo $this->msg;?>	
		</section>
		<?php
	}

}