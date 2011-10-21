<?PHP
#########################
## Make a random naumber 
#########################
function feed_make_seed() {
    list($usec, $sec) = explode(' ', microtime());
    return (float) $sec + ((float) $usec * 100000);
	}
srand(feed_make_seed());
#########################
## Open the text file of rss feeds & build array 
#########################
$file_handle = fopen("FeedList.txt", "rb");

while (!feof($file_handle) ) {
$line_of_text = fgets($file_handle);
$parts = explode('=', $line_of_text);
$i++;
$feed[]=$parts[0] . $parts[1];
}

fclose($file_handle);
#########################
## Pick one feed and open it 
#########################
$totalfeeds=$i;
if(!$ry) { $ry=rand(1,$totalfeeds); }

$curl_handle=curl_init();
curl_setopt($curl_handle,CURLOPT_URL, $feed[$ry]);
curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
$buffer = curl_exec($curl_handle);
curl_close($curl_handle);


if (empty($buffer)) {
	//print "Sorry, ".$feed[$ry]." are a bunch of poopy-heads."; 
	} else { 
	print $buffer; 
	}


?>