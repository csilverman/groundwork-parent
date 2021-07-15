<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package groundwork
 */

get_header(); ?>

	<div class="u-lContent">
		<div class="u-Bio">

		<?php
			$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
			$authorName = "";
			if(AUTHOR__NAMEFORMAT == "FIRSTLAST") {
				$authorName = $curauth->first_name." ".$curauth->last_name;
			}
			else if(AUTHOR__NAMEFORMAT == "DISPLAYNAME") {
				$authorName = $curauth->display_name;
			}
			else if(AUTHOR__NAMEFORMAT == "NICENAME") {
				$authorName = $curauth->user_nicename;
			}
			else if(AUTHOR__NAMEFORMAT == "NICKNAME") {
				$authorName = $curauth->nickname;
			}
			else {
				$authorName = $curauth->nickname;
			}
		?>

		<h1 class="u-pageTitle author__title">
			<?php if(AUTHOR__TITLEPAGE_PREFIX) {
				echo AUTHOR__TITLEPAGE_PREFIX;
			}
			?><?php echo $authorName; ?><?php if(AUTHOR__TITLEPAGE_POSTFIX) {
				echo AUTHOR__TITLEPAGE_POSTFIX;
			}
			?>			
		</h1>
		
		
		<?php if(AUTHOR__SHOWAVATAR_BIOPAGE) { ?>
			<b class="author__avatar">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), AUTHOR__AVATARSIZE_BIOPAGE ); ?>
			</b>
		<?php } ?>
		</div>


<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
			
				<?php
				/*
				The following determines if a post has a specific format. If
				a post does not have a specific format, the standard post template
				is used. If a post has been assigned a format, though—link, video, etc—
				the file for that specific format is used.
				
				Advantages: means that different format markup can be
				split out into different files.
				
				*/
				?>
				<?php 
					if(!get_post_format()) {
						get_template_part('content', get_post_format());
					} else {
						get_template_part('format', get_post_format());
					}
				?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					// get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php groundwork_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

	</div><!-- /u-lContent -->

<?php
	if(HAS_SIDEBAR) {
		get_sidebar();
	}
?>
<?php get_footer(); ?>
