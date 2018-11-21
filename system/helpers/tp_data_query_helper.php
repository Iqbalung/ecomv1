<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_formatted_data($query_result)
{
  $new_data = array();
  $fields = $query_result->list_fields();
  $data_array = $query_result->result_array();
  
  $i = 0;
  foreach($data_array as $data)
  {
    foreach($fields as $field)
    {
      $new_data[$i][$field] = ($data[$field] == NULL ? '-' : $data[$field]);
    }
    $i++;
  }
  
  return $new_data;
}

function get_formatted_nip($nip)
{
  return substr($nip, 0, 3).' '.substr($nip, 3, 3).' '.substr($nip, 6, 3);
}

function prevent_null_value($value)
{
  return ($value == '' ? NULL : $value);
}


/* End of file data_query_helper.php */
/* Location: ./application/helpers/data_query_helper.php */