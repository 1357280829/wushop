<?php

/**
 * 判断两个数组是否相等(元素值一样，顺序可以不一样)
 *
 * @param array $array1
 * @param array $array2
 * @return bool
 */
function array_equal(array $array1, array $array2) {
    return !array_diff($array1, $array2) && !array_diff($array2, $array1);
}