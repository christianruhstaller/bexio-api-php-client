<?php

namespace Bexio\Contract;

interface ItemPosition
{
    public function listItemPositions($parentId, $params = []);
    public function showItemPosition($parentId, $itemId);
    public function createItemPosition($parentId, $params = []);
    public function editItemPosition($parentId, $itemId, $params = []);
    public function deleteItemPosition($parentId, $itemId);
}
