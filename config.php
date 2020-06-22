<?php
class Config {
  public static $DB_CONNECTION_HOST          = '156.67.222.148';
  public static $DB_CONNECTION_USERNAME      = 'u883604362_taxi';
  public static $DB_CONNECTION_PASSWORD      = 'Db@#Taxi123';
  public static $DB_CONNECTION_DATABASE_NAME = 'u883604362_taxi';

  public static $LIMIT = 5;
  public static $PAGE  = 1;

  public static $BOOTSTRAP_RATING_CLASS = array(
    5 => array(
      'class' => 'bg-success', // 5 sao, class quy định màu mặc định (Bootstrap)
    ),
    4 => array(
      'class' => 'bg-primary', // 4 sao, class quy định màu mặc định (Bootstrap)
    ),
    3 => array(
      'class' => 'bg-info', // 3 sao, class quy định màu mặc định (Bootstrap)
    ),
    2 => array(
      'class' => 'bg-warning', // 2 sao, class quy định màu mặc định (Bootstrap)
    ),
    1 => array(
      'class' => 'bg-danger', // 1 sao, class quy định màu mặc định (Bootstrap)
    ),
  );

  public static $REGEX_PATTERN = [
    'username'        => '^\w+$',
    'vietnamese_name' => '^[a-zA-ZàáãạảăắằẳẵặâấầẩẫậèéẹẻẽêềếểễệđìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳỵỷỹýÀÁÃẠẢĂẮẰẲẴẶÂẤẦẨẪẬÈÉẸẺẼÊỀẾỂỄỆĐÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴỶỸÝ]+( [a-zA-ZàáãạảăắằẳẵặâấầẩẫậèéẹẻẽêềếểễệđìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳỵỷỹýÀÁÃẠẢĂẮẰẲẴẶÂẤẦẨẪẬÈÉẸẺẼÊỀẾỂỄỆĐÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴỶỸÝ]+)*$',
    'email'           => '^[a-z][a-z0-9_\\.]{5,32}@[a-z0-9]{2,}(\\.[a-z0-9]{2,4}){1,3}$',
    'date'            => '^([12]\\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\\d|3[01]))$',
    'phone'           => '^\\+?\\d{10,}$',
    'any'             => '^.+$',
    'number'          => '^-?\\d+$',
  ];
}