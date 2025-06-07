<?php
class Gowilds_Listing_Comment_FE extends Gowilds_Listing_Comment{

  public static $instance;

	public static function getInstance() {
		if (!isset(self::$instance) && !(self::$instance instanceof Gowilds_Listing_Comment_FE)) {
		self::$instance = new Gowilds_Listing_Comment_FE();
		}
		return self::$instance;
	}

	public function __construct(){ 
	 	add_filter( 'comments_template', array($this, 'comments_template_loader') );
	 	add_filter( 'pre_comment_approved', array( $this, 'pre_save_review' ), 10, 2 );
	 	add_action( 'comment_post', array( $this, 'save_comment_review' ), 10, 3 );
	 	add_filter( 'comment_form_logged_in', '__return_empty_string' );
		add_action( 'lt_review_field_init', array( $this, 'reviews_field_for_listing_owner' ), 10, 3 );
	}
  
	function comments_template_loader($template) {
		global $post; 	
		if ( $post->post_type !== 'trip' ) {
			return $template;
		}
		return get_template_directory() . '/wp-travel-engine/other/comments.php';
	}

	public function add_review_field() {
		if ( ! is_singular( 'trip' ) ) { return; }

		$post         = get_post();
		$current_user = wp_get_current_user();
		$is_author    = $current_user->ID && absint( $current_user->ID ) === absint( $post->post_author );

		do_action( 'lt_review_field_init', $post, $current_user, $is_author );

		echo apply_filters( 'lt_review_field', $this->review_field() );
	}


  	public function review_field() {
  		$review_categories = $this->categories_review();
	 	ob_start();
  	?>

	 	<div id="lt-comment-reviews" class="lt-comment-reviews">
			<div class="comment-reviews-content">
            <div class="comment-reviews-inner clearfix">
   			  	<?php foreach ( $review_categories as $key => $name) : ?>
      				<div class='review-item'>
      					<label><?php echo $name ?></label>
      					<div class='stars select-review' data-review-key='<?php echo $key; ?>'>
      						<span data-star='5' class="star dashicons dashicons-star-filled"></span>
      						<span data-star='4' class="star dashicons dashicons-star-filled"></span>
      						<span data-star='3' class="star dashicons dashicons-star-filled"></span>
      						<span data-star='2' class="star dashicons dashicons-star-filled"></span>
      						<span data-star='1' class="star dashicons dashicons-star-filled"></span>
      					  <input type="hidden" class="lt-review-val" id="lt-review-<?php echo $key ?>-val"  required="required" name="lt_review[<?php echo $key; ?>]" value="5">
      					</div>
      				</div>
   			  <?php endforeach; ?>
   			</div>
            <div class="avg-total-tmp">
               <span class="value">5</span>
               <span class="avg-title"><?php echo esc_html__('Average Ratting', 'gowilds-themer') ?></span>
            </div>
         </div>   
	 	</div>

<?php
	 return ob_get_clean();
  }

  	public function pre_save_review( $approved, $data ) {
	 	$post = get_post( $data['comment_post_ID'] );

	 	if ( 'trip' !== $post->post_type ) {
		return $approved;
	 	}

	 	if ( 0 !== intval( $data['comment_parent'] ) ) {
		return $approved;
	 	}

	 	return $approved;
  	}

  public function save_comment_review( $comment_id, $comment_approved, $data ) {
	 	$post_id = $data['comment_post_ID']; 
	 	$post = get_post($post_id);

	 	if ( 'trip' !== $post->post_type || 0 !== intval( $data['comment_parent'] ) ) {
			return;
	 	}
	 
	 	if(isset($_POST['lt_review'])){
        	update_comment_meta( $comment_id, 'lt_review', $_POST['lt_review'] );
	 	}

	 	$reviews_total = $review_average = $count = 0;
     	foreach ($_POST['lt_review'] as $key => $value) {
         $reviews_total += intval($value);
         $count ++;
     	}
     	
     	$review_average = $reviews_total/$count;
     	update_comment_meta( $comment_id, 'lt_review_average', $review_average );

     	// Update average, count for all reviews categoires of post.
     	$results_reviews = $this->results_reviews_by_post($post_id);
     	update_post_meta( $post_id, 'lt_results_reviews', $results_reviews );

     	// Update average all reviews of post.
     	$reviews_post_average = $this->average_reviews_by_post($post_id);
     	update_post_meta( $post_id, 'lt_reviews_average', $reviews_post_average );

  }

  public function reviews_field_for_listing_owner( $post, $current_user, $is_author ) {
		if ( $is_author && gowilds_themer_get_theme_option( 'lt_review_allow_owner', 'enable' ) != 'enable' ) {
			
			echo sprintf( '<div class="alert alert-warning">%s</div>', wpautop( __( "You can't add a star rating to your own product.", 'wp-job-manager-reviews' ) ) );
			add_filter( 'lt_review_field', '__return_false' ); 
			
		}
	}

   public function star_review_by_comment($comment_id){
      $lt_review = get_comment_meta($comment_id, 'lt_review', true);
      $categoires = $this->categories_review();
      $output = '';
      if(empty($lt_review)) return '';
      $output .= '<ul class="comment-rating-ul">';
         foreach ($lt_review as $key => $item) {
            $label = isset($categoires[$key]) && $categoires[$key] ? $categoires[$key] : $key;
            $output .='<li>';
               $output .= '<span class="comment-rating-criterion">' . $label . '</span>';
               $output .= '<span class="comment-rating-stars stars">';
                  for($i=1; $i <= $item; $i++) { 
                     $output .= '<span class="star"><i class="fas fa-star"></i></span>'; 
                  }
                  for($i=0; $i < 5 - $item; $i++) { 
                     $output .= '<span class="star"><i class="far fa-star"></i></span>'; 
                  }
               $output .= '</span>';
            $output .= '</li>';
         }
      $output .= '</ul>';
      return $output;
   }

  public function comment_rate($rate) {
	 $alt = '';
	 switch ($rate) {
		case '0':
		  $alt = 'Zero - 0 stars';
		  break;
		case '1':
		  $alt = 'Really bad - 1 star';
		  break;
		case '2':
		  $alt = 'Bad - 2 stars';
		  break;
		case '3':
		  $alt = 'Good - 3 stars';
		  break;
		case '4':
		  $alt = 'Very good - 4 stars';
		  break;
		case '5':
		  $alt = 'Excellent - 5 stars';
		  break;
		default:
		  $alt = 'No grade';
		  break;
	 }

	 for ($i = 0; $i < 5; $i++) {
		if ($rate > $i){
		  echo '<i class="on fas fa-star"></i>';
		}else{
		  echo '<i class="off far fa-star"></i>';
		}
	 }
  }

}

new Gowilds_Listing_Comment_FE();