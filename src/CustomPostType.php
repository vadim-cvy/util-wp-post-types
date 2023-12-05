<?php
namespace Cvy\WP\PostTypes;
use \Exception;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class CustomPostType extends PostType
{
  protected function __construct()
  {
    add_action( 'init', fn() => $this->register() );
  }

  private function register() : void
  {
    register_post_type( $this->get_slug(), $this->get_register_args() );
  }

  protected function get_register_args() : array
  {
    $label_single = $this->get_label_single();
    $label_multiple = $this->get_label_multiple();

    $labels = [
      'name'                  => $label_multiple,
      'singular_name'         => $label_single,
      'menu_name'             => $label_multiple,
      'name_admin_bar'        => $label_single,
      'add_new'               => "Add New",
      'add_new_item'          => "Add New $label_single",
      'new_item'              => "New $label_single",
      'edit_item'             => "Edit $label_single",
      'view_item'             => "View $label_single",
      'all_items'             => "All $label_multiple",
      'search_items'          => "Search $label_multiple",
      'parent_item_colon'     => "Parent $label_multiple:",
      'not_found'             => "No $label_multiple found.",
      'not_found_in_trash'    => "No $label_multiple found in trash.",
      'featured_image'        => "$label_single cover image",
      'set_featured_image'    => "Set cover image",
      'remove_featured_image' => "Remove cover image",
      'use_featured_image'    => "Use as cover image",
      'archives'              => "$label_single archives",
      'insert_into_item'      => "Insert into $label_single",
      'uploaded_to_this_item' => "Uploaded to this $label_single",
      'filter_items_list'     => "Filter $label_multiple list",
      'items_list_navigation' => "$label_multiple list navigation",
      'items_list'            => "$label_multiple list",
    ];

    return [
      'labels'             => $labels,
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'rewrite'            => [ 'slug' => $this->get_slug() ],
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => 2.5,
      'supports'           => [ 'title', 'editor' ],
    ];
  }

  static public function get_label_single() : string
  {
    throw new Exception( 'This method is abstract and must be implemented!' );
  }

  static public function get_label_multiple() : string
  {
    throw new Exception( 'This method is abstract and must be implemented!' );
  }
}