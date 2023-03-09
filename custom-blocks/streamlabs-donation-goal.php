<?php

$token = $attributes['token'];
$heading = $attributes['heading'] ?? 'Undefined';

if (!$token) {
	return;
}


$baseUrl = "https://streamlabs.com/api/v5/donation-goal/data/";
$url = add_query_arg(array("token" => $token), $baseUrl);

$request = Requests::get($url, array(
	'Content-Type' => 'application/json'
));

if(!$request->success) return;

$data = json_decode($request->body, true)['data'];

$currentAmount = $data['amount']['current'];
$start = $data['amount']['start'];
$target = $data['amount']['target'];
$endDate = $data['to_go']['ends_at'];

function getPercent($currValue, $maxValue){
	if($currValue == 0) return 0;
	$div = $currValue / $maxValue;
	return intval(ceil($div * 100));
}

$percentage = getPercent($currentAmount, $target);

?>


<div class="streamlabs-donation-goal">
	<div class="streamlabs-donation-goal__heading"><?php echo $heading ?></div>
	<div class="streamlabs-donation-goal__bar">
		<div class="streamlabs-donation-goal__bar__growing-bar" style="width:<?php echo $percentage ?>%"></div>
		<div class="streamlabs-donation-goal__bar__stats">
			<span class="streamlabs-donation-goal__bar__stats__current"><?php echo $currentAmount ?></span>
			<span class="streamlabs-donation-goal__bar__stats__percentage"><?php echo $percentage ?>%</span>
			<span class="streamlabs-donation-goal__bar__stats__target"><?php echo $target ?></span>
		</div>
	</div>
</div>


