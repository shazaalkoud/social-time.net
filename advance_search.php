<?php
/*
Template Name: Advanced Search
*/

get_header(); ?>

<?php
$args = array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'cat' => 50,
    'meta_query' => array()
);
$postlist= get_posts($args);
$nationality_unique = array();
$work_unique = array();
?>  
    <div class="td-main-content-wrap td-container-wrap">
        <div class="td-container">
           
            <div class="td-pb-row">
                <div class="td-pb-span8 td-main-content">
                    <div class="td-ss-main-content">
                        <div class="td-page-header">
                            <h1 class="entry-title td-page-title head-search">
                                <span><?php esc_html_e('البحث في دليل المشاهير بلوليبل', 'newspaper');?></span>
                            </h1>
                            <div class="search-page-search-wrap">
                                <form method="get" class="td-search-form-widget" action="<?php echo esc_url( home_url( '/verified-search/' ) ); ?>" id="custom-search">
                                    <div role="search">
                                        <div class="container">
                                            <div class="td-pb-row">
                                                <div class='td-pb-span4 custom-search'>
                                                <label> اسم الشخصية </label>
                                                    <input class="td-widget-search-input" type="text" placeholder="الاسم" value="<?php echo get_search_query(); ?>" name="name_input"  />
                                                </div>
                                                <div class='td-pb-span4 custom-search'>
                                                   <label> الجنسية </label>
                                                    <select name='nationality' class="td-widget-search-input">
                                                       
                                                        <option value=''>الكل</option>
                                                        <?php
                                         foreach ($postlist as $row){
                                            $nationality_meta = get_post_meta( $row -> ID, 'nationality', true);
                                           
                                         $itemArray = explode( ", ", $nationality_meta );
                                         $nationality_unique = array_merge($nationality_unique,  $itemArray);
                                         }
                                        $nationality_unique =array_unique($nationality_unique);
                                        foreach ($nationality_unique as $val){
                                            $nationality = $val ;
                                            if($nationality != ''){
                                                
                                                        ?>
                                                            <option  value='<?php echo $nationality?>'><?php echo $nationality?></option>
                                                            <?php
                                                        } } ?>
                                                    </select>
                                                </div>
                                                <div class='td-pb-span4 custom-search'>
                                                     <label> المهنة </label>
                                                    <select name='work' class="td-widget-search-input">
                                                        
                                                        <option value=''>الكل</option>
                                                        <?php
                                        foreach ($postlist as $row){
                                        $work_meta =get_post_meta( $row -> ID, 'work', true);
                                         $itemArray = explode( ", ", $work_meta );
                                         $work_unique = array_merge($work_unique,  $itemArray);
                                         }
                                        $work_unique =array_unique($work_unique);
                                        foreach ($work_unique as $val){
                                            $work = $val ;
                                        if($work != ''){
                                                            ?>
                                                                <option value="<?php echo $work ?>" ><?php echo $work?></option>
                                                                <?php
                                                        } } ?>
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            <div class='td-pb-span12 send'>
                                                <input class="" type="submit" id="searchsubmit" value="<?php esc_html_e('بحث', 'newspaper')?>" />
                                                 <input class="" type="reset" id="resetsubmit" value="<?php esc_html_e('مسح', 'newspaper')?>" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <?php
                            get_template_part('advanced-search-archive' );
                        ?>
                    </div>
                 
                </div>
                <div class="td-pb-span4 td-main-sidebar">
                    <div class="td-ss-main-sidebar">
                        <?php dynamic_sidebar( 'td-default' ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>