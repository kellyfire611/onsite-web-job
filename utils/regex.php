<?php
class Regex {
  public static $PATTERN = [
    'username'        => '^\w+$',
    'code'            => '^\w+$',
    'vietnamese_name' => '^[a-zA-ZàáãạảăắằẳẵặâấầẩẫậèéẹẻẽêềếểễệđìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳỵỷỹýÀÁÃẠẢĂẮẰẲẴẶÂẤẦẨẪẬÈÉẸẺẼÊỀẾỂỄỆĐÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴỶỸÝ]+( [a-zA-ZàáãạảăắằẳẵặâấầẩẫậèéẹẻẽêềếểễệđìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳỵỷỹýÀÁÃẠẢĂẮẰẲẴẶÂẤẦẨẪẬÈÉẸẺẼÊỀẾỂỄỆĐÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴỶỸÝ]+)*$',
    'email'           => '^[a-z][a-z0-9_\\.]{5,32}@[a-z0-9]{2,}(\\.[a-z0-9]{2,4}){1,3}$',
    'date'            => '^([12]\\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\\d|3[01]))$',
    'phone'           => '^\\+?\\d{10,}$',
    'any'             => '^.+$',
    'number'          => '^-?\\d+$',
    'number_pos'      => '^\\d+$',
  ];

  public static function test(string $pattern, int $min, int $max, string $subject): bool {
    return !(
      strlen($subject) < $min ||
      strlen($subject) > $max ||
      !preg_match('/' . Regex::$PATTERN[$pattern] . '/', $subject)
    );
  }
}
