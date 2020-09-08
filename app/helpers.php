<?php

//  判断两个数组相等(元素值一样，顺序可以不一样)
function array_equal(array $array1, array $array2) {
    return !array_diff($array1, $array2) && !array_diff($array2, $array1);
}