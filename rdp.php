<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Threehunt</title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href="assets/def.css" rel="stylesheet" />
    <script type="text/javascript" src="assets/jquery.min.js"></script>
</head>

<body class="site siteparent">

<?php
    $url = "http://" . $_SERVER['HTTP_HOST'] . "/keyhole/";

    if (isset($_GET["id"]) && !empty($_GET["id"])){
        $id = $_GET["id"];
    } else {
        $id = 1;
    }


    $rdp_url =  $url . "api/rdp/read_one.php?id=" . $id;
    $contents = file_get_contents($rdp_url);
    $rdp = json_decode($contents);
    $ip = $rdp->ip;
    $mime = $rdp->mime;
    $image_data = $rdp->image_data;
    $org = $rdp->org;
    $city = $rdp->city;
    $timestamp = $rdp->timestamp;
    $formattedDate = date( "Y/m/d", strtotime($timestamp));

    if($id == 1){
        $prev = $id;
        $next = $id + 1;
    } else {    
        $prev = $id - 1;
        $next = $id + 1;
    }
?>

    <div style="padding: 20px" id="tooppbar">
        <table width="100%">
            <tr>
                <td align="left" valign="top" width="10%" nowrap="nowrap"><a href="<?php echo $url; ?>rdp.php?id=<?php echo $prev;?>"
                        class="button">Previous KeyHole</a></td>
                <td align="center" valign="top">
                    <a href="<?php echo $url; ?>rdp.php?id=<?php echo rand(1,200);?>" class="button">Random KeyHole</a>
                </td>
                <td align="right" valign="top" width="10%" nowrap="nowrap"><a href="<?php echo $url; ?>rdp.php?id=<?php echo $next; ?>"
                        class="button">Next KeyHole</a>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top" width="10%" nowrap="nowrap">
                    <p>IP: <?php echo $ip;?></p>
                    <p>Protocol: RDP</p>
                    <p>Org: <?php echo $org; ?></p>
                    <p>City: <?php echo $city; ?></p>
                    <p>Timestamp: <?php echo $formattedDate;?></p>
                </td>
                <td align="center" valign="top">
                    <p style="margin: 10px;font-weight: bold;font-size: 18px;">Keyhole IP <?php echo $ip;?></p>
                    <a href="<?php echo $url; ?>rdp.php" class="button">RDP</a>
                    <a href="<?php echo $url; ?>vnc.php" class="button">VNC</a>
                </td>
            </tr>
        </table>
    </div>
    <div style="text-align: center;margin: 30px;">
        <?php echo '<img  src="data:' .$mime.';base64,'.$image_data.'"/>' ?>;
    </div>
    <div style="margin: 50px"></div>

</body>

</html>
