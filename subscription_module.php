<?php
//****require for currency conversion if needed****//
//****currency conversion start****//
$url = "http://data.fixer.io/api/latest?access_key=YOUR_ACCRESS_KEY";
$exchange = json_decode(file_get_contents($url), true);
$USD=$exchange['rates']['USD'];  //value from from data
$INR=$exchange['rates']['INR'];  //value from from data
//****currency conversion end****//

//****skip this if not required****//
$plan_id=$_POST['plan_id'];   //value from from data
$plan_name=$_POST['plan_name'];  //value from from data
$addon_plan_name=$_POST['addon_plan_name'];  //value from from data
$addon_plan=number_format(($INR*$_POST['addons'])/$USD,2,'.', '');  //value from from data
$addon_user_name=$_POST['addon_user_name'];  //value from from data
$addon_user=number_format(($INR*$_POST['users'])/$USD,2,'.', '');  //value from from data
//****skip this if not required****//

//data array //
$test=array( 'plan_id' => $plan_id,  //plan id for subscription pack
              'customer_notify' => 1,   //read the doc please
              'total_count' => 6, //read the doc please
              'addons'=>array(
                              array('item'=>array(
                                                    'name' => $addon_plan_name,  //add ons are optional for each addon create separate array
                                                                'amount'=> $addon_plan*100, // price in paise
                                                                'currency'=> 'INR',   //currency extension
                                              )
                                  ),
                              array('item'=>array(
                                                    'name' => $addon_user_name,
                                                                'amount'=> $addon_user*100,
                                                                'currency'=> 'INR',
                                              )
                                  )
                              )
            );

$data_json = json_encode($test);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://YOUR_API_KEY:YOUR_SECRET_API_KEY@api.razorpay.com/v1/subscriptions');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response  = curl_exec($ch);
curl_close($ch);
$result = json_decode($response, true);
echo $result['id'];  //this will return subscription id
  
?>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<div class="container" style="margin-top: 60px">
    <div class="row">
        <div class="text-center col-md-12" style="margin-top: 60px">
        <button id="techhawa" class="btn btn-primary"  href="https://www.techhawa.com"  >Pay via Razerpay</button>
        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "YOUR_API_KEY",
    "subscription_id": "<?php echo $result['id']; ?>",                                           //susbcription id will generate for subscription based payment
    "name": "<?php echo $plan_name; ?>",                                                          //pass static if not using any dynamic value
    "description": "<?php echo $plan_name; ?>  PLAN PAYMENT",             //pass static if not using any dynamic value
    "image": "https://cdn.razorpay.com/logo_invert.svg",                  //your logo url
    "handler": function (response){
          alert(response.razorpay_payment_id);                                                  //call back function
    },
    "theme": {
        "color": "#00a1f1"
    }
};
var techhawa= new Razorpay(options);
document.getElementById('techhawa').onclick = function(e){
    techhawa.open();
    e.preventDefault();
}
</script>
