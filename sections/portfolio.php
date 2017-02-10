<!--=======================================
=            Portfolio section            =
========================================-->
<?php 
global $post;
	$sectionenable = esc_attr(get_theme_mod('project_enable',1));
	if($sectionenable==1){
		$title = esc_attr(get_theme_mod('project_title',__('Project Title','pure-mix')));
		$desc	= esc_attr(get_theme_mod('project_content',__('Project Description','pure-mix')));
		$catId = esc_attr(get_theme_mod('pure-mix_project_category_display',1)); 
        $cat   = esc_attr(get_the_category_by_ID($catId)); 
 
    	 $project='<section id="portfolio" >
                <div class="container">
                <div class="row">
                    <iv class="col-md-12">
                        <!-- Section Title -->
                        <div class="section-title">
                            <h2>'.$title.'</h2>
                            <div class="divider"></div>
                            <p>'.$desc.'</p>
                        </div>
                    </div>
                </div>';
                //end of row

    $project.='<div class="row">
                <div class="col-md-12 col-sm-12">
               <div class="iso-section wow fadeInUp" data-wow-delay="2.6s">
                    
                    <ul class="filter-wrapper clearfix">';
    $project.='<li role="presentation" data-filter="*" class="selected opc-main-bg"><a href="#'.$cat.'" aria-controls="'.$cat.'" role="tab" data-toggle="tab">'.__('All','pure-mix').'</a></li>';
                  // Parent Category name
                        $category = get_category_by_slug( $cat );

                                $args = array(
                                'type'                     => 'post',
                                'child_of'                 => $catId,
                                'orderby'                  => 'name',
                                'order'                    => 'ASC',
                                'hide_empty'               => FALSE,
                                'hierarchical'             => 1,
                                'taxonomy'                 => 'category',
                                ); 

                    $termchildren = get_categories($args );
                       
                        foreach($termchildren as $termchildren):
                            $term_name = $termchildren->name;
                            $term_slug = $termchildren->slug;
   
    $project.='<li  class="opc-main-bg" role="presentation"><a href="#'.$term_slug.'" aria-controls="'.$term_slug.'" role="tab" data-toggle="tab">'.$term_name.'</a></li>';
                    endforeach;
    $project.='</ul>
                  <div class="tab-content">';

    // start all category
    $project.='<div role="tabpanel" class="iso-box-section wow fadeInUp" data-wow-delay="1s" id="'.$cat.'">
                        <div class="iso-box-wrapper col4-iso-box">  <div class="iso-box photoshop branding col-md-4 col-sm-6">
                                 <div class="portfolio-thumb">';
    
   
                        $the_query = new WP_Query( array ( 'category_name'=>$cat  ) );
                       
                        while ( $the_query->have_posts()): 
                        $the_query->the_post();
                        $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'pure-mix-projects' );
                        $featured_image = $featured_image[0];
                        $title          = get_the_title();
                        $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all','parent' => $catId,);
                        $term =wp_get_post_terms(get_the_ID(),'category',$args);
                        foreach ($term as $terms) {
                            $term_name = $terms->name;
                        }


    
     $project.='              <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="single">';
                                if ( !has_post_thumbnail() ) {
                                                $project.='<img src="'.esc_url(get_template_directory_uri()).'/images/portfolio/portfolio-img1.jpg"  alt="">';
                                }
                                else{   
                                                $project.='<img src="'.$featured_image.'"  alt="">';
                                }                
    $project.='                     <div class="on-hover">
                                        <a href="'.esc_url(get_permalink()).'" title="">
                                            <div class="inner">
                                            <h2>'.$cat.'</h2>
                                            
                                        </div>
                                        </a>
                                    </div>
                                </div>
                            </div>';
                        endwhile;
                        wp_reset_postdata();  
     $project.='       </div>
                    </div>
                    <!-- end of tabpanel-->';

                  //end all category


                        
                        $counter=0;
                        $category = get_category_by_slug( $cat );

                                $args = array(
                                'type'                     => 'post',
                                'child_of'                 => $category->term_id,
                                'orderby'                  => 'name',
                                'order'                    => 'ASC',
                                'hide_empty'               => FALSE,
                                'hierarchical'             => 1,
                                'taxonomy'                 => 'category',
                                ); 

                        $termchildren = get_categories($args );
                        
                        foreach($termchildren as $termchildren):
                            $term_name = $termchildren->name;
                            $term_slug = $termchildren->slug;
                        $counter++;
                        if($counter==1){
                            $active="active";
                        }else{
                            $active="";
                        }
   
   
    $project.='<div role="tabpanel" class="tab-pane fade in " id="'.$term_slug.'">
                        <div class="row">';
    
   
                            $the_query = new WP_Query( array ('category_name'=>$term_slug  ) );
                           
                            while ( $the_query->have_posts()): 
                            $the_query->the_post();
                            $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'metlux-projects' );
                            $featured_image = $featured_image[0];
                            
     $project.='              <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="single">';
                                if ( !has_post_thumbnail() ) {
                                                $project.='<img src="'.esc_url(get_template_directory_uri()).'/images/portfolio/portfolio-img2.jpg"  alt="">';
                                }
                                else{   
                                                $project.='<img src="'.$featured_image.'"  alt="">';
                                }                
    $project.='                     <div class="on-hover">
                                        <a href="'.esc_url(get_permalink()).'" title="">
                                            <div class="inner">
                                            <h2>'.$cat.'</h2>
                                            <p>'.$term_name.'</p>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                            </div>';
                            endwhile;
                            wp_reset_postdata();  
     $project.='       </div>
                    </div>';
             
                     endforeach;               
    $project.='</div></div></div></div></div></section>';
    echo $project;

 }?>

<!--====  End of Portfolio section  ====-->
