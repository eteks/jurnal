<?php 
wp_enqueue_style('init_menucss',get_stylesheet_directory_uri() . '/css/menu_style.css');

function add_article_settings(){
     add_menu_page('article Settings', 'Article Settings', 'manage_options', 'article-settings', 'create_token_menu_page', get_template_directory_uri().'/images/token.png'); 
}
function create_token_menu_page(){

	echo '<div class="api_settings"> <h2> Article Settings </h2>
	<div class="api_form"> 
		<form method="post">
			<label> Section Name </label>
			<select name="section_name" value="" required /> 
				<option value=""> select </option>
			</select> </br> 
			<label> Article Name </label>
			<input type="text" name="article_name" value="" placeholder="Article Name" required/> </br>
			<label> Article Content </label>
			<input type="file" name="article_name" value="" placeholder="Article Name" required/></br>
			<button type="submit" name="api_form_submit"> Save </button> </form> </div> </div>

	';
}

add_action('admin_menu','add_article_settings');

?>