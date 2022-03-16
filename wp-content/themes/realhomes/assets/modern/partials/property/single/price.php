<?php
/**
 * Head of the single property template.
 *
 * @package    realhomes
 * @subpackage modern
 */

global $post;
?>
<div class="rh_page__head rh_page__property">


    <div class="rh_page__property_price">
		<?php
		/* Property Status. For example: For Sale, For Rent */
		$status_terms = get_the_terms( get_the_ID(), 'property-status' );
		if ( ! empty( $status_terms ) ) {
			?>
            <p class="status">
				<?php
				$status_count = 0;
				foreach ( $status_terms as $term ) {
					if ( $status_count > 0 ) {
						echo ', ';
					}
					echo esc_html( $term->name );
					$status_count ++;
				}
				?>
            </p><!-- /.status -->
			<?php
		}
		?>
        <p class="price">
			<?php
			if ( function_exists( 'ere_property_price' ) ) {
				ere_property_price( get_the_ID(), true );
			}
			?>
        </p><!-- /.price -->
    </div><!-- /.rh_page__property_price -->
</div><!-- /.rh_page__head -->