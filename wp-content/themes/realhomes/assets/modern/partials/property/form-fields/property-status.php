<?php
/**
 * Field: Property Status
 * @package realhomes/modern
 */
?>

<div class="rh_form__item rh_form--3-column rh_form--columnAlign">
    <label for="status"><?php esc_html_e( 'Status', 'framework' ); ?></label>
    <span class="selectwrap">
	    <select name="status"
                id="status"
                class="inspiry_select_picker_trigger inspiry_bs_default_mod inspiry_bs_orange show-tick"
                data-size="5">
	        <?php
	        if ( inspiry_is_edit_property() ) {
		        global $target_property;
		        realhomes_edit_form_hierarchical_options( $target_property->ID, 'property-status' );
	        } else {
		        ?>
                <option selected="selected" value="-1"><?php esc_html_e( 'None', 'framework' ); ?></option><?php
		        if ( class_exists( 'ERE_Data' ) ) {
			        realhomes_id_based_hierarchical_options( ERE_Data::get_hierarchical_property_statuses(), - 1 );
		        }
	        }
	        ?>
	    </select>
	</span>
</div>
<!-- /.rh_form__item -->
