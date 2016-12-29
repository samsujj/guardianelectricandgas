<?php

//remove_filter( 'the_content', 'wpautop' );
//remove_filter( 'the_excerpt', 'wpautop' );
//remove_filter( 'comment_text', 'wpautop', 30 );



add_filter('tiny_mce_before_init', 'myextensionTinyMCE' );



function myextensionTinyMCE($init) {
    // Command separated string of extended elements
    $ext = 'span[class|style],h1[class|style],h2,h3,hr,ul[class],ol[class],li[class],div[class|id|style|link],meta';

    // Add to extended_valid_elements if it alreay exists
    if ( isset( $init['extended_valid_elements'] ) ) {
        $init['extended_valid_elements'] .= ',' . $ext;
    } else {
        $init['extended_valid_elements'] = $ext;
    }

    // Super important: return $init!
    return $init;
}



add_filter('tiny_mce_before_init', 'myextensionTinyMCE' );

//add Faq type post
add_action( 'init', 'create_post_faq' );
function create_post_faq() {
    register_post_type( 'faq',
        array(
            'labels' => array(
                'name' => __( 'FAQ' ),
                'singular_name' => __( 'faq' )
            ),
            'public' => true,
            'has_archive' => true,
        )
    );
}

//add Testimonial type post
add_action( 'init', 'create_post_testimonial' );
function create_post_testimonial() {
    register_post_type( 'testimonial',
        array(
            'labels' => array(
                'name' => __( 'Testimonial' ),
                'singular_name' => __( 'testimonial' )
            ),
            'public' => true,
            'has_archive' => true,
        )
    );
}

//add Banner type post
add_action( 'init', 'create_post_banner' );
function create_post_banner() {
    register_post_type( 'banner',
        array(
            'labels' => array(
                'name' => __( 'Banner' ),
                'singular_name' => __( 'banner' )
            ),
            'public' => true,
            'has_archive' => true,
        )
    );
}

//add Dailylinks type post
add_action( 'init', 'create_post_dailylinks' );
function create_post_dailylinks() {
    register_post_type( 'dailylinks',
        array(
            'labels' => array(
                'name' => __( 'Daily Links' ),
                'singular_name' => __( 'dailylinks' )
            ),
            'public' => true,
            'has_archive' => true,
        )
    );
}

//show testimonial list
add_shortcode('testimoniallist', 'wpb_testimonial');
function wpb_testimonial() {

    $the_query = new WP_Query( array( 'post_type' => 'testimonial', 'posts_per_page' => 2, 'post_status' => 'publish'  ) );


    $post_html = '<ul>';

    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            $metaval=(get_post_meta( get_the_ID() ));
            $postimg=wp_get_attachment_image( intval($metaval['_simple_fields_fieldGroupID_17_fieldID_1_numInSet_0'][0]) , array('100', '100') );
            $post_html .= '<li><span class="hometestimonial_img">'.$postimg.'</span><p></p><div class="hometestimonial_text">'.wp_trim_words(get_the_content(),20,'<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal'.get_the_ID().'"> Read More</a>').'<p><strong>'.$metaval['_simple_fields_fieldGroupID_17_fieldID_2_numInSet_0'][0].', '.$metaval['_simple_fields_fieldGroupID_17_fieldID_3_numInSet_0'][0].'</strong></p></div><div class="clearfix"></div>
            
            <div id="myModal'.get_the_ID().'" class="modal fade" role="dialog">
  <div class="modal-dialog">
  
    <div class="modal-content">
    <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">'.$metaval['_simple_fields_fieldGroupID_17_fieldID_2_numInSet_0'][0].', '.$metaval['_simple_fields_fieldGroupID_17_fieldID_3_numInSet_0'][0].'</h4>
        </div>
      <div class="modal-body">
        <p>'.wp_trim_words(get_the_content()).'</p>
      </div>
    </div>

  </div>
</div>
            
            </li>';
        }
    }



    $post_html .= '</ul>';

    return $post_html;

    /* Restore original Post Data */
    wp_reset_postdata();
}


//show faq list
add_shortcode('faqlist', 'wpb_faq');
function wpb_faq() {

    $the_query = new WP_Query( array( 'post_type' => 'faq', 'posts_per_page' => 3, 'post_status' => 'publish'  ) );

    $i=0;

    $post_html = '<div class="panel-group homefaqwrapper" id="accordion">';

    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            $i++;

            $post_html .= '<div class="panel panel-default"><h4><a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$i.'"><span>'.get_the_title().'</span></a><br></h4><div id="collapse'.$i.'" class="panel-collapse collapse '.(($i==1)?'in':'').'">'.get_the_content().'</div>
<p></p></div>
';
        }
    }



    $post_html .= '</div>';

    return $post_html;

    /* Restore original Post Data */
    wp_reset_postdata();
}



