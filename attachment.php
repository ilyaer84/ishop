<?php
	
	$link = ($post->post_parent == 0) ? // с помощью post_parent определим есть родительский пост ( к которой прикреплена)
				home_url() : // если нет то на гланую
				get_permalink($post->post_parent);  // если есть родительский  то сюда
	
	wp_redirect($link, 301);

