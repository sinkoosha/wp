<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RHEA_Single_Property_Map_Widget extends \Elementor\Widget_Base {

	public function __construct( array $data = [], array $args = null ) {
		parent::__construct( $data, $args );

		// Check for Google Map API key and enqueue required script and style.
		if ( ! empty( get_option( 'inspiry_google_maps_api_key', '' ) ) ) {
			wp_enqueue_script(
				'google-map-api',
				esc_url_raw(
					add_query_arg(
						apply_filters( 'inspiry_google_map_arguments', array() ), '//maps.google.com/maps/api/js' )
				),
				array(),
				false,
				false
			);
		} else {
			wp_enqueue_style( 'leaflet', 'https://unpkg.com/leaflet@1.3.4/dist/leaflet.css', array(), '1.3.4' );
			wp_enqueue_script( 'leaflet', 'https://unpkg.com/leaflet@1.3.4/dist/leaflet.js', array(), '1.3.4', true );
		}
	}

	public function get_name() {
		return 'rhea-single-property-map-widget';
	}

	public function get_title() {
		return esc_html__( 'Single Property Map', 'realhomes-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-google-maps';
	}

	public function get_categories() {
		return [ 'real-homes' ];
	}

	public function get_keywords() {
		return [ 'google', 'map', 'embed', 'location' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'map_section',
			[
				'label' => esc_html__( 'Map', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'lat',
			[
				'label'       => esc_html__( 'Latitude', 'realhomes-elementor-addon' ),
				'default'     => '27.664827',
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'lng',
			[
				'label'       => esc_html__( 'Longitude', 'realhomes-elementor-addon' ),
				'default'     => '-81.515755',
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true
			]
		);

		$this->add_control(
			'zoom',
			[
				'label'   => esc_html__( 'Zoom', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 12,
				],
				'range'   => [
					'px' => [
						'min' => 5,
						'max' => 20,
					],
				],
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label'     => esc_html__( 'Section Width', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-map' => 'width: {{SIZE}}%;',
				],
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label'      => esc_html__( 'Section Height', 'realhomes-elementor-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 250,
						'max' => 750,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 460,
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => 300,
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' => 250,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .rhea-single-property-map' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'after',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'address_section',
			[
				'label' => esc_html__( 'Address', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'background_image',
			[
				'label'   => esc_html__( 'Section Background Image', 'realhomes-elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				// Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude'   => [ 'custom' ],
				'default'   => 'full',
				'separator' => 'none',
			]
		);


		$this->add_control(
			'location_label',
			[
				'label'       => esc_html__( 'Title', 'realhomes-elementor-addon' ),
				'default'     => esc_html__( 'Location', 'realhomes-elementor-addon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'address',
			[
				'label'       => esc_html__( 'Address', 'realhomes-elementor-addon' ),
				'description' => esc_html__( 'HTML tags ( a , b, br, em, strong ) can be used in Address', 'realhomes-elementor-addon' ),
				'default'     => 'Merrick Way, Miami, <br />FL 33134, USA',
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

		$this->add_responsive_control(
			'address_section_width',
			[
				'label'     => esc_html__( 'Section Width', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-map-info' => 'width: {{SIZE}}%;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'map_spaces_section',
			[
				'label' => esc_html__( 'Map', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'container_width',
			[
				'label'           => esc_html__( 'Container Width', 'realhomes-elementor-addon' ),
				'type'            => \Elementor\Controls_Manager::SLIDER,
				'range'           => [
					'px' => [
						'min' => 400,
						'max' => 1600,
					],
					'%'  => [
						'min' => 50,
						'max' => 100,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 1140,
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => 100,
					'unit' => '%',
				],
				'mobile_default'  => [
					'size' => 100,
					'unit' => '%',
				],
				'size_units'      => [ 'px', '%' ],
				'selectors'       => [
					'{{WRAPPER}} .rhea-single-property-map-wrapper' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'map_color',
			[
				'label'     => esc_html__( 'Map Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'alpha'     => false,
                'default'   => '#1ea69a'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'address_section_style',
			[
				'label' => esc_html__( 'Address', 'realhomes-elementor-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'address_container_bg',
			[
				'label'     => esc_html__( 'Address Wrapper Background Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-map-wrapper .rhea-single-property-map-info-inner' => 'background-color: {{VALUE}}',
				],
				'separator' => 'after',
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label'     => esc_html__( 'Title Color ', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-map-wrapper .rhea-single-property-map-heading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'heading_typography',
				'label'    => esc_html__( 'Title Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-single-property-map-wrapper .rhea-single-property-map-heading',
			]
		);

		$this->add_responsive_control(
			'heading_margin_bottom',
			[
				'label'           => esc_html__( 'Title Margin Bottom', 'realhomes-elementor-addon' ),
				'type'            => \Elementor\Controls_Manager::SLIDER,
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'       => [
					'{{WRAPPER}} .rhea-single-property-map-wrapper .rhea-single-property-map-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'separator'       => 'after',
			]
		);

		$this->add_control(
			'address_color',
			[
				'label'     => esc_html__( 'Address Color', 'realhomes-elementor-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rhea-single-property-map-wrapper .rhea-single-property-address' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'address_typography',
				'label'    => esc_html__( 'Address Typography', 'realhomes-elementor-addon' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rhea-single-property-map-wrapper .rhea-single-property-address',
			]
		);

		$this->add_responsive_control(
			'address_margin_bottom',
			[
				'label'           => esc_html__( 'Address Margin Bottom', 'realhomes-elementor-addon' ),
				'type'            => \Elementor\Controls_Manager::SLIDER,
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'       => [
					'{{WRAPPER}} .rhea-single-property-map-wrapper .rhea-single-property-address' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$widget_id = $this->get_id();
		?>
        <div id="rhea-single-property-map-wrapper-<?php echo esc_attr( $widget_id ); ?>"
             class="rhea-single-property-map-wrapper">
            <div id="rhea-single-property-map-<?php echo esc_attr( $widget_id ); ?>"
                 class="rhea-single-property-map"></div>
			<?php if ( $settings['address'] ) {
				?>
                <div class="rhea-single-property-map-info"
                     style="background-image: url('<?php echo esc_url( \Elementor\Group_Control_Image_Size::get_attachment_image_src( $settings['background_image']['id'], 'thumbnail', $settings ) ); ?>');">
                    <div class="rhea-single-property-map-info-inner">
						<?php if ( $settings['location_label'] ) {
							?>
                            <h4 class="rhea-single-property-map-heading"><?php echo esc_html( $settings['location_label'] ); ?></h4>
							<?php
						}
						?>
                        <p class="rhea-single-property-address"><?php echo wp_kses( $settings['address'], array(
								'a'      => array(
									'href'   => array(),
									'title'  => array(),
									'alt'    => array(),
									'target' => array(),
								),
								'b'      => array(),
								'br'     => array(),
								'em'     => array(),
								'strong' => array(),
							) ); ?></p>
                    </div>
                </div>
				<?php
			}
			?>
        </div>
        <script type="application/javascript">
			<?php
			if ( 0 === absint( $settings['zoom']['size'] ) ) {
				$settings['zoom']['size'] = 10;
			}
			$map_data = array();
			$map_data['id'] = 'rhea-single-property-map-' . esc_attr( $this->get_id() );
			$map_data['lat'] = $settings['lat'];
			$map_data['lng'] = $settings['lng'];
			$map_data['zoom'] = $settings['zoom']['size'];
			$map_data['mapType'] = empty( get_option( 'inspiry_google_maps_api_key', '' ) ) ? 'os' : 'google';
			$map_data['mapWaterColor'] = $settings['map_color'];
			?>
            (function ($) {
                'use strict';
                $(document).ready(function () {

                    let mapData = <?php echo wp_json_encode( $map_data ); ?>;
                    const mapContainer = document.getElementById(mapData.id);

                    if (mapData.lat && mapData.lng) {

                        // Google Map
                        if ('google' === mapData.mapType) {

                            const latLng = {lat: parseFloat(mapData.lat), lng: parseFloat(mapData.lng)};
                            const mapOptions = {
                                zoom: parseInt(mapData.zoom),
                                center: latLng,
                                streetViewControl: false,
                                scrollwheel: false,
                                styles: [{
                                    "featureType": "administrative",
                                    "elementType": "labels.text",
                                    "stylers": [{
                                        "color": "#000000"
                                    }]
                                }, {
                                    "featureType": "administrative",
                                    "elementType": "labels.text.fill",
                                    "stylers": [{
                                        "color": "#444444"
                                    }]
                                }, {
                                    "featureType": "administrative",
                                    "elementType": "labels.text.stroke",
                                    "stylers": [{
                                        "visibility": "off"
                                    }]
                                }, {
                                    "featureType": "administrative",
                                    "elementType": "labels.icon",
                                    "stylers": [{
                                        "visibility": "on"
                                    }, {
                                        "color": "#380d0d"
                                    }]
                                }, {
                                    "featureType": "landscape", "elementType": "all", "stylers": [{
                                        "color": "#f2f2f2"
                                    }]
                                }, {
                                    "featureType": "poi", "elementType": "all", "stylers": [{
                                        "visibility": "off"
                                    }]
                                }, {
                                    "featureType": "road", "elementType": "all", "stylers": [{
                                        "saturation": -100
                                    }, {
                                        "lightness": 45
                                    }]
                                }, {
                                    "featureType": "road", "elementType": "geometry", "stylers": [{
                                        "visibility": "on"
                                    }, {
                                        "color": "#dedddb"
                                    }]
                                }, {
                                    "featureType": "road", "elementType": "labels.text", "stylers": [{
                                        "color": "#000000"
                                    }]
                                }, {
                                    "featureType": "road", "elementType": "labels.text.fill", "stylers": [{
                                        "color": "#1f1b1b"
                                    }]
                                }, {
                                    "featureType": "road", "elementType": "labels.text.stroke", "stylers": [{
                                        "visibility": "off"
                                    }]
                                }, {
                                    "featureType": "road", "elementType": "labels.icon", "stylers": [{
                                        "visibility": "on"
                                    }, {
                                        "hue": "#ff0000"
                                    }]
                                }, {
                                    "featureType": "road.highway", "elementType": "all", "stylers": [{
                                        "visibility": "simplified"
                                    }]
                                }, {
                                    "featureType": "road.arterial",
                                    "elementType": "labels.icon",
                                    "stylers": [{
                                        "visibility": "off"
                                    }]
                                }, {
                                    "featureType": "transit", "elementType": "all", "stylers": [{
                                        "visibility": "off"
                                    }]
                                }, {
                                    "featureType": "water", "elementType": "all", "stylers": [{
                                        "color": mapData.mapWaterColor
                                    }, {
                                        "visibility": "on"
                                    }]
                                }]
                            };
                            const map = new google.maps.Map(mapContainer, mapOptions);

                            new google.maps.Marker({
                                position: latLng,
                                map,
                                icon: {
                                    url: '<?php echo esc_url( RHEA_PLUGIN_URL . 'assets/icons/map-pin.svg'); ?>',
                                },
                            });

                        } else {

                            // Open Street Map
                            const tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            });
                            const latLng = L.latLng(mapData.lat, mapData.lng);
                            const mapOptions = {
                                zoom: parseInt(mapData.zoom),
                                center: latLng,
                            };
                            const map = L.map(mapContainer, mapOptions);
                            map.scrollWheelZoom.disable();
                            map.addLayer(tileLayer);

                            // Marker
                            var markerOptions = {
                                icon: L.icon({
                                    iconUrl: '<?php echo esc_url( RHEA_PLUGIN_URL . 'assets/icons/map-pin.svg'); ?>',
                                })
                            };

                            L.marker([mapData.lat, mapData.lng], markerOptions).addTo(map);
                        }
                    }
                });
            })(jQuery);
        </script>
		<?php
	}
}