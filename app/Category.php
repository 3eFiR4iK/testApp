<?php
namespace App;

use Baum\Node;

class Category extends Node
{

  /**
   * Table name.
   *
   * @var string
   */
    protected $table = 'categories';

   /**
    * Column name which stores reference to parent's node.
    *
    * @var string
    */
    protected $parentColumn = 'parent_id';

   /**
    * Column name for the left index.
    *
    * @var string
    */
    protected $leftColumn = 'lft';

   /**
    * Column name for the right index.
    *
    * @var string
    */
    protected $rightColumn = 'rgt';

   /**
    * Column name for the depth field.
    *
    * @var string
    */
    protected $depthColumn = 'depth';

   /**
    * With Baum, all NestedSet-related fields are guarded from mass-assignment
    * by default.
    *
    * @var array
    */
    protected $guarded = array('id', 'parent_id', 'lft', 'rgt', 'depth');



    public function breadcrumps(): string
    {
        $breadcrumps = '/';
        $parentId = $this->parent_id;
        while ($parentId != null) {
            $parent = self::find($parentId);
            $breadcrumps .= $parent->name. '/';
            $parentId = $parent->parent_id;
        }

        return $breadcrumps;
    }

    public function products()
    {
       return $this->hasMany(Product::class);
    }

}
