<?php 
class BusinessDaysTask extends Shell {

  public function execute($days=0, $date="TODAY", $format="c") {
    // CREATE YOUR ARRAY OF HOLIDAYS
    $holidays  = array();
    $november  = strtotime(date('Y') . '-11-0');
    $january   = strtotime(date('Y') . '-01-0');
    $february  = strtotime(date('Y') . '-02-0');
    $may       = strtotime(date('Y') . '-05-0');
    $september = strtotime(date('Y') . '-09-0');
    $november2  = strtotime(date('Y') + 1 . '-11-0');
    $january2   = strtotime(date('Y') + 1 . '-01-0');
    $february2  = strtotime(date('Y') + 1 . '-02-0');
    $may2       = strtotime(date('Y') + 1 . '-05-0');
    $september2 = strtotime(date('Y') + 1 . '-09-0');
    $nextyear  = mktime(0,0,0, 1, 1, date('Y') + 1);
    $holidays['Dr_M_L_King']  = date('r', strtotime('Third Monday', $january));
    $holidays['Independence'] = date('r', strtotime(date('Y') . '-07-04'));
    $holidays['Thanksgiving'] = date('r', strtotime('Fourth Thursday', $november));
    $holidays['Thanksgiving2'] = date('r', strtotime('Fourth Friday', $november));
    $holidays['Christmas']    = date('r', strtotime(date('Y') . '-12-25'));
    $holidays['NewYear']      = date('r', $nextyear);
    $holidays['Presidents']  = date('r', strtotime('Third Monday', $february));
    $holidays['Memorial']  = date('r', strtotime('last Monday', $february));
    $holidays['Labor']  = date('r', strtotime('First Monday', $september));
    $holidays['Veteran']  = date('r', strtotime(date('Y') . '-11-11'));
    $holidays['Dr_M_L_King2']  = date('r', strtotime('Third Monday', $january2));
    $holidays['Independence2'] = date('r', strtotime(date('Y') + 1 . '-07-04'));
    $holidays['Thanksgiving3'] = date('r', strtotime('Fourth Thursday', $november2));
    $holidays['Thanksgiving4'] = date('r', strtotime('Fourth Friday', $november2));
    $holidays['Christmas2']    = date('r', strtotime(date('Y') + 1 . '-12-25'));
    $holidays['Presidents2']  = date('r', strtotime('Third Monday', $february2));
    $holidays['Memorial2']  = date('r', strtotime('last Monday', $february2));
    $holidays['Labor2']  = date('r', strtotime('First Monday', $september2));
    $holidays['Veteran2']  = date('r', strtotime(date('Y') + 1 . '-11-11'));
    // ACTIVATE THIS TO SEE THE HOLIDAYS
    // print_r($holidays);
    
    // INTERPRET THE INPUTS INTO TIMESTAMPS
    $originalDate = $date;
    $date = substr($date, 0, 10) . " 00:00:00";
    
    //if the request is after 5pm on a workday, it needs to be pushed an additional day
    if (!in_array(date('r', strtotime($date)), $holidays)){ // only do this if it's not a holiday
      if(date('w',strtotime($date)) != 6 && date('w',strtotime($date)) != 0){ //weekends
        if(substr($originalDate, 11,2) >= 17){
          $days = $days + 1;
        }
      }
    }
    
    $days = round($days);
    if ($days < 0) return FALSE;
    if (!$current   = strtotime($date)) return FALSE;
    if (!$timestamp = strtotime("$date $days DAYS")) return FALSE;
    
    // PAD THE FUTURE TO ALLOW ROOM FOR THE WEEKENDS
    $weeks     = $days * 2 + 2;
    $timestamp = strtotime("$date $weeks DAYS");
    
    // MAKE AN ARRAY OF FUTURE TIMESTAMPS AND RFC2822 DATES
    $arr = range($current, $timestamp, 86400);
    $arr = array_flip($arr);
    foreach ($arr as $timestamp_key => $nothing)
    {
      // ASSIGN RFC2822 DATE STRINGS TO EACH TIMESTAMP
      $arr[$timestamp_key] = date('r', $timestamp_key);

      // REMOVE THE DAY FROM THE ARRAY IF IT IS A HOLIDAY OR WEEKEND DAY
      if (in_array($arr[$timestamp_key], $holidays)) $arr[$timestamp_key] = 'S';
      if (substr($arr[$timestamp_key],0,1) == 'S') unset($arr[$timestamp_key]);
    }
    
    // RECAST THE ARRAY KEYS INTO OFFSETS FROM THE STARTING DATE
    $arr = array_values($arr);
    
    // RETURN THE FUTURE DATE ACCORDING TO THE REQUESTED FORMAT
    return date($format, strtotime($arr[$days]));
  }
}