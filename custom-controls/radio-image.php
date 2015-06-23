<?php

/**
 * Register a custom Radio Image control to the WordPress customizer
 *
 * @since      1.0.0
 * @package    Customizer_Boilerplate
 */




if ( ! function_exists( 'polygon_register_customizer_control_radio_image' ) ) {

	/**
	 * Register Radio Image control.
	 *
	 * Register a custom Radio Image control to the WordPress customizer.
	 *
	 * @since    1.0.0
	 */
	function polygon_register_customizer_control_radio_image( $wp_customize ) {
		if ( ! isset( $wp_customize ) ) {
			return;
		}



		/**
		 * Create a Radio Image control
		 *
		 * This class creates a custom control for radio images for the WordPress
		 * customizer. Besides the standard parameters our custom control accepts
		 * 'choices' and 'columns' as parameters. Example:
		 *
		 * $wp_customize->add_control(
		 *     new Polygon_Customize_Radio_Image_Control(
		 *         $wp_customize,
		 *         'temporary',
		 *         array(
		 *             'label'       => __( 'Temporary', 'polygon' ),
		 *             'description' => __( 'This is a temporary description.', 'polygon' ),
		 *             'section'     => 'section_custom_code',
		 *             'choices'     => array(
		 *                 'first-option'  => '/link/to/image-one.png',
		 *                 'second-option' => '/link/to/image-two.png',
		 *                 'third-option'  => '/link/to/image-three.png',
		 *             ),
		 *             'columns'     => 3,
		 *         )
		 *     )
		 * );
		 *
		 * The control accepts up to 6 columns.
		 *
		 * @since    1.0.0
		 */
		class Polygon_Customize_Radio_Image_Control extends WP_Customize_Control {

			/**
			 * Control type.
			 *
			 * @since     1.1.0
			 * @var       string
			 */
			public $type = 'radio-image';



			/**
			 * Number of columns.
			 *
			 * @since     1.1.0
			 * @var       string
			 */
			public $columns;




			/**
			 * Enqueue scripts and styles for the custom control.
			 *
			 * Enqueue the required scripts and styles for our custom control.
			 * Scripts are hooked at 'customize_controls_enqueue_scripts' and styles at
			 * 'customize_controls_print_styles'.
			 *
			 * @since    1.0.0
			 */
			public function enqueue() {
				wp_enqueue_script( 'jquery-ui-button' );
			}




			/**
			 * Render control content.
			 *
			 * Render our custom control inside the WordPress customizer.
			 *
			 * @since    1.0.0
			 */
			public function render_content() {
				if ( empty( $this->choices ) ) {
					return;
				}			
				
				$name = 'customize-radio-' . $this->id;

				switch ( $this->columns ) {
					case 1 :
						$columns = 'one-column';
						break;
					case 2 :
						$columns = 'two-columns';
						break;
					case 3 :
						$columns = 'three-columns';
						break;
					case 4 :
						$columns = 'four-columns';
						break;
					case 5 :
						$columns = 'five-columns';
						break;
					case 6 :
						$columns = 'six-columns';
						break;
					default :
						$columns = 'one-column';
						break;
				}

				?>
					<?php if ( ! empty( $this->label ) ) { ?>
						<span class="customize-control-title">
							<?php echo esc_attr( $this->label ); ?>
						</span>
					<?php } ?>

					<?php if ( ! empty( $this->description ) ) { ?>
						<span class="description customize-control-description">
							<?php echo esc_html( $this->description ); ?>
						</span>
					<?php } ?>

					<div id="input_<?php echo $this->id; ?>" class="image <?php echo $columns; ?>">
						<?php foreach ( $this->choices as $value => $label ) { ?>
							<input class="radio-image" type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo $this->id . '_' . $value; ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
								<label for="<?php echo $this->id . '_' . $value; ?>">
									<img src="<?php echo esc_html( $label ); ?>" alt="<?php echo esc_attr( $value ); ?>" title="<?php echo esc_attr( $value ); ?>">
								</label>
							</input>
						<?php } ?>
					</div>

					<script>
						jQuery(document).ready(function($) { 
							$( '[id="input_<?php echo $this->id; ?>"]' ).buttonset();
						});
					</script>
				<?php
			}

		}
	}
	add_action( 'customize_register', 'polygon_register_customizer_control_radio_image', 0 );

}





if ( ! function_exists( 'polygon_customizer_control_radio_image_css' ) ) {

	/**
	 * Style Radio Image control.
	 *
	 * Style the custom Radio Image control inside the customizer.
	 *
	 * @since    1.0.0
	 */
	function polygon_customizer_control_radio_image_css() { 
		?>
			<style>
				.customize-control-radio-image input[type=radio] {
					float: left;
				}

				.customize-control-radio-image label {
					display: inline-block;
					float: left;
					max-width: 100%;
					padding-left: 2px;
					padding-right: 2px;
				}

				.customize-control-radio-image .image.one-column label {
					max-width: 100%;
				}

				.customize-control-radio-image .image.two-columns label {
					max-width: 48%;
				}

				.customize-control-radio-image .image.three-columns label {
					max-width: 31.5%;
				}

				.customize-control-radio-image .image.four-columns label {
					max-width: 23%;
				}

				.customize-control-radio-image .image.five-columns label {
					max-width: 18.3%;
				}

				.customize-control-radio-image .image.six-columns label {
					max-width: 15%;
				}

				.customize-control-radio-image label img {
					opacity: 0.5;
				}

				.customize-control-radio-image label.ui-state-hover img {
					opacity: 1;
				}

				.customize-control-radio-image label.ui-state-active img {
					opacity: 1;
				}
			</style>
		<?php
	}
	add_action( 'customize_controls_print_styles', 'polygon_customizer_control_radio_image_css' );

}