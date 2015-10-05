<?php
error_reporting(E_ALL);
/**
 * Created by PhpStorm.
 * User: BlackIce
 * Date: 3/26/15
 * Time: 12:08
 */
if($_GET['services']=='1') {
    $servicesList = array(
        array('id' => 1, 'name' => 'Juukse pesemine', 'len' => '30 min', 'price' => '15.65 &euro;'),
        array('id' => 2, 'name' => 'Juukse loikamine', 'len' => '45 min', 'price' => '25 &euro;'),
        array('id' => 3, 'name' => 'Juukse loikamine2', 'len' => '60 min', 'price' => '25 &euro;'),
        array('id' => 4, 'name' => 'Juukse loikamine3', 'len' => '35 min', 'price' => '25 &euro;'),
        array('id' => 5, 'name' => 'Juukse loikamine4', 'len' => '65 min', 'price' => '25 &euro;'),
        array('id' => 6, 'name' => 'Juukse varvimine', 'len' => '23 min', 'price' => '25 &euro;'),
    );

    /* Random number, random services */
    $rand = rand(1, count($servicesList));
    for ($i = 0; $i <= $rand; $i++) {
        $arrId = rand(0, count($servicesList));
        $resulted[$i] = $servicesList[$arrId];
        unset($servicesList[$arrId]);
        $servicesList = array_values($servicesList);

    }

    foreach ($resulted as $k => $result) {
        if (is_array($result)) {
            $len = substr($result['len'], 0, 2);
            $price = substr($result['price'], 0, -6);
            $returnArray['services'][] = $result;
            $totalLen = round($totalLen + $len);
            $totalPrice = round($totalPrice + $price, 2);
        }
    }
    $returnArray['totalLen'] = $totalLen;
    $returnArray['totalPrice'] = $totalPrice;
    $returnArray['employee'] = 'Super Jaanes';

    echo json_encode($returnArray);
}

if($_REQUEST['monthChange']>0){
    for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, round($_REQUEST['monthChange']), date("Y"));$i++){
        $days[$i] = date("D",mktime(0,0,0,round($_REQUEST['monthChange']),$i,date("Y")));
    }
    echo json_encode($days);
}

if($_REQUEST['currentDate']<>'' && $_REQUEST['currentMonth']<>''){

    if(round($_REQUEST['daysNumber'])==0){
        $daysNumber = 7;
    }else{
        $daysNumber =  round($_REQUEST['daysNumber']);
    }

    $oh = '';
    //get dates for that
    $currentDate = mktime(0,0,0,round($_REQUEST['currentMonth']),round($_REQUEST['currentDate']),date("Y"));

    if($daysNumber>1){
        //get day in the middle
       $middle =  ($daysNumber - 1) / 2;
       $middleYaay = -1*$middle;
    }else{
        $middle = 0;
        $middleYaay = 0;
    }

    for($i=$middleYaay;$i<$middle+1;$i++){
        $returnDay[$i]['date'] = date("d F",$currentDate + 24*60*60*$i);
        $returnDay[$i]['weekDay'] = date("l",$currentDate + 24*60*60*$i);
        $returnDay[$i]['classDate'] = date("dmY",$currentDate + 24*60*60*$i);
        $returnDay[$i]['normaldate'] = date("d.m.Y",$currentDate + 24*60*60*$i);

        $oh.='<div class="calendar-column cal-'.$returnDay[$i]['classDate'].''.(($i>1)?'hidden-xxs':'').'  '.(($i>3)?'hidden-xs':'').' '.(($i>5)?'hidden-sm':'').' ">';
        $oh.='<div class="col-sm-12 head-line"><h4 class="semi-bold date">'.$returnDay[$i]['weekDay'].'</h4>'.$returnDay[$i]['date'].'</div>';
        for($x=8;$x<18;$x++){
          $oh.='<div class="col-sm-12 time-line cal-'.$returnDay[$i]['classDate'].' cal-'.$x.'00 '.((rand(0,1)==1)?'calendar-disabled':'').' '.(($x==8 && $i==$middleYaay+1)?'calendar-disabled':'').' " time="'.$x.'00" date="'.$returnDay[$i]['classDate'].'" datestamp="'.$returnDay[$i]['normaldate'].'" formatedDate="'.$returnDay[$i]['date'].'" formatedTime="'.$x.':00">';
            if($x==8 && $i==$middleYaay+1){
                $oh.='
                <div class="reserved-time" style="height:120px">
                    <span class="reserved-service-name">Juukse loikus loikus loikus loikus</span>
                    <span class="reserved-service-name">Juukse varvimine</span>
                </div>
                ';
            }
          $oh.='</div>';
          $oh.='<div class="col-sm-12 time-line cal-'.$returnDay[$i]['classDate'].' cal-'.$x.'15 '.((rand(0,1)==1)?'calendar-disabled':'').' " time="'.$x.'15" date="'.$returnDay[$i]['classDate'].'" datestamp="'.$returnDay[$i]['normaldate'].'" formatedDate="'.$returnDay[$i]['date'].'" formatedTime="'.$x.':15"></div>';
          $oh.='<div class="col-sm-12 time-line cal-'.$returnDay[$i]['classDate'].' cal-'.$x.'30 '.((rand(0,1)==1)?'calendar-disabled':'').' " time="'.$x.'30" date="'.$returnDay[$i]['classDate'].'" datestamp="'.$returnDay[$i]['normaldate'].'" formatedDate="'.$returnDay[$i]['date'].'" formatedTime="'.$x.':30"></div>';
          $oh.='<div class="col-sm-12 time-line cal-'.$returnDay[$i]['classDate'].' cal-'.$x.'45 '.((rand(0,1)==1)?'calendar-disabled':'').' " time="'.$x.'45" date="'.$returnDay[$i]['classDate'].'" datestamp="'.$returnDay[$i]['normaldate'].'" formatedDate="'.$returnDay[$i]['date'].'" formatedTime="'.$x.':45"></div>';
        }
        $oh.='</div>';
    }
    echo $oh;


}
if($_GET['user']==1){
    $array = array(
        array('user_id'=>1,'user_name'=>'Veniamin','user_surname'=>'Pupking','user_email'=>'blahblah@bla.hh','user_picture'=>'assets/img/profiles/1.png'),
        array('user_id'=>2,'user_name'=>'Vasja','user_surname'=>'Pipkin','user_email'=>'blahblah@blaaa.hh','user_picture'=>'assets/img/profiles/2.png'),
    );
    echo json_encode($array);
}