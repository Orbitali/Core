<?php

namespace Orbitali\Foundations\Nestedset;

class NestedSet
{
    /**
     * The name of default lft column.
     */
    const LFT = "lft";

    /**
     * The name of default rgt column.
     */
    const RGT = "rgt";

    /**
     * The name of default parent id column.
     */
    const PARENT_ID = "parent_id";

    /**
     * Insert direction.
     */
    const BEFORE = 1;

    /**
     * Insert direction.
     */
    const AFTER = 2;

    /**
     * Get a list of default columns.
     *
     * @return array
     */
    public static function getDefaultColumns()
    {
        return [static::LFT, static::RGT, static::PARENT_ID];
    }

    /**
     * Replaces instanceof calls for this trait.
     *
     * @param mixed $node
     *
     * @return bool
     */
    public static function isNode($node)
    {
        return is_object($node) && in_array(NodeTrait::class, (array) $node);
    }
}
