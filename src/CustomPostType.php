<?php
namespace Cvy\WP\CustomPostType;

use Cvy\WP\PostsQuery\PostsQuery;

use Cvy\WP\Post\Post;

abstract class CustomPostType extends \Cvy\WP\ObjectsTypeWrap\ObjectsTypeWrapper
{
  static public function wrap_one( int $post_id ) : Post
  {
    return new Post( $post_id );
  }

  static final public function build_query( array $query_args = [] ) : PostsQuery
  {
    $query_args['post_type'] = static::get_slug();

    return parent::build_query( $query_args );
  }

  static protected function get_query_instance( array $query_args ) : PostsQuery
  {
    return new PostsQuery( $query_args );
  }

  static final public function get_all( array $query_args = [] ) : array
  {
    $query_args['posts_per_page'] = -1;

    return static::get( $query_args );
  }
}