//show banner list
add_shortcode('homebannerlist', 'wpb_home_banner');
function wpb_home_banner() {

    $the_query = new WP_Query( array( 'post_type' => 'banner', 'post_status' => 'publish'  ) );

    $i=0;

    $post_html = '';

    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {

            $i++;
            $the_query->the_post();
            $metaval=(get_post_meta( get_the_ID() ));

            $postimg=wp_get_attachment_url( intval($metaval['_simple_fields_fieldGroupID_13_fieldID_1_numInSet_0'][0]) );

            $post_html .= '<div class="item '.(($i==1)?'active':'').'"><img src="'.$postimg.'" /></div>';


        }
    }

    return $post_html;

    /* Restore original Post Data */
    wp_reset_postdata();
}

//show 1st daily links list
add_shortcode('dailylinks1', 'wpb_dailylinks1');
function wpb_dailylinks1() {

    $the_query = new WP_Query( array( 'post_type' => 'dailylinks', 'post_status' => 'publish', 'orderby'   => 'meta_value_num',	'meta_key'  => '_simple_fields_fieldGroupID_18_fieldID_3_numInSet_0','order'=>'asc','meta_query' => array(
        array(
            'key'     => '_simple_fields_fieldGroupID_18_fieldID_1_numInSet_0',
            'value'   => 'dropdown_num_2',
            'compare' => '=',
        ),
    ),
        ) );

    $post_html = '';

    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();

            $metaval=(get_post_meta( get_the_ID() ));

            $url = $metaval['_simple_fields_fieldGroupID_18_fieldID_2_numInSet_0'][0];

            $post_html .= '<h2>'.get_the_title().'</h2><a href="'.$url.'" target="_blank">'.$url.'</a>';


        }
    }

    return $post_html;

    /* Restore original Post Data */
    wp_reset_postdata();
}


//show 2nd daily links list
add_shortcode('dailylinks2', 'wpb_dailylinks2');
function wpb_dailylinks2() {

    $the_query = new WP_Query( array( 'post_type' => 'dailylinks', 'post_status' => 'publish', 'orderby'   => 'meta_value_num',	'meta_key'  => '_simple_fields_fieldGroupID_18_fieldID_3_numInSet_0','order'=>'asc','meta_query' => array(
        array(
            'key'     => '_simple_fields_fieldGroupID_18_fieldID_1_numInSet_0',
            'value'   => 'dropdown_num_3',
            'compare' => '=',
        ),
    ), ) );

    $post_html = '<h1>Residential links</h1>';

    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();

            $metaval=(get_post_meta( get_the_ID() ));

            $url = $metaval['_simple_fields_fieldGroupID_18_fieldID_2_numInSet_0'][0];

            $post_html .= '<h2>'.get_the_title().'</h2><a href="'.$url.'" target="_blank">'.$url.'</a>';


        }
    }

    return $post_html;

    /* Restore original Post Data */
    wp_reset_postdata();
}


//show 3rd daily links list
add_shortcode('dailylinks3', 'wpb_dailylinks3');
function wpb_dailylinks3() {

    $the_query = new WP_Query( array( 'post_type' => 'dailylinks', 'post_status' => 'publish', 'orderby'   => 'meta_value_num',	'meta_key'  => '_simple_fields_fieldGroupID_18_fieldID_3_numInSet_0','order'=>'asc','meta_query' => array(
        array(
            'key'     => '_simple_fields_fieldGroupID_18_fieldID_1_numInSet_0',
            'value'   => 'dropdown_num_4',
            'compare' => '=',
        ),
    ), ) );

    $post_html = '<h3>Legal Entity and Tax Id Lookup</h3>';

    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();

            $metaval=(get_post_meta( get_the_ID() ));

            $url = $metaval['_simple_fields_fieldGroupID_18_fieldID_2_numInSet_0'][0];

            $post_html .= '<h2>'.get_the_title().'</h2><a href="'.$url.'" target="_blank">'.$url.'</a>';


        }
    }

    return $post_html;

    /* Restore original Post Data */
    wp_reset_postdata();
}



?>
