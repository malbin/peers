<?php
class FormatHelper extends AppHelper {
	function company($job, $emp){
		$str = '<strong>'.$emp['name'].'</strong>';
		if($job['city']){
			$str .= ' - '.$job['city'];
		}
		return $str;
	}

	function date($date){
		$display_date = date("M-Y",strtotime("$date"));
		$current_date = date("Y-m-d");
		if($date == '0000-00-00' || $current_date <= $date){
			echo "Present";
		} else{
			echo $display_date;
		}
	}

	function salary($currency = 'USD',$amount){
		if($currency == "USD"){
			setlocale(LC_MONETARY, 'en_US');
			return money_format('%.0n', $amount);;
		}
		else if($currency == "GBP"){
			setlocale(LC_MONETARY, 'en_GB');
			return money_format('%.0n', $amount);
		}
	}
	
	function roller_color($max_rank,$my_rank){
		$max_color = array('r'=>115,'g'=>53,'b'=>88);
		$min_color = array('r'=>81,'g'=>121,'b'=>196);
		
		$rank = $my_rank/$max_rank;
		
		$my_rank = array();
		$my_rank['r'] = floor($min_color['r'] + ($max_color['r'] - $min_color['r'])*$rank);
		$my_rank['g'] = floor($min_color['g'] + ($max_color['g'] - $min_color['g'])*$rank);
		$my_rank['b'] = floor($min_color['b'] + ($max_color['b'] - $min_color['b'])*$rank);
		
		$color = 'rgb('.$my_rank['r'].','.$my_rank['g'].','.$my_rank['b'].')';
		return $color;
	}
}
?>