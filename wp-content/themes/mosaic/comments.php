<?php
/**
 * @package Mosaic
 * @author Wild Web Lab - www.wildweblab.com 
 * @since Mosaic 1.0
*/

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<div class="clear"></div><p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','mosaic');?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<div id="comments">
<?php if ( have_comments() ) : ?>
	
	
	<h2>	
	<?php printf( _n( 'One Response', '%1$s Responses', get_comments_number(), 'mosaic' ),
			number_format_i18n( get_comments_number() ) 
		);?>
	
	</h2>
	
	<ul class="commentlist">
	<?php wp_list_comments( array(
		'callback' => 'mosaic_comments',
	) ); ?>
	</ul>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
	
 <?php else : // this is displayed if there are no comments so far ?>

	
<?php endif; ?>

</div>
<?php if ( comments_open() ) : ?>

<div id="respond">

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('You must be logged in to post a comment.','mosaic');?></a> </p>
<?php else : ?>

<?php comment_form(); ?>



<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; ?>
