<?php
class ArrayUtil {
  public static function deepInArray($value, $array) {
    if (in_array($value, $array)) {
      return true;
    }
    foreach ($array as $element) {
      if (is_array($element) && ArrayUtil::deepInArray($value, $element)) {
        return true;
      }
    }
    return false;
  }
}
