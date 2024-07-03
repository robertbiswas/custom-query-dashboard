<?php
/* Admin Page
*/
?>
<div class="wrap">
	<h1 class="wp-heading-inline">Custom Query</h1>
	<div class="tablenav top">
		<form method='get'>
			<input type='hidden' name='page' value='cud_custom_query' />
			<label class="screen-reader-text" for="cat">Filter by category</label>
			
			<select name="custom_cat" id="cat" class="postform">
				<option value="0">All Categories</option>
				<?php foreach ( $terms as $term ) : ?>
				<option value="<?php echo $term->term_id; ?>" <?php selected(( isset( $_GET['custom_cat'] ) ? $_GET['custom_cat'] : 0 ) , $term->term_id); ?> ><?php echo $term->name; ?></option>
				<?php endforeach; ?>
			</select>

			<select name="user_author" class="postform">
				<option value="0">All Users</option>
				<?php foreach ( $blogusers as $user ) : ?>
				<option value="<?php echo $user->ID; ?>" <?php selected(( isset( $_GET['user_author'] ) ? $_GET['user_author'] : 0 ) , $user->ID); ?> ><?php echo $user->user_nicename; ?></option>
				<?php endforeach; ?>
			</select>

			<input type="submit" class="button" value="Filter">	
		</form>
	</div>
	<table class="wp-list-table widefat fixed striped table-view-list pages">
			<thead>
				<tr>
					<th>Title</th>
					<th>Author</th>
					<th>Categories</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ( $posts as $post ) : 
					$author = get_user_by('id', $post->post_author);
					$assigned_categoris = wp_get_post_categories( $post->ID, array( 'fields' => 'names' ) );
					if($assigned_categoris){
						$post_cat_list = implode(', ', $assigned_categoris);
					}
					?>
					<tr>
						<td><?php echo $post->post_title; ?></td>
						<td><?php echo $author->data->display_name ?></td>
						<td><?php echo $post_cat_list; ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
	</table>
</div>