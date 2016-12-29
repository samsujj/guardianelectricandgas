<div class="footerblock">


    <ul class="nav navbar-nav">



        <?php
        $args = array(
            'sort_column' => 'post_date',
            'sort_order' => 'asc',
            'child_of' => '0',
            'post_type' => 'page',
            'post_status' => 'publish',
            'parent' => 0,

        );
        $pages = get_pages($args);

        if ($pages) {
            $ic=0;
            foreach ($pages as $page) :

                if($page->ID!=2578 && $page->ID!=2579 ){


                    $args2 = array(
                        'sort_column' => 'post_date',
                        'sort_order' => 'asc',
                        'child_of' => '0',
                        'post_type' => 'page',
                        'post_status' => 'publish',
                        'parent' => $page->ID,

                    );
                    $pages2 = get_pages($args2);


                    if ( is_page( $page->ID ) || $post->post_parent == $page->ID ) {
                        $active = 'active';
                    } else {
                        $active = '';
                    }


                    if(count($pages2)>0) {
                        // echo ' <li class="ssd dropdown lidiv'.$ic.' " ><a data-toggle="dropdown" class="dropdown-toggle" href="' . get_page_link($page->ID) . '"> ' . $page->post_title . ' </a>';
                        echo ' <li class="ssd dropdown  lidiv '.$ic.' '.$active.'  " ><a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0)"> ' . $page->post_title . ' </a>';

                        echo "<ul class=dropdown-menu>";


                        foreach($pages2 as $childpage){

                            if ( is_page( $childpage->ID ) ) {
                                $active = 'activechild';
                            } else {
                                $active = '';
                            }


                            echo ' <li class="ln lidiv'.$ic.' '.$active.' "><a href="' . get_page_link($childpage->ID) . '"> ' . $childpage->post_title . ' </a></li>';

                        }
                        echo "</ul>";

                    }else{
                        echo ' <li class="ssd lidiv'.$ic.' '.$active.'" ><a  class="dropdown-toggle" href="' . get_page_link($page->ID) . '"> ' . $page->post_title . ' </a>';
                    }


                    echo "</li>";

                    $ic++;

                }
            endforeach;

        }
        ?>







    </ul>

<span class="footercopyright ">&copy; 2016 Guardian Electric and Gas. All rights reserved.</span>

    <div class="clearfix"></div>

</div>

<div class="modal fade" id="formsentmsg">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="text-align: center;">
                Meil sent successfully.
            </div>
        </div>
    </div>
</div>