<?php 

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_team-members-fields',
		'title' => 'Team members fields',
		'fields' => array (
			array (
				'key' => 'field_596653f1cd5e5',
				'label' => 'Position',
				'name' => 'position',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => 'Your current position',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => 250,
			),
			array (
				'key' => 'field_5966548dcd5e6',
				'label' => 'Weight',
				'name' => 'weight',
				'type' => 'number',
				'instructions' => 'this field defines the team members order in the frontend (DESC)',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
			array (
				'key' => 'field_59665529cd5e7',
				'label' => 'E-mail',
				'name' => 'email',
				'type' => 'email',
				'default_value' => '',
				'placeholder' => 'example@email.com',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_59665586cd5e8',
				'label' => 'Linkedin profile',
				'name' => 'linkedin',
				'type' => 'text',
				'instructions' => 'Add team member Linkedin profile',
				'default_value' => '',
				'placeholder' => 'https://www.linkedin.com/in/username',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_596659c2cd5e9',
				'label' => 'Icon',
				'name' => 'icon',
				'type' => 'image',
				'save_format' => 'object',
				'preview_size' => 'full',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'team',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}


?>